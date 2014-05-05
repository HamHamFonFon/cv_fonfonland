<?php
class Fonfonblog_Controller_GestionLogs
{
	
	protected $_log;
	protected $_redacteur;
	private $_DirLogs;
	
	private function _getDir ()
	{
		return APPLICATION_PATH . DIRECTORY_SEPARATOR . 'datas' . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR;
	}
	
	public function __construct()
	{
		$this->_log = new Zend_Log();
		$this->_redacteur = new Zend_Log_Writer_Stream($this->_getNameFile());
		
		$this->_log->addWriter($this->_redacteur);
	}
	
	public function log ($message, $type)
	{
		//Zend_Debug::dump($this->_log);
		$this->_log->log($message, $this->_getType($type));
	}
	
	private function _getNameFile ()
	{
		$date = new DateTime('NOW', new DateTimeZone('Europe/Paris'));
		
		$fileLogName = $date->format('Y-m-d') . '_logs.log';
		if (!file_exists($this->_getDir() . $fileLogName)) {
			//chmod($this->_getDir(), 0755);
			$handle = fopen($this->_getDir() . $fileLogName, 'w');
		}
		return $this->_getDir() . $fileLogName;
	}
	
	private function _getType ($type)
	{
	
		if (isset($type) && !empty($type)) {
			
			switch ($type) {
				case 'emerg' : return Zend_Log::EMERG ; break;
				case 'alert' : return Zend_Log::ALERT; break;
				case 'crit' : return Zend_Log::CRIT; break;
				case 'err' : return Zend_Log::ERR; break;
				case 'warn' : return Zend_Log::WARN; break;
				case 'notice' : return Zend_Log::NOTICE; break;
				case 'info' : return Zend_Log::INFO; break;
				case 'debug' : return Zend_Log::DEBUG; break;
			}
			
		} else {
			//On retourne par defaut une informations
			return Zend_Log::INFO;
		}
		
	}
}
