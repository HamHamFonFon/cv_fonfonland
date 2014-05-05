<?php
class Zend_View_Helper_AffichageDate
{
	protected $date;
	protected $type;
	
	public function affichageDate ($date)
	{
		$dateFr = new Zend_Date($date, false, $this->_formatFr());	
		return $dateFr->toString('dd/MM/yyyy');
	}
	
	protected function _formatFr ()
	{
		return new Zend_Locale('fr_FR');
	}
	
	public function dateToDb ($date)
	{
		$dateBd = new Zend_Date($date, false, $this->_formatFr());	
		return $dateBd->toString('yyyy-MM-dd');
	}
}