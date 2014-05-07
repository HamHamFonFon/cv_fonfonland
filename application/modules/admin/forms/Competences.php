<?php
class Admin_Form_Competences extends Zend_Form
{
	
	private $_tabCompPrincipales = array();
	
	public function init ()
	{
		
		$acl = new Fonfonblog_Acl();
		$this->setMethod('post');
		$this->setName('competenceAdd');
		$this->setOptions(array('class' => 'form-horizontal'));
	
		//Hash
		$token = new Zend_Form_Element_Hash('no_csrf');
		$token->initCsrfToken();
		$token->removeDecorator('Label');
		//$this->addElement($token, 'no_csrf', array('salt' => $this->__createSalt()));
		
		//id
		/*$idCompetence = new Zend_Form_Element_Hidden('id_competence');
		$idCompetence->removeDecorator('Label');
		$this->addElement($idCompetence);*/
		
		//Nom de la competence
		$libCompetence = new Zend_Form_Element_Text('lib_competence');
		$libCompetence->setOptions(array('class' => 'form-control'))
						->setLabel('Compétence')
						->setRequired(true)
						->addValidator('NotEmpty', true, array('messages' => 'Champ obligatoire'))
						;
		$this->addElement($libCompetence);
		
		// Liste des competences principalms
		$sltCompPrinc = new Zend_Form_Element_Select('id_competence_principale');
		$sltCompPrinc->setOptions(array('class' => 'form-control'))
						->setLabel('Compétence principale')
						->setRequired(true)
						;
		$this->addElement($sltCompPrinc);
		
		
		if ($acl->isAllowed(Zend_Auth::getInstance()->getStorage()->read()->roles, 'btnFormAdministration')) {
			$submit = new Zend_Form_Element_Submit('Envoyer');
			$submit->setAttrib('id', 'submitFrmInscription');
			$submit->setOptions(array('class' => 'btn btn-primary'));
		} else {
			$submit = new Zend_Form_Element_Button('Envoyer');
			$submit->setOptions(array('class' => 'btn btn-primary'));
		}
		
		$this->addElement($submit);
		
	}
	
	// TODO : deplacer methode dans helper vue
	private function __createSalt () 
	{
		$salt = '';
		$lgString = 20;
		for ($i = 0; $i < $lgString; $i++) {
			$salt .= chr(rand(33, 126));
		}
		return $salt;
	}
}