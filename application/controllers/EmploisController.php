<?php
class EmploisController extends Zend_Controller_Action
{
	
	private $_tabExperiences = array();
	
	public function init ()
	{
		
	}
	
	public function indexAction ()
	{
		$this->view->title = "Expériences professionnelles";
		$this->view->tabExperiences = $this->_getAllExperiences();
	}
	
	private function _getAllExperiences ()
	{
		$oEmplois = new Application_Model_DbTable_Emplois();
		$this->_tabExperiences = $oEmplois->getAllEmplois();
		return $this->_tabExperiences;
	}
	
}