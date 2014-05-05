<?php
class Admin_CompetencesController extends Zend_Controller_Action
{
	
	public function init () {}
	
	public function listAction ()
	{
		$this->view->title = "Administration des compétences";
		
		$this->view->linkAdd = $this->_helper->linkControllerMVC('add');
		
		// Pour recuperer la liste des competences, on va utiliser le Model par defaut
		$oModelCompetences = new Application_Model_DbTable_Competences();
		
		$tabAllCompetences = array();
		foreach ($oModelCompetences->getAllCompetences() as $key=>$tabCompetence) {
			$tabAllCompetences[$key] = $tabCompetence;
			$tabAllCompetences[$key]['linkEdit'] = $this->_helper->linkControllerMVC('edit', array('id' => $tabCompetence['id_competence']));
			$tabAllCompetences[$key]['linkDel'] = $this->_helper->linkControllerMVC('delete', array('id' => $tabCompetence['id_competence']));
		}
		$this->view->tabCompetences = $tabAllCompetences; 
	}
	
	public function addAction () 
	{ 
		$this->view->title = "Ajouter une compétence";
		$formCompetence = $this->_generateFormCompetence($this->getRequest()->getActionName());
		$this->view->formCompetencesAdd = $formCompetence;
		
		// Sauvegarde
		if ($this->getRequest()->isPost()) {
			if ($formCompetence->isValid($this->getRequest()->getPost())) {
				$data = array(
                    'id_competence_principale' => $formCompetence->getValue("id_competence_principale"),
                    'lib_competence' => $formCompetence->getValue("lib_competence"),
                );
                
                $oModelCompetenceAdmin = new Admin_Model_DbTable_Competences();
                if(!$oModelCompetenceAdmin->insert($data)) {
                	$this->view->error = $this->_helper->messages("Problème d'insertion de données'.", Zend_Registry::getInstance()->constants->message->type->alert);            
                } else {
					$linkList = $this->_helper->linkControllerMVC('list');
                	$this->_redirect($linkList);
                }
			} else {
				$this->view->error = $this->_helper->mesages("Veuillez vérifier les données envoyées.", Zend_Registry::getInstance()->constants->message->type->warning);             	
			}
		} else {
			//$formCompetence->populate();
		}
	}
	
	public function editAction () 
	{
		$idCompetence = $this->getRequest()->getParam('id');
		$this->view->title = "Modification d'une compétence";
		
		$formCompetence = $this->_generateFormCompetence($this->getRequest()->getActionName() . '/id/' . $idCompetence);
		$this->view->formCompetencesEdit = $formCompetence;
		
		if ($this->getRequest()->isPost()) {
			if ($formCompetence->isValid($this->getRequest()->getPost())) {
                    $data = array(
                        'id_competence_principale' => $formCompetence->getValue("id_competence_principale"),
                        'lib_competence' => $formCompetence->getValue("lib_competence"),
                    );
                    $where = array(
                        'id_competence = ?' => $idCompetence,
                    );
                    
                    $oModelCompetenceAdmin = new Admin_Model_DbTable_Competences();
                    
                    //Zend_Debug::dump($data);
                    if (count($oModelCompetenceAdmin->update($data, $where)) > 0) {
						$linkList = $this->_helper->linkControllerMVC('list');
                    	$this->_redirect($linkList);
                    } else {
                    	$this->view->error = $this->_helper->messages("Problème de sauvegarde, veuillez vérifier les données envoyées.", Zend_Registry::getInstance()->constants->message->type->alert);
                    	$formCompetence->populate($data);
                    }
                } else {
					$this->view->error = $this->_helper->messages("Veuillez vérifier les données envoyées.", Zend_Registry::getInstance()->constants->message->type->warning);             	
                }
		} else {
			$oModelCompetence = new Application_Model_DbTable_Competences();
			$tabDatas = $oModelCompetence->getInfosCompetences($idCompetence);
			$formCompetence->populate($tabDatas[0]);
		}
	 }
	
	/**
	 * Creation du formulaire commun
	 */
	private function _generateFormCompetence ($action)
	{
		// Instance du formulaire		
		$oformCompetences = new Admin_Form_Competences(); 
		
		// On remplie la liste deroulante des competences principales
		$oCompetencesPrincipales = new Application_Model_DbTable_CompetencesPrincipales();
		$tabCompetencesPrincpales = $oCompetencesPrincipales->getAllCompetencesPrincipales();
		$oformCompetences->getElement('id_competence_principale')->setMultiOptions($tabCompetencesPrincpales);
		
		// Set de "Action" du formulaire
		$oformCompetences->setAction('/' . $this->getRequest()->getModuleName() . '/' . $this->getRequest()->getControllerName() . '/' . $action);
		
		return $oformCompetences;
	}
	
	public function deleteAction () 
	{
		$this->_helper->layout()->disableLayout(); 
		$this->_helper->viewRenderer->setNoRender(true);
	    			
		$idCompetence = $this->getRequest()->getParam('id');
		if (isset($idCompetence) && !empty($idCompetence)) {
			$oModelCompetenceAdmin = new Admin_Model_DbTable_Competences();
			if($oModelCompetenceAdmin->deleteCompetence($idCompetence)) {
				$this->view->message = $this->_helper->messages("Suppression réussie.", Zend_Registry::getInstance()->constants->message->type->ok);      
            	$this->_redirect($this->_helper->linkControllerMVC('list'));
			} else {
				$this->view->error = $this->_helper->messages("Erreur de suppression.", Zend_Registry::getInstance()->constants->message->type->warning);      
			}
		} else {
			$this->view->error = $this->_helper->messages("Aucune données envoyées.", Zend_Registry::getInstance()->constants->message->type->alert);      
		}
	}
}
