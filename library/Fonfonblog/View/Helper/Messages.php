<?php
class Fonfonblog_View_Helper_Messages extends Zend_Controller_Action_Helper_Abstract
{
	
	protected $_message = "";
	protected $_htmlBloc = "";
	protected $_tabMessages = array();
	
	// Types de classes CSS de bootstrap
	private $_cssClassOk = "alert-success";
	private $_cssClassWarn = "alert-block";
	private $_cssClassErr = "alert-danger"; // "alert-error";
	private $_cssClassInfo = "alert-info";
	
	// Titres à afficher
	private $_titreOk = "Ok";
	private $_titreWarn = "Warning";
	private $_titreErr = "Erreur";
	private $_titreInfo = "Information";
	
	
	/**
     * @var Zend_Loader_PluginLoader
     */
    public $pluginLoader;
 
    /**
     * Constructor: initialize plugin loader
     * 
     * @return void
     */
    public function __construct()
    {
	    $this->_tabMessages = array(
		    Zend_Registry::getInstance()->constants->message->type->ok => array('class' => $this->_cssClassOk, 'titre' => $this->_titreOk),
			Zend_Registry::getInstance()->constants->message->type->warning => array('class' => $this->_cssClassWarn, 'titre' => $this->_titreWarn),
			Zend_Registry::getInstance()->constants->message->type->alert => array('class' => $this->_cssClassErr, 'titre' => $this->_titreErr),
			Zend_Registry::getInstance()->constants->message->type->info => array('class' => $this->_cssClassInfo, 'titre' => $this->_titreInfo),
	    );		
        
        $this->pluginLoader = new Zend_Loader_PluginLoader();
    }
    
    public function setMessage($message) 
    {
    	$this->_message = $message;
    }
    
    private function _getMessage () 
    {
    	return $this->_message;
    }
    
    /**
     * Construction du message
     */
    private function _htmlBloc ($tabMessage) 
    {
    	$this->_htmlBloc = "<div class=\"alert " . $tabMessage['class'] . " \">";
    	$this->_htmlBloc .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>";
    	$this->_htmlBloc .= "<h4>" . $tabMessage['titre'] . "!</h4>";
    	$this->_htmlBloc .= "<p>" . $this->_getMessage() . "</p>";
    	$this->_htmlBloc .= "</div>";
  
    	return $this->_htmlBloc;
    }
    
    /**
     * Types de messages
     */
	public function direct($message, $type) {
		$this->setMessage($message);
		return $this->_htmlBloc($this->_tabMessages[$type]);
	}
    
    /*public function errorMessage ($message) 
    {
    	$this->setMessage($message);
    	return $this->_htmlBloc($this->_cssClassErr);
    }
    
    public function warningMessage ($message) 
    {
    	$this->setMessage($message);
    	return $this->_htmlBloc($this->_cssClassWarn);
    }
    
    public function infoMessage ($message) 
    {
    	$this->setMessage($message);
    	return $this->_htmlBloc($this->_cssClassInfo);
    }
    
    public function okMessage ($message) 
    {
    	$this->setMessage($message);
    	return $this->_htmlBloc($this->_cssClassOk);
    }*/
}