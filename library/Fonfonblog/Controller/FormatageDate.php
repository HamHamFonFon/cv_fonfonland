<?php
class Fonfonblog_Controller_FormatageDate
{
	
	protected $_formatDB = '/([0-9]{4})-([0-9]{2})-([0-9]{2})/';
	protected $_formatReplaceBd = '//';
	//protected formatFr = ''
	
	// Conversion d une date dd/mm/yyyy en yyyy-mm-dd pour la BD
	public function dateToDb ($date)
	{
		$dateDb = new DateTime($date);
		return $dateDb->format('Y-m-d H:i:s');
	}
	
	public function dateToInput($date)
	{
		$dateFr = new Zend_Date($date, false, 'fr_FR');	
		return $dateFr->toString('dd/MM/yyyy');
	}
}