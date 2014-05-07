<?php
class Application_Model_DbTable_RTypesPostes extends Zend_Db_Table_Abstract
{
	protected $_name = "r_type_postes";
	protected $_primary = "id_type_poste";
	
	/**
	 * Liste de type clé/valeur
	 * @return array
	 */
	public function getListe ()
	{
		$sql = 'SELECT ' . $this->_primary . ', lib_type_poste FROM ' . $this->_name;
		return $this->getDefaultAdapter()->fetchPairs($sql);
	}
}