<?php
class Admin_Model_DbTable_Missions extends Zend_Db_Table_Abstract
{
	protected $_name = 'missions';
	protected $_primary = 'id_mission';
	protected $_id;
	
	public function setId ($id)
	{
		$this->_id = $id;
	}
	
	private function getId()
	{
		return $this->_id;
	}
	
	public function deleteMission ()
	{
		$this->oLog = new Fonfonblog_Controller_GestionLogs();
		try {
			$where = $this->getAdapter()->quoteInto($this->_primary . ' = ?', $this->getId());
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