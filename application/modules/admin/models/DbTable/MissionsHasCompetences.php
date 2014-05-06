<?php
class Admin_Model_DbTable_MissionsHasCompetences extends Zend_Db_Table_Abstract
{
	protected $_name = 'missions_has_competences';
	
	/**
	 * Ajout des comeptences à une mission
	 */
	public function addCompetencesByIdMission ($idMission, $tabCompetences)
	{
		if (isset($idMission) && !empty($idMission)) {
			foreach ($tabCompetences as $competence) {
				$this->insert(array("missions_id_mission" => $idMission, "competences_id_competence" => $competence));
			}
		} else {
			return null;
		}
		
	}
	
	/**
	 * Mise à jour des competences
	 */
	public function editCompetencesByIdMission ($idMission, $tabCompetences)
	{
		// On supprime les competences existantes
		$whereDel = $this->getAdapter()->quoteInto('missions_id_mission = ?', $idMission);
		$this->delete($whereDel);
		
		// Ajout des nouvelles competences
		$this->addCompetencesByIdMission($idMission, $tabCompetences);
	}
}