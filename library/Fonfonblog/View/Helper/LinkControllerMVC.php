<?php
class Fonfonblog_View_Helper_LinkControllerMVC extends Zend_Controller_Action_Helper_Abstract
{
	private $_request;
	private $_action;
	private $_link;
	private $_param = array();
	
	public $pluginLoader;
	
	/*protected function _getRequest () 
	{
		return $this->_request;
	 }
	private function setRequest ($request) 
	{
		$this->_request = $request;	
	}*/
	
	private function getAction () 
	{
		return $this->_action;	
	}
	
	private function setAction ($action) 
	{ 
		$this->_action = $action;
	}

	
	private function setParam ($param) 
	{ 
		$this->_param = $param;
	}	
	
	public function __construct ()
	{
		$this->pluginLoader = new Zend_Loader_PluginLoader();
	}
	
	public function direct ($action, $param = null)
	{
		$this->setAction($action);
		$this->setParam($param);
		
		return $this->_createLink();
	}
	
	private function _createLink()
	{
		$this->_link = new Zend_Navigation_Page_Mvc(array( 
				'module' => $this->getRequest()->getModuleName(),
				'controller' => $this->getRequest()->getControllerName(),
				'action' => $this->getAction(),
				'params' => $this->_param
			)
		);
		
		return $this->_link->getHref();
	}
	
}