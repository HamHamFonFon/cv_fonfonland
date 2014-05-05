<?php

class IndexController extends Zend_Controller_Action
{
	public $oLog;
	
	public function init()
	{
	}
	
	/**
	 * On route vers la page des competences
	 */
    public function indexAction()
    {
		//$this->_forward('travaux');
		
		// Appel de la page d index de ComeptencesController
		$this->_forward('index', 'competences');
    }
    
    public function travauxAction ()
    {
    	$this->render('error', 'error');
    }

}
