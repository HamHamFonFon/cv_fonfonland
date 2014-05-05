<?php
class Admin_Model_DbTable_Competences extends Zend_Db_Table_Abstract
{
	protected $_name = 'competences';
	protected $_primary = 'id_competence';
	
	public function getTable ()
	{
		return $this->_name;
	}
	
	/**
	 * Suppression d une competence
	 * @todo : enlever le $idCompetence et mettre $this->_id
	 */
	public function deleteCompetence ($idCompetence)
	{
		$this->oLog = new Fonfonblog_Controller_GestionLogs();
		try {
			$where = $this->getAdapter()->quoteInto($this->_primary . ' = ?', $idCompetence);
	 		if ($this->delete($where)) {
	 			return true;
	 		} else {
	 			return false;
	 		}
		} catch (Zend_Exception $e) {
			//echo $e->getMessage(). "\n" . $e->getTraceAsString();
			$this->oLog->log($e->getMessage(). "\n" . $e->getTraceAsString(), 'debug');
			throw $e;
		}
	}
	
}