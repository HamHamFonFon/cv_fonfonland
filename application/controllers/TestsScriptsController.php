<?php
class TestsScriptsController extends Zend_Controller_Action
{
	
	protected $_red = 255;
	protected $_green = 255;
	protected $_blue = 0;
	
	public function init()
	{
	}
	
	public function degradeAction ()
	{
		
		$r = $this->_red;
		$g = $this->_green;
		$b = $this->_blue;
		$i = $j = 0;
		$tabH = array();
		
		for ($j = 255; $j > 0; $j--) {
			for ($i = 0; $i < 255; $i++) {
				$tabH[$j][$i] = array($r, $g, $b);
				$r -= 1; 
				//$g -= 2;
				$b += 1;
			}
			$r = $this->_red--;
			$g--; // = $this->_green--;
			$b = $this->_blue;
		}
		$this->view->tabCouleurs = $tabH;
	}
}