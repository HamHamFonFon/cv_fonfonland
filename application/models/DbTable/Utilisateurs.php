<?php
class Application_Model_DbTable_Utilisateurs extends Zend_Db_Table_Abstract
{
	
	// Declarations des variables
	protected $_name = 'cv_utilisateurs';
	protected $_primary = 'id_utilisateur';
	
	
	private $_id = null;
	private $_login = null;
	private $_level = null;
	private $_email = null;
	private $_role = null;
	
	// Declarations des assesseurs
	public function setId($id) { 
		$this->_id = $id; 
	}
	public function getId() { 
		return $this->_id; 
	}
	
	public function setLogin($login) { 
		$this->_login = $login; 
	}
	public function getLogin() { 
		return $this->_login; 
	}
	
	public function setLevel($level) { 
		$this->_level = $level; 
	}
	public function getLevel() { 
		return $this->_level; 
	}
	
	public function setEmail($email) { 
		$this->_email = $email; 
	}
	public function getEmail() { 
		return $this->_email; 
	}	
	
	// Methodes
	
	// Retourne un utilisateur
	public function findUserById ($idUser)
	{
		if (isset($idUser) && !empty($idUser)) {
			$dataUser = $this->find($idUser)->current();
			
			//Zend_Debug::dump($dataUser);
			if (count($dataUser) > 0) {
				$this->setId($dataUser->id)
					->setLogin()
					->setLevel()
					->setEmail();
			} else {
				return;
			}
		} else {
			return;
		}
		
	}
	
	// Liste tous les users
	public function findAll ()
	{
		return;
	}
	
}	