<?php
class AuthController extends Zend_Controller_Action
{
	
	private $_dataLogin;
	
	public function setDataLogin ($data)
	{
		$this->_dataLogin = $data;
	}
	
	private function _getDataLogin()
	{
		return $this->_dataLogin;
	}
	
	
	/**
	 * Si l'user est connecté, on le redirige
	 */
	public function preDispatch ()
	{
		if (Zend_Auth::getInstance()->hasIdentity()) {
            // If the user is logged in, we don't want to show the login form;
            // however, the logout action should still be available
            if ('logout' != $this->getRequest()->getActionName()) {
                $this->_helper->redirector('index', 'index');
            }
        } else {
            // If they aren't, they can't logout, so that action should 
            // redirect to the login form
            if ('logout' == $this->getRequest()->getActionName()) {
                $this->_helper->redirector('index');
            }
        }
	}
	
	/*public function init ()
	{
		$this->_process();
	}*/
	
	public function loginAction ()
	{
		$this->view->pageTitle = "Connexion";
		
		$formAuth = new Application_Form_Connexion();
		$this->view->formConnexion = $formAuth;
		
		$request = $this->getRequest();
		
		if ($request->isPost()) {
			if ($formAuth->isValid($request->getPost())) {

				$this->setDataLogin($request->getPost());
				
				if ($this->_process()) {
					$this->_helper->redirector('index', 'index');
					$this->view->message = $this->_helper->messages('Connexion réussie.', Zend_Registry::getInstance()->constants->message->type->ok);
				} else {
					$this->view->message = $this->_helper->messages('Mauvais login ou mauvais mot de passe.', Zend_Registry::getInstance()->constants->message->type->alert);
                    $formAuth->populate($request->getPost());
				}
			}
		} 
	}
	
	/*
	 * Processus d'authentification avec Zend_Auth
	 */
	private function _process ()
	{
		$userModel = new Application_Model_DbTable_Utilisateurs();
		$dbAdapter = $userModel->getDefaultAdapter();
		$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
		
		$staticSalt = Zend_Registry::getInstance()->constants->salt_auth;
		$dataLogin = $this->_getDataLogin();
		
		$authAdapter->setTableName('cv_utilisateurs')
			->setIdentityColumn('login')
			->setCredentialColumn('password')
			->setCredentialTreatment("SHA1(CONCAT(?,'$staticSalt'))");
		
		$authAdapter->setIdentity($dataLogin['username']);
		$authAdapter->setCredential($dataLogin['password']);
		
		$auth = Zend_Auth::getInstance();
		$result = $auth->authenticate($authAdapter);
		
		switch ($result->getCode()) {
			case Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND :
				return false;
			break;
			
			case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID :
				return false;
			break;
			
			case Zend_Auth_Result::SUCCESS:
				// Ecriture des infos users
				$authStorage = $auth->getStorage();
                $authStorage->write($authAdapter->getResultRowObject(null, 'password')); 
                // Permet de regénérer l'identifiant de la session
                Zend_Session::regenerateId();
				return true;
			break;
			
			default : $this->view->error = $this->_helper->messages('Mauvais login ou mauvais mot de passe.', Zend_Registry::getInstance()->constants->message->type->alert);
			break;
		}
	}
	
	
	public function logoutAction ()
	{
		Zend_Auth::getInstance()->clearIdentity();
		Zend_Session::destroy();
    	$this->_redirect('/');
	}
	
}
