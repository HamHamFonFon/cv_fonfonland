<?php
class Admin_Form_Experiences extends Zend_Form
{
	
	public function init()
	{
		$acl = new Fonfonblog_Acl();
		
		$this->setMethod('post');
		$this->setName('experienceAdmin');
		$this->setOptions(array('class' => 'form-horizontal'));
		
		//Hash
		$token = new Zend_Form_Element_Hash('no_csrf');
		$token->initCsrfToken();
		$token->removeDecorator('Label');
		//$this->addElement($token, 'no_csrf', array('salt' => $this->__createSalt()));
		
		$libExperience = new Zend_Form_Element_Text('lib_emploi');
		$libExperience->setOptions(array('class' => 'form-control'))
						->setLabel('Nom de la société')
						->setRequired(true)
						->addValidator('NotEmpty', true, array('messages' => 'Champ obligatoire'))
						;
		$this->addElement($libExperience);
		
		
		// Liste des competences principalms
		$sltTypePoste = new Zend_Form_Element_Select('id_type_poste');
		$sltTypePoste->setOptions(array('class' => 'form-control'))
						->setLabel('Type de poste')
						->setRequired(true)
						;
		$this->addElement($sltTypePoste);
		
		// Liste des competences principalms
		$sltTypeSoc = new Zend_Form_Element_Select('id_type_societe');
		$sltTypeSoc->setOptions(array('class' => 'form-control'))
						->setLabel('Type de société')
						->setRequired(true)
						;
		$this->addElement($sltTypeSoc);
		
		// Ville
		$libVille = new Zend_Form_Element_Text('lieu');
		$libVille->setOptions(array('class' => 'form-control'))
						->setLabel('Ville')
						->setRequired(true)
						->addValidator('NotEmpty', true, array('messages' => 'Champ obligatoire'))
						;
		$this->addElement($libVille);
		
		//Position
		//@todo : filtre que numerique
		$libPosition = new Zend_Form_Element_Text('tri_emploi');
		$libPosition->setOptions(array('class' => 'form-control'))
						->setLabel('Position (desc)')
						->setRequired(true)
						->addValidator('NotEmpty', true, array('messages' => 'Champ obligatoire'))
						//->addFilter('AlphaNum')
						;
		$this->addElement($libPosition);
		
		if ($acl->isAllowed(Zend_Auth::getInstance()->getStorage()->read()->roles, 'btnFormAdministration')) {
			$submit = new Zend_Form_Element_Submit('Envoyer');
			$submit->setAttrib('id', 'submitFrmInscription');
			$submit->setOptions(array('class' => 'btn btn-primary'));
			$this->addElement($submit);
		} else {
			$submit = new Zend_Form_Element_Button('Envoyer');
			$submit->setOptions(array('class' => 'btn btn-primary'));
			$this->addElement($submit);
		}
		
		
		
	}
	
}
