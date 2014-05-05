<?php
class Fonfonblog_Controller_Plugin_LoadJs extends Zend_Controller_Plugin_Abstract
{
	protected $_view;
	protected $_defaultModule;
	
	public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
	{
		$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
		$viewRenderer->init(); 
	    $this->_view = $viewRenderer->view;
	    $this->_defaultModule = Zend_Controller_Front::getInstance()->getDefaultModule() ;
	}

  public function preDispatch(Zend_Controller_Request_Abstract $request)
  {
    $this->_actionJSLink($request);
  }

  protected function _actionJSLink(Zend_Controller_Request_Http $request)
  {
    $view = $this->_view;
    
    $view->headScript()->appendFile($view->baseUrl() . '/js/jquery-2.0.2.min.js')
    				->appendFile($view->baseUrl() . '/js/jquery-ui-1.10.4.custom.min.js')
					->appendFile($view->baseUrl() . '/js/commun.js'); 
    
    $module   = ($request->getModuleName() != $this->_defaultModule) ? $request->getModuleName() . '.' : '';
    $controller = $request->getControllerName();
    $action = $request->getActionName();
   
    $file = dirname(APPLICATION_PATH)  . '/public/js/' 
							   . $module
                               . $controller . '.'
                               . $action     . '.js';
    if (file_exists($file)) {
      $url = $view->baseUrl()  . '/js/'
                               . $module
                               . $controller . '.'
                               . $action     . '.js';
      $view->headScript()->appendFile($url);
    }
  }
}