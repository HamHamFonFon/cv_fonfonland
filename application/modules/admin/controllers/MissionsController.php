<?php
class Admin_MissionsController extends Zend_Controller_Action
{
	
	public function addAction ()
	{
		$this->_helper->layout()->disableLayout(); 
		$this->_helper->viewRenderer->setNoRender(true);
		
		$oGestionDate = new Fonfonblog_Controller_FormatageDate();
		
		if ($this->getRequest()->isPost()) {
			$request = $this->getRequest();
			$dataAdd = $request->getPost();
			unset($dataAdd['Envoyer']);
			unset($dataAdd['id_mission']);
			
			$dataAdd['date_debut'] = $oGestionDate->dateToDb($dataAdd['date_debut_add']);
			$dataAdd['date_fin'] = $oGestionDate->dateToDb($dataAdd['date_fin_add']);
			
			Zend_Debug::dump($dataAdd);
		} else {
			$this->_forward('list', 'experiences', 'admin');
		}
	}
	
	public function editAction ()
	{
		$this->_helper->layout()->disableLayout(); 
		$this->_helper->viewRenderer->setNoRender(true);
	}
	
}