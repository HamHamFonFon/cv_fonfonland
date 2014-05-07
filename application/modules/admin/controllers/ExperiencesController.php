<?php
class Admin_ExperiencesController extends Zend_Controller_Action
{
	
	public $_idExperience;
	
	public function init()
	{
		
	}
	
	public function listAction ()
	{
		$this->view->title = "Administration des experiences";
		$this->view->linkAdd = $this->_helper->linkControllerMVC('add');
		
		$tabAllExperiences = array();
		$oModelExperiences = new Application_Model_DbTable_Emplois();
		
		foreach ($oModelExperiences->getAllEmplois() as $key=>$tabExperience) {
			$tabAllExperiences[$key] = $tabExperience;
			$tabAllExperiences[$key]['linkEdit'] = $this->_helper->linkControllerMVC('edit', array('id' => $tabExperience['id_emploi']));
			$tabAllExperiences[$key]['linkDel'] = $this->_helper->linkControllerMVC('delete', array('id' => $tabExperience['id_emploi']));
		}
		
		$this->view->tabExperiences = $tabAllExperiences; 
	}

	public function addAction ()
	{
		$this->view->title = "Ajouter une expérience";
		
		$formExperience = $this->_generateFormExperience($this->getRequest()->getActionName());
		$this->view->formExperiences = $formExperience;
		
		// Sauvegarde
		if ($this->getRequest()->isPost()) {
			if ($formExperience->isValid($this->getRequest()->getPost())) {
				$dataExperience = $this->getRequest()->getPost();
				unset($dataExperience["Envoyer"]);
				
				$oModelExperiences = new Admin_Model_DbTable_Emplois();
				if($oModelExperiences->insert($dataExperience)){
					$this->view->message = $this->_helper->messages("Insertion de données OK.", Zend_Registry::getInstance()->constants->message->type->ok);       
				} else {
					$this->view->error = $this->_helper->messages("Problème d'insertion de données'.", Zend_Registry::getInstance()->constants->message->type->alert);       
					$formExperience->populate($dataExperience);
				}
				//Zend_Debug::dump($this->getRequest()->getPost());
			}
		}
	}
	
	/**
	 * Action edition d une experience
	 * 
	 * @return
	 */
	public function editAction ()
	{
		$this->_idExperience = $this->getRequest()->getParam('id');
		$this->view->title = "Modifier une expérience";
		
		// Formulaire experience
		$formExperience = $this->_generateFormExperience($this->getRequest()->getActionName() . '/id/' . $this->_idExperience);
		$this->view->formExperiences = $formExperience;
		
		// Formulaire mission Edition
		$formMissionsEdit = $this->_generateFormMission();
		$formMissionsEdit->setName('formAdminMissionsEdit')->setAction('/admin/missions/edit/'); // @TODO
		$formMissionsEdit->getElement('id_emploi')->setValue($this->_idExperience);
		$formMissionsEdit->getElement('date_debut')->setName("date_debut_edit");
		$formMissionsEdit->getElement('date_fin')->setName("date_fin_edit");
		//Zend_Debug::dump($this->_getListeCompetencesOrderByCp());
		$formMissionsEdit->getElement('env_tech')->addMultiOptions($this->_getListeCompetencesOrderByCp());
		$this->view->formMissionEdit = $formMissionsEdit;
		
		// Formulaire mission Ajout
		$formMissionsAdd = $this->_generateFormMission();
		$formMissionsAdd->setName('formAdminMissionsAdd')->setAction("/admin/missions/add");
		$formMissionsAdd->getElement('id_emploi')->setValue($this->_idExperience);
		$formMissionsAdd->getElement('date_debut')->setName("date_debut_add");
		$formMissionsAdd->getElement('date_fin')->setName("date_fin_add");
		$formMissionsAdd->getElement('env_tech')->setMultiOptions($this->_getListeCompetencesOrderByCp());
		$this->view->formMissionAdd = $formMissionsAdd;
		
		$this->view->idExperience = $this->_idExperience;
		if ($this->getRequest()->isPost()) {
			//@todo 
			if ($formExperience->isValid($this->getRequest()->getPost())) {
				
				$dataUpdExperience = $this->getRequest()->getPost();
				unset($dataUpdExperience["Envoyer"]);
				$where = array(
                    'id_emploi = ?' => $this->_idExperience,
                );
                
                //Zend_Debug::dump($dataUpdExperience); exit;
                $oModelAdminExperiences = new Admin_Model_DbTable_Emplois();
                if (count($oModelAdminExperiences->update($dataUpdExperience, $where)) > 0) {
						$linkList = $this->_helper->linkControllerMVC('list');
                    	$this->_redirect($linkList);
                    } else {
                    	$this->view->error = $this->_helper->messages("Problème de sauvegarde, veuillez vérifier les données envoyées.", Zend_Registry::getInstance()->constants->message->type->alert);
                    	$formExperience->populate($dataUpdExperience);
                    }
			}
			
		} else {
			// Recuperation des informations de l experience (avec mission)
			$oModelExperiences = new Application_Model_DbTable_Emplois();
			$oModelExperiences->setId($this->_idExperience);
			$tabInfoEmploi = $oModelExperiences->getEmploiById();
			
			$formExperience->populate($tabInfoEmploi['emploi'][0]);
			
			// Formatage de la date
			$oGestionDate = new Fonfonblog_Controller_FormatageDate();
			
			foreach ($tabInfoEmploi['missions'] as $key=>$mission) {
				$tabInfoEmploi['missions'][$key]['date_debut_edit'] = (isset($mission['date_debut'])) ? $oGestionDate->dateToInput($mission['date_debut']) : null;
				$tabInfoEmploi['missions'][$key]['date_fin_edit'] = (isset($mission['date_fin'])) ? $oGestionDate->dateToInput($mission['date_fin']) : null;
				
				unset($tabInfoEmploi['missions'][$key]['date_debut']);
				unset($tabInfoEmploi['missions'][$key]['date_fin']);
			}
			
			//Zend_Debug::dump($tabInfoEmploi['missions'][0]['env_tech']);
			// Recuperation des missions
			if (count($tabInfoEmploi['missions']) > 1) {
				$this->view->tabMissionsJson = Zend_Json::encode($tabInfoEmploi['missions']);
				$this->view->listeMissions = array_merge(array(null => "Liste des missions"), $this->_getListesMissionsByExperience($tabInfoEmploi['missions'])); 
				
			} else {
				// Si une mission, on la place ds le formulaire
				$this->view->listeMissions = null;
				//print_r(array_keys($tabInfoEmploi['missions'][0]['env_tech']));
				$formMissionsEdit->populate($tabInfoEmploi['missions'][0]);
				$formMissionsEdit->getElement('env_tech')->setValue(array_keys($tabInfoEmploi['missions'][0]['env_tech']));
			}
			
			// Pour la section deleteMission, creation d'une liste des missions
			$this->view->listeMissionsForDel = $this->_getListeMissionsForDelete($tabInfoEmploi['missions']);
			$this->view->linkDelMission = $this->_helper->linkControllerMVC('deleteMission', array("emploi" => $this->_idExperience, 'id' => ''));
		}
	}
	
	/**
	 * Action de suppression d une experience/emploi
	 */
	public function deleteAction ()
	{
		$this->_helper->layout()->disableLayout(); 
		$this->_helper->viewRenderer->setNoRender(true);
	    			
		$idExperience = $this->getRequest()->getParam('id');
		if (isset($idExperience) && !empty($idExperience)) {
			$oModelEmploisAdmin = new Admin_Model_DbTable_Emplois();
			$oModelEmploisAdmin->setId($idExperience);
			if($oModelEmploisAdmin->deleteExperience()) {
				$this->view->message = $this->_helper->messages("Suppression réussie.", Zend_Registry::getInstance()->constants->message->type->ok);      
            	$this->_redirect($this->_helper->linkControllerMVC('list'));
			} else {
				$this->view->error = $this->_helper->messages("Erreur de suppression.", Zend_Registry::getInstance()->constants->message->type->warning);      
			}
		} else {
			$this->view->error = $this->_helper->messages("Aucune données envoyées.", Zend_Registry::getInstance()->constants->message->type->alert);      
		}

	}
	
	/**
	 * Creation du formulaire commun
	 * @param string $action
	 * @return Zend_Form $oformExperiences
	 */
	private function _generateFormExperience($action)
	{
		// Instance du formulaire		
		$oformExperiences = new Admin_Form_Experiences(); 
		
		// On remplie la liste deroulante des competences principales
		$oformExperiences->getElement('id_type_poste')->setMultiOptions($this->_getListTypePostes());
		$oformExperiences->getElement('id_type_societe')->setMultiOptions($this->_getListTypeSocietes());
		
		// Set de "Action" du formulaire
		$oformExperiences->setAction('/' . $this->getRequest()->getModuleName() . '/' . $this->getRequest()->getControllerName() . '/' . $action);
		
		return $oformExperiences;
	}
	
	/**
	 * Generation de la liste deroulantes de types de postes
	 * @return array
	 */
	private function _getListTypePostes ()
	{
		$oModelTypePostes = new Application_Model_DbTable_RTypesPostes();
		return $oModelTypePostes->getListe();
	}
	
	/**
	 * Generation de la liste de type de societes
	 * @return array
	 */
	private function _getListTypeSocietes ()
	{
		$oModelTypeSocietes = new Application_Model_DbTable_RTypeSocietes();
		return $oModelTypeSocietes->getListe();
	}
	
	/**
	 * Generation du formulaire de mission
	 * @return Zend_Form formulaire de mission
	 */
	 private function _generateFormMission ()
	 {
	 	$oFormMission = new Admin_Form_Missions();
	 	return $oFormMission;
	 }
	 
	/**
	 * Generation d'une liste deroulante de missions
	 * @param array $tabMissions tableaux des missions
	 * @return array tableau des libelle de missions
	 */
	private function _getListesMissionsByExperience ($tabMissions)
	{
		$listeMission = array();
		foreach ($tabMissions as $key=>$tabMission) {
			$listeMission[$key] = $tabMission['lib_mission'];
		}
		return $listeMission;
	}
	
	/**
	 * Generation d une liste deroulante de mission idMission => libMission
	 * Utilise pour la suppression d une mission
	 * @param array $tabMissions
	 * @return array $listeMissionForDel
	 */
	private function _getListeMissionsForDelete ($tabMissions)
	{
		$listeMissionForDel = array();
		foreach ($tabMissions as $key=>$tabMission) {
			$listeMissionForDel[$tabMission['id_mission']] = (isset($tabMission['lib_mission']) && !empty($tabMission['lib_mission'])) ? $tabMission['lib_mission'] : $tabMission['intitule_mission'];
		}
		return $listeMissionForDel;
	}
	
	/**
	 * Generation de la liste de competences classées par competences principales
	 * utilisée pour le formulaire "Missions"
	 * 
	 * @return array $tabListeCompetencesByCp
	 */
	 private function _getListeCompetencesOrderByCp ()
	 {
	 	// Recuperation du contenu de ma table "competences"
	 	$oModelCompetences = new Application_Model_DbTable_Competences();
	 	$tabListe = $oModelCompetences->getAllCompetences();
	 	$tabListeCompetencesByCp = array();
	 	// mise en forme du tableau de données
	 	foreach ($tabListe as $key=>$tabCompetence) {
	 		//$tabListeCompetencesByCp[$tabCompetence['id_competence']] = $tabCompetence['lib_competence'];
	 		$tabListeCompetencesByCp[$tabCompetence['lib_competence_principale']][$tabCompetence['id_competence']] = $tabCompetence['lib_competence'];
	 	}
	 	return $tabListeCompetencesByCp;
	 }
	 
	 /**
	  * Suppression d une mission
	  * 
	  * @param getParam $idMission
	  */
	 public function deleteMissionAction ()
	 {
	 	$this->_helper->layout()->disableLayout(); 
		$this->_helper->viewRenderer->setNoRender(true);
		
	 	$idMission = $this->getRequest()->getParam('id');
	 	$idEmploi = $this->getRequest()->getParam('emploi');
	 	
	 	$oAdminMissionModel = new Admin_Model_DbTable_Missions();
	 	$oAdminMissionModel->setId($idMission);
	 	if ($oAdminMissionModel->deleteMission()) {
	 		$this->view->message = $this->_helper->messages("Suppression de la mission réussie.", Zend_Registry::getInstance()->constants->message->type->ok);      
	 	} else {
	 		$this->view->error = $this->_helper->messages("Problème de suppression.", Zend_Registry::getInstance()->constants->message->type->error);      
	 	}
	 	
	 	$this->_forward("edit", "experiences", "admin", array("id" => $idEmploi));
	 }
}
