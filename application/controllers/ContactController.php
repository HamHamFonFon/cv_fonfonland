<?php
class ContactController extends Zend_Controller_Action
{
	/**
	 * Page de formulaire de contact
	 */
	public function indexAction ()
	{
		$this->view->pageTitle = "Me contacter";
		$formContact = new Application_Form_Contact();
		$this->view->form = $formContact;
		
		$request = $this->getRequest();
		
		if ($request->isPost()) {
			
			if ($formContact->isValid($request->getPost())) {
				
				$dataMail = $request->getPost();
				//Zend_Debug::dump($dataMail);
				
				$mail = new Zend_Mail('UTF-8');
				//$mail->setBodyText($dataMail['message']);
				$mail->setBodyHtml($dataMail['message'], 'UTF-8', Zend_Mime::ENCODING_8BIT);
				$mail->setFrom($dataMail['email'], '');
				$mail->addTo('stephane.meaudre@gmail.com', 'un destinataire');
				$mail->setSubject($dataMail['subject']);
				$mail->send();
				
				$this->view->mailOk = $this->_helper->messages("Votre courrier a bien été envoyé.", Zend_Registry::getInstance()->constants->message->type->ok);
			} else {
				$this->view->error = $this->_helper->messages("Veuillez vérifier les données envoyées.", Zend_Registry::getInstance()->constants->message->type->alert);
			}
		}	
	}
	
}
