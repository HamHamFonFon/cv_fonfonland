<?php
class Admin_Form_Missions extends Zend_Form
{
	public function init()
	{
		
		$this->setMethod('post');
		$this->setOptions(array('class' => 'form-horizontal'));
		
		// id mission
		$idMission = new Zend_Form_Element_Hidden("id_mission");
		$idMission//->setValue($this->idExperience)
					->removeDecorator("label");
		$this->addElement($idMission);
		
		// id emploi
		$idExperience = new Zend_Form_Element_Hidden("id_emploi");
		$idExperience//->setValue($this->idExperience)
					->removeDecorator("label");
		$this->addElement($idExperience);
		
		// lib mission
		$libMission = new Zend_Form_Element_Text('lib_mission');
		$libMission->setLabel('Libéllé mission')
					->setOptions(array('class' => 'form-control'));
		$this->addElement($libMission);
		
		// intitelé mission
		$intMission = new Zend_Form_Element_Text('intitule_mission');
		$intMission->setLabel('Intitulé de la mission')
					->setOptions(array('class' => 'form-control'));
		$this->addElement($intMission);
		
		// date debut
		$dateDeb = new Zend_Form_Element_Text('date_debut');
		$dateDeb->setLabel('Date de début')
				->setOptions(array('class' => 'form-control'));
		$this->addElement($dateDeb);
		
		// date fin
		$dateFin = new Zend_Form_Element_Text('date_fin');
		$dateFin->setLabel('Date de fin')
				->setOptions(array('class' => 'form-control'));
		$this->addElement($dateFin);
		
		// contenu mission
		$mission = new Zend_Form_Element_Textarea('contenu_mission');
		$mission->setLabel('Mission')
				->setOptions(array('class' => 'form-control', 'rows' => 5))
				;
		$this->addElement($mission);
		
		// Competences de la mission
		$listeCompetences = new Zend_Form_Element_Multiselect('env_tech');
		$listeCompetences->setOptions(array('class' => 'form-control', 'style' => 'height : 200px;'))
						->setLabel("Environnement technique");
		$this->addElement($listeCompetences);
		
		// bouton submit
		$submit = new Zend_Form_Element_Submit('Envoyer');
		$submit->setAttrib('id', 'submitFrmInscription');
		$submit->setOptions(array('class' => 'btn btn-primary'));
		$this->addElement($submit);
		
	}
}
