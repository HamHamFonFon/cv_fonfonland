<?php
class Application_Model_DbTable_CompetencesPrincipales extends Zend_Db_Table_Abstract
{
	protected $_name = 'competences_principales';
	protected $_primary = 'id_competence_principale';

	/**
	 * Liste toutes les competences principales
	 */	
	public function getAllCompetencesPrincipales ()
	{
		$sql = 'SELECT ' . $this->_primary . ', lib_competence_principale FROM ' . $this->_name;
		return $this->getDefaultAdapter()->fetchPairs($sql);
	}
	
}