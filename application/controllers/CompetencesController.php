<?php
class CompetencesController extends Zend_Controller_Action
{
	
	private $_tabCompetences = array();
	
	/*public function init()
    {
    	$response = $this->getResponse();
		$response->insert('sidebar', $this->view->render('sidebar.phtml'));	
    }*/
	
	public function indexAction ()
	{
		$this->view->title = "Compétences informatique";
		$this->view->tabCompetences = $this->_getCompetences();
	}
	
	private function _getCompetences ()
	{
		$oCompetences = new Application_Model_DbTable_Competences();
		$tabDataCompetences = $oCompetences->getAllCompetences();
		
		foreach ($tabDataCompetences as $key=>$tabDataCompetence) {
			$this->_tabCompetences[$tabDataCompetence['lib_competence_principale']][] = array('id_competence' => $tabDataCompetence['id_competence'], 'lib_competence' => $tabDataCompetence['lib_competence']);
		}
		
		return $this->_tabCompetences;
	}
	
}