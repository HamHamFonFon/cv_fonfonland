<?php
class Application_Model_DbTable_Competences extends Zend_Db_Table_Abstract
{
	protected $_name = 'competences';
	protected $_primary = 'id_competence';
	protected $_dependentTables = array('Application_Model_DbTable_MissionsHasCompetences');
	
	/**
	 * Retourne le contenu de la table competence
	 * 
	 * @return resultat de requete SQL 
	 */
	public function getAllCompetences ()
	{
		$select = $this->getDefaultAdapter()->select()
					->from(array('c' => $this->_name), array($this->_primary , 'lib_competence'))
					->joinLeft(array('cp' => 'competences_principales'), 'cp.id_competence_principale = c.id_competence_principale', array('lib_competence_principale'))
					;	
		return $select->query()->fetchAll();
	}
	
	
	/**
	 * Retourne les informations d'une competence
	 * @param integer $idComptence
	 * 
	 * @return array tableau des donnees d'une competence
	 */
	public function getInfosCompetences ($idCompetence)
	{
		return $this->find($idCompetence)->toArray();
	}
}