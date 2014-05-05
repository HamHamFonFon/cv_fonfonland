<?php
class Application_Model_DbTable_Missions extends Zend_Db_Table_Abstract
{
	protected $_name = 'missions';
	protected $_primary = 'id_mission';
	protected $_id;
	protected $_dependentTables = array('Application_Model_DbTable_MissionsHasCompetences');

	public function getId() {
		return $this->_id;
	}

	public function setId ($id)
	{
		$this->_id = $id;
	}
	
	public function getMissionsByIdEmploi ($idEmploi)
	{
		$select = $this->select()->from($this->_name, array('id_mission'));
		$select->where('id_emploi = ?', $idEmploi);
		$rowSet = $this->fetchAll($select);
		
		$tabMissionArray = array();
		
		foreach ($rowSet->toArray() as $key=>$row) {
			$this->setId($row['id_mission']);
			array_push($tabMissionArray, $this->_getInfoMission());
		}

		return $tabMissionArray;
	}

	/**
	 * Retourne les données d'une mission
	 */
	private function _getInfoMission ()
	{
		$tabDataMission = $this->find($this->getId());
		
		$rowsetCurrent = $tabDataMission->current();
		
		$tabDataMission = $tabDataMission->toArray();
		$tabDataMission[0]['env_tech'] = $this->_getEnvTechnique($rowsetCurrent);
		
		return $tabDataMission[0];
	}

	/**
	 * Retourne les competences techniques pour une mission
	 */
	private function _getEnvTechnique ($current)
	{
		$competencesByMission = $current->findManyToManyRowset('Application_Model_DbTable_Competences', 'Application_Model_DbTable_MissionsHasCompetences');
		$listeCompetences = array();
		foreach ($competencesByMission as $key=>$competence) {
			$listeCompetences[$competence['id_competence']] = $competence['lib_competence'];
		}
		//$listeCompetences = implode(', ', array_values($listeCompetences));
		
		return $listeCompetences;
	}

}	