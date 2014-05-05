INSERT INTO `cv`.`competences_principales` (`id_competence_principale`, `lib_competence_principale`) VALUES (1, 'Langages informatiques');
INSERT INTO `cv`.`competences_principales` (`id_competence_principale`, `lib_competence_principale`) VALUES (2, 'Frameworks et librairies');
INSERT INTO `cv`.`competences_principales` (`id_competence_principale`, `lib_competence_principale`) VALUES (3, 'IDE et outils');
INSERT INTO `cv`.`competences_principales` (`id_competence_principale`, `lib_competence_principale`) VALUES (4, 'Base de données');
INSERT INTO `cv`.`competences_principales` (`id_competence_principale`, `lib_competence_principale`) VALUES (5, 'Tests');
INSERT INTO `cv`.`competences_principales` (`id_competence_principale`, `lib_competence_principale`) VALUES (6, 'Systèmes d\'exploitations');
INSERT INTO `cv`.`competences_principales` (`id_competence_principale`, `lib_competence_principale`) VALUES (7, 'Serveurs d\'applications');
INSERT INTO `cv`.`competences_principales` (`id_competence_principale`, `lib_competence_principale`) VALUES (8, 'Méthodologie');
INSERT INTO `cv`.`competences_principales` (`id_competence_principale`, `lib_competence_principale`) VALUES (9, 'Gestion de versions');
INSERT INTO `cv`.`competences_principales` (`id_competence_principale`, `lib_competence_principale`) VALUES (10, 'Autres');


INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (1, 'PHP');
INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (1, 'HTML');
INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (1, 'Javascript');
INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (1, 'CSS');

INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (2, 'CakePHP');
INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (2, 'Zend Framework');
INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (2, 'JQuery');
INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (2, 'PHP Excel');
INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (2, 'Qooxdoo');
INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (2, 'OpenLayers');
INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (2, 'Factory');

INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (3, 'Eclipse PDT');
INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (3, 'Zend Studio');
INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (3, 'SoapUI');
INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (3, 'Notepad++');
INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (3, 'MySQL Workbench & SQL Yog');
INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (3, 'Entrerprise Architect & Umbrello');

INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (4, 'MySQL');
INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (4, 'PostgreSQL');
INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (4, 'PostGIS');
INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (4, 'PG Admin');

INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (5, 'Selenium');
INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (5, 'Jenkins');
INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (5, 'Sonar');
INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (5, 'CodeSniffer');
INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (5, 'PHP Unit');

INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (6, 'Linux Ubuntu');
INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (6, 'Linux Debian');
INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (6, 'Linux Fedora');
INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (6, 'Windows Server');

INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (7, 'Apache,');
INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (7, 'Tomcat');
INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (7, 'Geoserver');

INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (8, 'Agile SCRUM');

INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (9, 'SVN Tortoise');
INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (9, 'Eclipse SVN');

INSERT INTO `cv`.`competences` (`id_competence_principale`, `lib_competence`) VALUES (10, 'Systèmes d''Informations Géographiques');


INSERT INTO `cv`.`r_type_societes` (`id_type_societe`, `lib_type_societe`) VALUES (1, 'SSII');
INSERT INTO `cv`.`r_type_societes` (`id_type_societe`, `lib_type_societe`) VALUES (2, 'Editeur de logiciels');
INSERT INTO `cv`.`r_type_societes` (`id_type_societe`, `lib_type_societe`) VALUES (3, 'Web agency');
INSERT INTO `cv`.`r_type_societes` (`id_type_societe`, `lib_type_societe`) VALUES (4, 'Centre de recherche');

INSERT INTO `cv`.`r_type_postes` (`id_type_poste`, `lib_type_poste`) VALUES (1, 'Ingénieur d''études et développement');
INSERT INTO `cv`.`r_type_postes` (`id_type_poste`, `lib_type_poste`) VALUES (2, 'Analyste-programmeur');
INSERT INTO `cv`.`r_type_postes` (`id_type_poste`, `lib_type_poste`) VALUES (3, 'Stage PHP/MySQL');

INSERT INTO `cv`.`emplois` (`id_emploi`, `lib_emploi`, `id_type_societe`, `id_type_poste`, `lieu`) VALUES (1, 'Intitek', 1, 1, 'Montpellier');
INSERT INTO `cv`.`emplois` (`id_emploi`, `lib_emploi`, `id_type_societe`, `id_type_poste`, `lieu`) VALUES (2, 'Ginger Strategis', 2, 2, 'Montpellier');
INSERT INTO `cv`.`emplois` (`id_emploi`, `lib_emploi`, `id_type_societe`, `id_type_poste`, `lieu`) VALUES (3, 'Les Clés du Midi', 3, 2, 'Montpellier');
INSERT INTO `cv`.`emplois` (`id_emploi`, `lib_emploi`, `id_type_societe`, `id_type_poste`, `lieu`) VALUES (4, 'CIRAD', 4, 3, 'Montpellier');

INSERT INTO `cv`.`missions` (`id_mission`, `id_emploi`, `lib_mission`, `intitule_mission`, `contenu_mission`, `date_debut`, `date_fin`) 
    VALUES (1, 1, 'Orange DevRap', 'Développement sur les applications DevRap et mise en place de l’Intégration Continue', 'blabla...', '2013-06-03', '2013-12-05');

INSERT INTO `cv`.`missions` (`id_mission`, `id_emploi`, `lib_mission`, `intitule_mission`, `contenu_mission`, `date_debut`, `date_fin`) 
    VALUES (2, 1, 'Orange ENOV', 'Développement d’un logiciel d’aide à la vente de solutions Orange Business Service (ENOV)', 'blabla...', '2012-11-12', '2013-05-31');    

INSERT INTO `cv`.`missions` (`id_mission`, `id_emploi`, `lib_mission`, `intitule_mission`, `contenu_mission`, `date_debut`, `date_fin`) 
    VALUES (3, 2, '', 'Développement d’application métiers cartographiques', 'blabla...', '2012-11-09', '2009-05-09');  
    
INSERT INTO `cv`.`missions` (`id_mission`, `id_emploi`, `lib_mission`, `intitule_mission`, `contenu_mission`, `date_debut`, `date_fin`) 
    VALUES (4, 3, '', 'Développement de sites internet', 'Développement de plusieurs portails web de présentation dans le secteur de l’immobilier et de l’évenementiel', '2009-02-01', '2009-04-30'); 
    
 INSERT INTO `cv`.`missions` (`id_mission`, `id_emploi`, `lib_mission`, `intitule_mission`, `contenu_mission`, `date_debut`, `date_fin`) 
    VALUES (5, 4, '', 'Stage de fin d’études', 'blabla...', '2008-04-01', '2008-09-30');                  