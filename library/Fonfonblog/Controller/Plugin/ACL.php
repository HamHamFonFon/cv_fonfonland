<?php
class Fonfonblog_Controller_Plugin_ACL extends Zend_Controller_Plugin_Abstract
{
	private $_auth;
	private $_acl;
	private $_defaultModule;
	
	// Assignation du rôle par defaut
	protected $_defaultRole;
	
	/**
	 * Chemin de redirection lors de l'échec de contrôle des privilèges
	 */
	const FAIL_ACL_ACTION     = 'index';
	const FAIL_ACL_CONTROLLER = 'index';
	
	/**
	 * Constructeur
	 * 
	 * @param Zend_Acl $acl : acl
	 * @param Zend_Auth $auth : instance de zend_auth
	 */
	public function __construct (Zend_Acl $acl, Zend_Auth $auth)
	{
		// Recuperation de l'instance de connexion
		$this->_auth = $auth; //Zend_Auth::getInstance();
		
		// Instance de la classe de gestion des ACl
		$this->_acl = $acl; //new Fonfonblog_Acl();
		
		// Module par defaut
		$this->_defaultModule = Zend_Controller_Front::getInstance()->getDefaultModule() ;
		
		// Role par defaut
		$this->_defaultRole = 'guest';
	}
	
	/**
	 * @param Zend_Controller_Request_Abstract $request : requete à verifier
	 * 
	 * @return redirection selon autorisation
	 */
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		$fflsession = new Zend_Session_Namespace('fflsession');
		
		//Zend_Debug::dump($this->_acl->getRoles()); 
		//Zend_Debug::dump($this->_acl->getResources()); 
		
		$module 	= $request->getModuleName() ;
		$controller = $request->getControllerName();
		$action = $request->getActionName();
		
		// compose le nom de la ressource
		if ($module == $this->_defaultModule)	{
			$resource = $controller ;
		} else {
			$resource = $module.'_'.$controller ;
		}
		
		// est-ce que la ressource existe ?
		if (!$this->_acl->has($resource)) {
			$resource = null;
		}
		
		if ($this->_auth->getIdentity()) {
			$role = $this->_auth->getStorage()->read()->roles;
			//echo 'Role user pour ' . $controller . ' / ' . $action .' : ' . $role . "<br>";
			
			if (!$this->_acl->isAllowed($role, $resource, $action)) {
				$fflsession->destination_url = $request->getPathInfo();
				
				//echo "Accès non autorisé à " . $request->getModuleName() . '/' . $request->getControllerName() . '/' . $request->getActionName();
				
				$controller = self::FAIL_ACL_CONTROLLER ;
				$action = self::FAIL_ACL_ACTION ;
			}
		} else {
			if(!$this->_acl->isAllowed($this->_defaultRole, $resource, $action)) {
                $fflsession->destination_url = $request->getPathInfo();
                
                //echo "Accès non autorisé à " . $request->getModuleName() . '/' . $request->getControllerName() . '/' . $request->getActionName();
                
				$controller = self::FAIL_ACL_CONTROLLER ;
				$action = self::FAIL_ACL_ACTION ;
            }
		}
		
		// Redirection
		$request->setControllerName($controller) ;
		$request->setActionName($action) ;
	}
	
}
