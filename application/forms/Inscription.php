<?php
class Application_Form_Inscription extends Zend_Form
{
	
	/**
	 * (non-PHPdoc)
	 * @see Zend_Form::init()
	 */
	public function init()
	{
		$this->setMethod('post');
		$this->setOptions(array('class' => 'form-horizontal'));
		
		/*
		 * Token
		 */
		$token = new Zend_Form_Element_Hash('no_csrf');
		$token->initCsrfToken();
		$token->removeDecorator('HtmlTag');
		$token->removeDecorator('Label');
		$this->addElement($token, 'no_csrf', array('salt' => $this->__createSalt()));
		
		/*
		 * Utilisateur
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
		
		// Validator sur longueur de la chaine du mot de passe
		$minLengthAuthorized = new Zend_Validate_StringLength(array('min' => 6));
		$minLengthAuthorized->setMessages(array(Zend_Validate_StringLength::TOO_SHORT => 'Le champ "' . $mdp->getName() . '" doit avoir une taille d\'au moins ' . $minLengthAuthorized->getMin() . ' caractères.'));
		
		$mdp->setRequired(true)
			->addValidator($minLengthAuthorized)
			->setDescription('Minimum 6 charactères')
			->addValidator('NotEmpty', false, array('messages' => 'Le champ "' . $mdp->getName() . '" est obligatoire.'))
			;
		$mdp->setOptions(array('class' => 'form-control'));
		$this->addElement($mdp);
		
		/*
		 * Confirmation du mot de passe
		 */
		$mdp2 = new Zend_Form_Element_Password('password_confirmation');
		$mdp2->setLabel('Conformation mot de passe');
		$mdp2->setRequired(true)
			->addValidator('Identical',false, $this->getValue('password'));
		;
		$mdp2->setOptions(array('class' => 'form-control'));
		$this->addElement($mdp2);
		
		/*
		 * Adresse email
		 */
		$validateMail = new Zend_Validate_EmailAddress();
		$validateMail->setMessage('Adresse email non valide');
		$email = new Zend_Form_Element_Text('email');
		$email->setLabel('Adresse mail');
		$email->setRequired(true)
			->addValidator($validateMail)
		;
		$email->setOptions(array('class' => 'form-control'));
		$this->addElement($email);
		
		// champ date inscription
		/*$dateInscription = new Zend_Date(Zend_Date::W3C);
		//$dateFormat = $dateInscription->get(yyyy-MM-dd);
		
		echo $dateInscription->toString() . '<br>' . $dateFormat;
		$hiddenDate = new Zend_Form_Element_Text('date_inscription');
		$hiddenDate->setValue($dateInscription);
		//$this->addElement($hiddenDate);*/
		
		/*
		 * Captcha
		 */
		$captcha = new Zend_Form_Element_Captcha('foo', array(
		    'label' => "Merci de confirmer que vous n'êtes pas un robot",
		    'captcha' => array(
		        'captcha' => 'Figlet',
		        'wordLen' => 6,
		        'timeout' => 300,
		    ),
		));
		//captcha->setLabel('');
		$this->addElement($captcha);
		
		/*
		 * Boutons submmit et annulation
		 */
		$cancel = new Zend_Form_Element_Button('Annuler');
		$cancel->setOptions(array('class' => 'btn btn-default'));
		$cancel->removeDecorator('dtddwrapper');
		$this->addElement($cancel);
		
		$submit = new Zend_Form_Element_Submit('Envoyer');
		$submit->setAttrib('id', 'submitFrmInscription');
		$submit->setOptions(array('class' => 'btn btn-primary'));
		$submit->removeDecorator('dtddwrapper');
		$this->addElement($submit);
		
		// ajout message
		//$txtMessage = 'Tous les champs doivent être remplis';
		//$this->addElement($txtMessage);
	}
	
	// TODO : deplacer methode dans classe singleton
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