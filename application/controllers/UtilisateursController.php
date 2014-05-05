<?php
class UtilisateursController extends Zend_Controller_Action {
	

	public function init ()
	{
		
	}
	
	public function inscriptionAction ()
	{
		$this->view->pageTitle = "Inscription";
		$this->view->formInscription = new Application_Form_Inscription();
	}
	
	
}