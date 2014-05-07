<?php
class Application_Model_DbTable_Emplois extends Zend_Db_Table_Abstract
{
	
	protected $_name = "emplois";
	protected $_primary = "id_emploi";
	
	private $_tabExperiences = array();
	private $_id;
	
	private function getId ()
	{
		return $this->_id;
	}
	
	public function setId ($id)
	{
		$this->_id = $id;
	}
	
	/**
	 * Retourne la liste complet des emplois
	 * 
	 * @return array : $_tabExperiences
	 */
	public function getAllEmplois ()
	{
		
		$select = $this->getDefaultAdapter()->select()
					->from(array('e' => $this->_name), array($this->_primary, 'lib_emploi', 'lieu', 'tri_emploi'))
					->joinLeft(array('ts' => 'r_type_societes'), 'ts.id_type_societe = e.id_type_societe', array('lib_type_societe'))
					->joinLeft(array('tp' => 'r_type_postes'), 'tp.id_type_poste = e.id_type_poste', array('lib_type_poste'))
					->order('tri_emploi DESC');
		//echo $select->__toString();
		
		$tabListeEmplois =  $select->query()->fetchAll();
		
		foreach ($tabListeEmplois as $key=>$emploi) {
			$this->setId($emploi[$this->_primary]);
			$this->_tabExperiences[$key] = array_merge($emploi, array('missions' => $this->_getMissionsByIdEmploi()));
		}
		return $this->_tabExperiences;
	}
	
	/**
	 * Retourne un emploi filtré par son ID
	 */
	public function getEmploiById ()
	{
		$tabInfos['emploi'] = $this->find($this->_id)->toArray();
		$tabInfos['missions'] = $this->_getMissionsByIdEmploi($this->_id);
		return $tabInfos;
	}
	
	/**
	 * Retourne un tableau de missions selon la valeur de id_emploi
	 */
	private function _getMissionsByIdEmploi ()
	{
		$oMissions = new Application_Model_DbTable_Missions();
		return $oMissions->getMissionsByIdEmploi($this->getId());
	}
	
}