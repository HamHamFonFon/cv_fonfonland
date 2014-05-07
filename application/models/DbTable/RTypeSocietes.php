<?php
class Application_Model_DbTable_RTypeSocietes extends Zend_Db_Table_Abstract
{
	protected $_name = "r_type_societes";
	protected $_primary = "id_type_societe";
	
	/**
	 * Liste de type clé/valeur
	 * @return array
	 */
	public function getListe ()
	{
		$sql = 'SELECT ' . $this->_primary . ', lib_type_societe FROM ' . $this->_name;
		return $this->getDefaultAdapter()->fetchPairs($sql);
	}
}