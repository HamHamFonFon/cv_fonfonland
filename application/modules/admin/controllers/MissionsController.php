<?php
class Admin_MissionsController extends Zend_Controller_Action
{
	
	public function addAction ()
	{
		$this->_helper->layout()->disableLayout(); 
		$this->_helper->viewRenderer->setNoRender(true);
		
		$linkErrorToTredirect = new Zend_Navigation_Page_Mvc(array( 
				'module' => $this->getRequest()->getModuleName(),
				'controller' => "experiences",
				'action' => "list",
			));
		
		$oGestionDate = new Fonfonblog_Controller_FormatageDate();
		
		if ($this->getRequest()->isPost()) {
			$request = $this->getRequest();
			// Mise en forme des tableaux de données
			list($dataMissions, $dataCpMissions) = $this->_formatDatas($request->getPost(), "add");
			
			$linkToRedirect = new Zend_Navigation_Page_Mvc(array( 
				'module' => $this->getRequest()->getModuleName(),
				'controller' => "experiences",
				'action' => "edit",
				'params' => array("id" => $dataMissions['id_emploi'])
			));
			
			// On va sauvegarder les données de la mission et recuperer l ID
			// Pour sauvegarder les CP de la missions
			//Zend_Debug::dump($dataCpMissions);
			//Zend_Debug::dump($dataMissions);
			$oModelMission = new Admin_Model_DbTable_Missions();
			if ($oModelMission->insert($dataMissions)) {
				// id de la mission cree
				if (count($dataCpMissions) > 0) {
					$idMission = $oModelMission->getAdapter()->lastInsertId();
					$oModelMissionHasCompetences = new Admin_Model_DbTable_MissionsHasCompetences();
					$oModelMissionHasCompetences->addCompetencesByIdMission($idMission, $dataCpMissions);
				}
				$this->redirect($linkToRedirect->getHref());
			} else {
				$this->redirect($linkToRedirect->getHref());
				$this->view->error = $this->_helper->mesages("Veuillez vérifier les données envoyées.", Zend_Registry::getInstance()->constants->message->type->warning);    
			}
		} else {
			$this->redirect($linkErrorToTredirect->getHref());
		}
	}
	
	public function editAction ()
	{
		$this->_helper->layout()->disableLayout(); 
		$this->_helper->viewRenderer->setNoRender(true);
		
		if ($this->getRequest()->isPost()) {
			$request = $this->getRequest();
			list($dataMissions, $dataCpMissions) = $this->_formatDatas($request->getPost(), "edit");
			$where = array(
            	'id_mission = ?' => $dataMissions['id_mission'],
            );

			//Zend_Debug::dump($dataCpMissions);
			//Zend_Debug::dump($dataMissions);
			//exit;
			$linkToRedirect = new Zend_Navigation_Page_Mvc(array( 
				'module' => $this->getRequest()->getModuleName(),
				'controller' => "experiences",
				'action' => "edit",
				'params' => array("id" => $dataMissions['id_emploi'])
			));
			
			$oModelMission = new Admin_Model_DbTable_Missions();
			if ($oModelMission->update($dataMissions, $where)) {
				if (count($dataCpMissions) > 0) {
					$oModelMissionHasCompetences = new Admin_Model_DbTable_MissionsHasCompetences();
					$oModelMissionHasCompetences->editCompetencesByIdMission($dataMissions['id_mission'], $dataCpMissions);
					
				}
				$this->redirect($linkToRedirect->getHref());
			} else {
				$this->redirect($linkToRedirect->getHref());
			}
		} else {
			$this->redirect($linkToRedirect->getHref());
		}
	}
	
	/**
	 * Mise en forme des données
	 */
	private function _formatDatas ($data, $type)
	{
		$dataMission = $data;
		$dataCpByMissions = array();
		Zend_Debug::dump($dataMission); exit;
		// Mise en forme des dates
		$oGestionDate = new Fonfonblog_Controller_FormatageDate();
		
		if ($type == "add") {
			$dataMission['date_debut'] = (!empty($dataMission['date_debut_add'])) ? $oGestionDate->dateToDb($dataMission['date_debut_add']) : null;
			$dataMission['date_fin'] = (!empty($dataMission['date_fin_add'])) ? $oGestionDate->dateToDb($dataMission['date_fin_add']) : null;
			
			unset($dataMission['date_debut_add']);
			unset($dataMission['date_fin_add']);
			unset($dataMission['id_mission']);
			
		} else if ($type == "edit") {
			$dataMission['date_debut'] = (!empty($dataMission['date_debut_edit'])) ? $oGestionDate->dateToDb($dataMission['date_debut_edit']) : null;
			$dataMission['date_fin'] = (!empty($dataMission['date_fin_edit'])) ? $oGestionDate->dateToDb($dataMission['date_fin_edit']) : null;
			unset($dataMission['date_debut_edit']);
			unset($dataMission['date_fin_edit']);
		}
		
		// Suppression des données inutiles
		unset($dataMission['Envoyer']);
			
		$dataCpByMissions = $dataMission["env_tech"];
		unset($dataMission["env_tech"]);
			
		return array($dataMission, $dataCpByMissions);			
	}
	
	/**
	 * Suppression d une mission
	 */
	/*public function deleteAction ($idMission)
	{
		$this->_helper->layout()->disableLayout(); 
		$this->_helper->viewRenderer->setNoRender(true);
	    			
		$idMission = $this->getRequest()->getParam('id');
	}*/
	
}