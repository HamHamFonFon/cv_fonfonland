<?php
class Application_Form_Contact extends Zend_Form
{
	
	public function init()
	{
		$this->setMethod('post');
		$this->setAction('/contact/index');
		$this->setOptions(array('class' => 'form-horizontal'));
		
		// token
		$token = new Zend_Form_Element_Hash('no_csrf');
		$token->initCsrfToken();
		$token->removeDecorator('Label');
		$this->addElement($token, 'no_csrf', array('salt' => $this->__createSalt()));
		
		// Champ email
		$email = new Zend_Form_Element_Text('email');
		$email->setOptions(array('class' => 'form-control'))
				->setLabel('Adresse email (*)')
				->setRequired(true)
				->addValidator('EmailAddress', true, array('messages' => 'Mauvais format d\'adresse mail'))
				->addValidator('NotEmpty', true, array('messages' => 'Champ obligatoire'))
				->getDecorator('Errors')->setOption('class', 'text-danger');
		$this->addElement($email);
		
		// champ sujet
		$subject = new Zend_Form_Element_Text('subject');
		$subject->setOptions(array('class' => 'form-control'))
				->setLabel('Sujet du message (*)')
				->setRequired(true)
				->addValidator('NotEmpty', true, array('messages' => 'Champ obligatoire'))
				->getDecorator('Errors')->setOption('class', 'text-danger');;
		$this->addElement($subject);
		
		// champ texte
		$message = new Zend_Form_Element_Textarea('message');
		$message->setOptions(array('class' => 'form-control', 'rows' => 10))
				->setLabel('Message (*)')
				->setRequired(true)
				->addValidator('NotEmpty', true, array('messages' => 'Champ obligatoire'))
				->getDecorator('Errors')->setOption('class', 'text-danger');;;
		$this->addElement($message);
		
		// captcha
		// Un captcha
        $captcha = new Zend_Form_Element_Captcha('foo', array(
		    'label' => "Merci de confirmer que vous êtes humain (*)",
		    'captcha' => 'Figlet',
		    'captchaOptions' => array(
		        'captcha' => 'Figlet',
		        'wordLen' => 6,
		        'timeout' => 300,
		    ),
		));
		$captcha->setOptions(array('class' => 'form-control'));
		$this->addElement($captcha);
		
        /*'captcha', 'captcha', array(
            'label'      => 'Please enter the 5 letters displayed below:',
            'required'   => true,
            'captcha'    => array(
                'captcha' => 'Figlet',
                'wordLen' => 5,
                'timeout' => 300
            )
        ));*/
		
		
		//boutons
		$submit = new Zend_Form_Element_Submit('btnSubmit');
		$submit->setOptions(array('class' => 'btn btn-primary'))
				->setLabel('Envoyer');
		$this->addElement($submit);
		
		// message
		$txt = new Zend_Form_Element_Note('note');
		$txt->setLabel('Les champs marqués d\'un * sont obligatoire')
			->setOptions(array('class' => 'text-danger'));
		$this->addElement($txt);
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
