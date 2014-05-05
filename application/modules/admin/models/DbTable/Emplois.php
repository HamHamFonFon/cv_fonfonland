<?php
class Admin_Model_DbTable_Emplois extends Zend_Db_Table_Abstract
{
	protected $_name = 'emplois';
	protected $_primary = 'id_emploi';
	protected $_id;
	
	public function getTable ()
	{
		return $this->_name;
	}
	
	public function setId($idExperience)
	{
		$this->_id = $idExperience;
	}
	
	private function getId ()
	{
		return $this->_id;
	}
	
	/**
	 * Ajout d'une experience
	 */
	public function addExperience ()
	{
		
	}
	
	
	/**
	 * Suppression d'une experience
	 * @todo : pbl possible : delete cascade
	 */
	public function deleteExperience ()
	{
		$this->oLog = new Fonfonblog_Controller_GestionLogs();
		try {
			$where = $this->getAdapter()->quoteInto($this->_primary . ' = ?', $this->_id);
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
