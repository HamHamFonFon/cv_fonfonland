CREATE  TABLE IF NOT EXISTS `cv`.`competences_principales` (
  `id_competence_principale` INT NOT NULL AUTO_INCREMENT ,
  `lib_competence_principale` VARCHAR(255) NULL ,
  PRIMARY KEY (`id_competence_principale`) )
ENGINE = InnoDB;

CREATE  TABLE IF NOT EXISTS `cv`.`competences` (
  `id_competence` INT NOT NULL AUTO_INCREMENT ,
  `id_competence_principale` INT NOT NULL ,
  `lib_competence` VARCHAR(255) NULL ,
  PRIMARY KEY (`id_competence`) ,
  INDEX `fk_competences_competences_principales_idx` (`id_competence_principale` ASC) ,
  CONSTRAINT `fk_competences_competences_principales`
    FOREIGN KEY (`id_competence_principale` )
    REFERENCES `cv`.`competences_principales` (`id_competence_principale` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE  TABLE IF NOT EXISTS `cv`.`r_type_societes` (
  `id_type_societe` INT NOT NULL AUTO_INCREMENT ,
  `lib_type_societe` VARCHAR(255) NULL ,
  PRIMARY KEY (`id_type_societe`) )
ENGINE = InnoDB;

CREATE  TABLE IF NOT EXISTS `cv`.`r_type_postes` (
  `id_type_poste` INT NOT NULL AUTO_INCREMENT ,
  `lib_type_poste` VARCHAR(255) NULL ,
  PRIMARY KEY (`id_type_poste`) )
ENGINE = InnoDB;

CREATE  TABLE IF NOT EXISTS `cv`.`emplois` (
  `id_emploi` INT NOT NULL AUTO_INCREMENT ,
  `lib_emploi` VARCHAR(255) NULL ,
  `id_type_societe` INT NOT NULL ,
  `id_type_poste` INT NOT NULL ,
  `lieu` VARCHAR(255) NULL ,
  PRIMARY KEY (`id_emploi`) ,
  INDEX `fk_emplois_r_type_societes1_idx` (`id_type_societe` ASC) ,
  INDEX `fk_emplois_r_type_postes1_idx` (`id_type_poste` ASC) ,
  CONSTRAINT `fk_emplois_r_type_societes1`
    FOREIGN KEY (`id_type_societe` )
    REFERENCES `cv`.`r_type_societes` (`id_type_societe` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_emplois_r_type_postes1`
    FOREIGN KEY (`id_type_poste` )
    REFERENCES `cv`.`r_type_postes` (`id_type_poste` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE  TABLE IF NOT EXISTS `cv`.`missions` (
  `id_mission` INT NOT NULL AUTO_INCREMENT ,
  `id_emploi` INT NOT NULL ,
  `lib_mission` VARCHAR(255) NULL ,
  `intitule_mission` VARCHAR(255) NULL ,
  `contenu_mission` TEXT NULL ,
  `date_debut` DATETIME NULL ,
  `date_fin` DATETIME NULL ,
  PRIMARY KEY (`id_mission`) ,
  INDEX `fk_missions_emplois1_idx` (`id_emploi` ASC) ,
  CONSTRAINT `fk_missions_emplois1`
    FOREIGN KEY (`id_emploi` )
    REFERENCES `cv`.`emplois` (`id_emploi` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE  TABLE IF NOT EXISTS `cv`.`missions_has_competences` (
  `missions_id_mission` INT NOT NULL ,
  `competences_id_competence` INT NOT NULL ,
  PRIMARY KEY (`missions_id_mission`, `competences_id_competence`) ,
  INDEX `fk_missions_has_competences_competences1_idx` (`competences_id_competence` ASC) ,
  INDEX `fk_missions_has_competences_missions1_idx` (`missions_id_mission` ASC) ,
  CONSTRAINT `fk_missions_has_competences_missions1`
    FOREIGN KEY (`missions_id_mission` )
    REFERENCES `cv`.`missions` (`id_mission` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_missions_has_competences_competences1`
    FOREIGN KEY (`competences_id_competence` )
    REFERENCES `cv`.`competences` (`id_competence` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;