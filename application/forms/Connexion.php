<?php
class Application_Form_Connexion extends Zend_Form 
{
	
	/**
	 * Decorations des boutons
	 */
	 private $_buttonFormDecorators = array(
        'ViewHelper',
        array(
        	array('data' => 'HtmlTag'),
        	array('tag' => 'table', 'class' => 'td1', 'colspan' => '2', 'align' => 'center')
    	),
        array(
        	array('row' => 'HtmlTag'), 
        	array('tag' => 'tr')
    	)
    );
	 
	 /*private $_cancelDecorators = array(
        'ViewHelper',
        array(array('data' => 'HtmlTag'), array('tag' => 'div', 'class' => 'button')),
        //array(array('row' => 'HtmlTag'), array('tag' => 'div')),
    );
	 
	private $_submitDecorators = array(
        'ViewHelper',
        array(array('data' => 'HtmlTag'), array('tag' => 'div', 'class' => 'button')),
        //array(array('row' => 'HtmlTag'), array('tag' => 'div')),
    );*/
	
	/**
	 * Creation du formulaire de connexion
	 */
	public function init()
	{
		$this->setAction('/auth/login');
		$this->setMethod('post');
		$this->setName('authLogin');
		$this->setOptions(array('class' => 'form-horizontal'));
		
		/*
		 * Login de connexion
		 */
		$login = new Zend_Form_Element_Text('username');
		$login->setLabel('Nom utilisateur');
		$login->setOptions(array('class' => 'form-control'));
		$login->setRequired(true)
				->addValidator('NotEmpty', false, array('messages' => 'Le champ "' . $login->getName() . '" est obligatoire.'))
				->addValidator('Regex', false ,array('pattern' => '#^[\wàâçèéêëîôöùû1-9\s_-]*$#', 'messages' => 'Le "' . $login->getName() . '" choisi contient des caractères non autorisés.'));
				;
				
		$this->addElement($login);
		
		/*
		 * Mot de passe
		 */
		$mdp = new Zend_Form_Element_Password('password');
		$mdp->setLabel('Mot de passe');
		$mdp->setRequired(true)
			->addValidator('NotEmpty', false, array('messages' => 'Le champ "' . $mdp->getName() . '" est obligatoire.'))
			;
		$mdp->setOptions(array('class' => 'form-control'));
		$this->addElement($mdp);
		
		/*
		 * Boutons submmit et annulation
		 */
		/*$cancel = new Zend_Form_Element_Button('Annuler');
		$cancel->setOptions(array('class' => 'btn btn-default'));
		//$cancel->removeDecorator('dtddwrapper');
		$cancel->setDecorators($this->_buttonFormDecorators);
		$this->addElement($cancel);*/
		
		$submit = new Zend_Form_Element_Submit('Envoyer');
		$submit->setAttrib('id', 'submitFrmInscription');
		//$submit->removeDecorator('dtddwrapper');
		//$submit->setDecorators($this->_buttonFormDecorators);
		$submit->setOptions(array('class' => 'btn btn-primary'));
		//
		$this->addElement($submit);
	}
	
}
