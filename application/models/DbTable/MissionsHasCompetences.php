<?php
class Application_Model_DbTable_MissionsHasCompetences extends Zend_Db_Table_Abstract
{
	protected $_name = 'missions_has_competences';
	//protected $_dependentTables = array('Missions','Competences');

	protected $_referenceMap = array(
        'Mission' => array(
            'columns'           => array('missions_id_mission'),
            'refTableClass'     => 'Application_Model_DbTable_Missions',
            'refColumns'        => array('id_mission')
        ),
        'Competence' => array(
            'columns'           => array('competences_id_competence'),
            'refTableClass'     => 'Application_Model_DbTable_Competences',
            'refColumns'        => array('id_competence')
        )
    );

}