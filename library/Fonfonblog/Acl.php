<?php
class Fonfonblog_Acl extends Zend_Acl
{
	
	public function __construct ()
	{
		// Rôles
		$this->_initRoles();
		// Ressources
		$this->_initRessources();
		$this->_initRessourcesAdmin();
		// Autorisations
		$this->_initAllow();
	}
	
	// Ajout des rôles
	private function _initRoles ()
	{
		$this->addRole(new Zend_Acl_Role('guest'));
		$this->addRole(new Zend_Acl_Role('utilisateur'), 'guest');
		$this->addRole(new Zend_Acl_Role('moderateur'), 'utilisateur');
		$this->addRole(new Zend_Acl_Role('administrateur'), 'moderateur');
	}
	
	// Ajout des ressources
	private function _initRessources ()
	{
		// Controllers
		$this->add(new Zend_Acl_Resource('error'));
		$this->add(new Zend_Acl_Resource('auth'));
		$this->add(new Zend_Acl_Resource('index'));
		$this->add(new Zend_Acl_Resource('documents'));
		$this->add(new Zend_Acl_Resource('emplois'));
		$this->add(new Zend_Acl_Resource('competences'));
		$this->add(new Zend_Acl_Resource('contact'));
		$this->add(new Zend_Acl_Resource('tests-scripts'));
		
		//Menu navigation
		$this->add(new Zend_Acl_Resource('utilisateurs'));
		$this->add(new Zend_Acl_Resource('administration'));
		
	}
	
	// Ajout des ressources propres au module d'administration
	private function _initRessourcesAdmin()
	{
		$this->add(new Zend_Acl_Resource('admin_index'));
		$this->add(new Zend_Acl_Resource('admin_competences'));
		$this->add(new Zend_Acl_Resource('admin_experiences'));
		$this->add(new Zend_Acl_Resource('admin_missions'));
	}
	
	// Autorisations
	private function _initAllow ()
	{
		$this->allow('guest', 'error', 'error');
        $this->allow('guest', 'auth', 'login');
        $this->allow('guest', 'index', 'index');
		$this->allow('guest', 'emplois', 'index');
		$this->allow('guest', 'competences', 'index');
		$this->allow('guest', 'documents', 'cv');
		$this->allow('guest', 'contact', 'index');
		
		// Autorisation utilisateur
		$this->allow('utilisateur', 'auth', 'logout');
		$this->allow('utilisateur', 'utilisateurs', 'view');
		
		// Autorisation moderateur
		
		// Autorisation administrateur
		$this->allow('administrateur', 'administration');
		$this->allow('administrateur', 'admin_index', array('index'));
		$this->allow('administrateur', 'admin_competences', array('list', 'edit', 'add', 'delete'));
		$this->allow('administrateur', 'admin_experiences', array('list', 'edit', 'add', 'delete'));
		$this->allow('administrateur', 'admin_missions', array('edit', 'add', 'delete'));
	}
}