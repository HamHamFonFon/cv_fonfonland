<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	
	protected function _initAutoload()
	{
		$moduleLoader = new Zend_Application_Module_Autoloader(array(
				'namespace' => '',
				'basePath' => dirname(__FILE__)
		));
		//Zend_Debug::dump($moduleLoader);
		return $moduleLoader;
	}
	
	protected function _initPlugins()
    {
        $this->_acl = new Fonfonblog_Acl();
		$this->_auth = Zend_Auth::getInstance();

        $objFront = Zend_Controller_Front::getInstance();
        $objFront->registerPlugin(new Fonfonblog_Controller_Plugin_ACL($this->_acl, $this->_auth), 1);
        $objFront->registerPlugin(new Fonfonblog_Controller_Plugin_LoadJs, 2);
        return $objFront;
    }
	
	/**
	 * Chargement des helpers
	 */
	protected function _initHelperLoad ()
	{
		Zend_Controller_Action_HelperBroker::addPrefix('Fonfonblog_View_Helper');
	}
	
	/**
	 * Initialisation des constantes
	 */
	protected function _initConstants ()
	{
		$registry = Zend_Registry::getInstance();
    	$registry->constants = new Zend_Config($this->getApplication()->getOption('constants'));
	}
	
	/**
	 * Initialisation de la vue
	 * @return Zend_View
	 */
	protected function _initView()
    {
        $options = $this->getOptions();
        $config = $options['resources']['view'];
        
        // Initialisons la vue
        $view = new Zend_View();
        $view->doctype($config['doctype']);
        $view->headMeta()->setCharset($config['charset']);
        $view->headTitle('CV MEAUDRE Stephane');
        
        // Ajoutons là au ViewRenderer
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper(
            'ViewRenderer'
        );
        $viewRenderer->setView($view);
 
        // Retourner la vue pour qu'elle puisse être stockée par le bootstrap
        return $view;
    }

	/**
	 * Initialisation du menu de navigation
	 */
	protected function _initNavigation ()
	{
		$this->bootstrap("view") ;
		$view = $this->getResource('view') ;
		
		// Gestion navigateur Header
		$oNavigationController = new Fonfonblog_Controller_Navigation();
		$tabNavigationHeader = new Zend_Navigation($oNavigationController->getMenuHeader());
		
		//Zend_Debug::dump($this->_auth->getStorage()->read()); exit;
		
		$view->navigation($tabNavigationHeader)->setAcl($this->_acl)
												->setRole(($this->_auth->hasIdentity()) ? $this->_auth->getStorage()->read()->roles : 'guest');
		
	}
}