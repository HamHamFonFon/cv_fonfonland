<?php
class Fonfonblog_Controller_FormatageDate
{
	
	protected $_formatDB = '/([0-9]{4})-([0-9]{2})-([0-9]{2})/';
	protected $_formatReplaceBd = '//';
	//protected formatFr = ''
	
	// Conversion d une date dd/mm/yyyy en yyyy-mm-dd pour la BD
	public function dateToDb ($date)
	{
		$dateDb = new Zend_Date($date, "dd/mm/yyyy", 'fr_FR');
		return $dateDb->get('Y-m-d H:m:s');
	}
	
	public function dateToInput($date)
	{
		$dateFr = new Zend_Date($date, false, 'fr_FR');	
		return $dateFr->toString('dd/MM/yyyy');
	}
}