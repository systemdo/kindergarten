SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `kindergarden` ;
CREATE SCHEMA IF NOT EXISTS `kindergarden` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `kindergarden` ;

-- -----------------------------------------------------
-- Table `kindergarden`.`contract`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `kindergarden`.`contract` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  `description` MEDIUMTEXT NULL COMMENT '		' ,
  `begin` VARCHAR(45) NULL ,
  `date_end` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kindergarden`.`contact`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `kindergarden`.`contact` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `phone` INT NULL ,
  `second_phone` INT NULL COMMENT '	' ,
  `email` VARCHAR(70) NULL COMMENT '	' ,
  `phone_job` INT NULL ,
  `second_phone_job` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kindergarden`.`address`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `kindergarden`.`address` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `street` VARCHAR(70) NULL ,
  `number` INT NULL ,
  `ciudad` VARCHAR(60) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kindergarden`.`doctor`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `kindergarden`.`doctor` (
  `id` INT NOT NULL ,
  `name` VARCHAR(45) NULL ,
  `surname` VARCHAR(80) NULL ,
  `id_contacts` VARCHAR(45) NULL ,
  `contact_id` INT NOT NULL ,
  `id_address` INT NULL ,
  `address_id` INT NOT NULL ,
  PRIMARY KEY (`id`, `contact_id`, `address_id`) ,
  CONSTRAINT `fk_doctor_contact1`
    FOREIGN KEY (`contact_id` )
    REFERENCES `kindergarden`.`contact` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_doctor_address1`
    FOREIGN KEY (`address_id` )
    REFERENCES `kindergarden`.`address` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kindergarden`.`vaccines`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `kindergarden`.`vaccines` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(60) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kindergarden`.`ermergency_date`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `kindergarden`.`ermergency_date` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `health_insurance` VARCHAR(60) NULL ,
  `id_vaccine` INT NULL ,
  `id_doctor` INT NULL ,
  `another_contact` MEDIUMTEXT NULL ,
  `doctor_id` INT NOT NULL ,
  `vaccines_id` INT NOT NULL ,
  PRIMARY KEY (`id`, `doctor_id`, `vaccines_id`) ,
  CONSTRAINT `fk_ermergency_date_doctor1`
    FOREIGN KEY (`doctor_id` )
    REFERENCES `kindergarden`.`doctor` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ermergency_date_vaccines1`
    FOREIGN KEY (`vaccines_id` )
    REFERENCES `kindergarden`.`vaccines` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `kindergarden`.`kidergarten`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `kindergarden`.`kidergarten` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(60) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kindergarden`.`kinder`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `kindergarden`.`kinder` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  `surname` VARCHAR(150) NULL ,
  `id_emergency_data` INT NULL ,
  `image` VARCHAR(45) NULL ,
  `last_update` TIMESTAMP NULL ,
  `date_create` TIMESTAMP NULL ,
  `birth` DATE NULL ,
  `contract_id` INT NOT NULL ,
  `ermergency_date_id` INT NOT NULL ,
  `id_kidergarten` INT NULL ,
  `kidergarten_id` INT NOT NULL ,
  `date_start` DATE NULL ,
  `date_leave` VARCHAR(45) NULL ,
  `status` INT NULL ,
  `is_online` INT NULL ,
  PRIMARY KEY (`id`, `ermergency_date_id`, `kidergarten_id`) ,
  CONSTRAINT `fk_child_contract`
    FOREIGN KEY (`contract_id` )
    REFERENCES `kindergarden`.`contract` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_child_ermergency_date1`
    FOREIGN KEY (`ermergency_date_id` )
    REFERENCES `kindergarden`.`ermergency_date` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_child_kidergarten1`
    FOREIGN KEY (`kidergarten_id` )
    REFERENCES `kindergarden`.`kidergarten` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kindergarden`.`family`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `kindergarden`.`family` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `surname` VARCHAR(100) NULL ,
  `name` VARCHAR(45) NULL ,
  `id_address` INT NULL ,
  `job` VARCHAR(50) NULL ,
  `id_address_job` INT NULL ,
  `birth` DATE NULL ,
  `document` INT NULL ,
  `image` VARCHAR(60) NULL ,
  `id_contacts` VARCHAR(45) NULL ,
  `date_create` TIMESTAMP NULL ,
  `last_update` VARCHAR(45) NULL ,
  `address_id` INT NOT NULL ,
  `address_id1` INT NOT NULL ,
  `contact_id` INT NOT NULL ,
  PRIMARY KEY (`id`, `address_id`, `address_id1`, `contact_id`) ,
  CONSTRAINT `fk_family_address1`
    FOREIGN KEY (`address_id` )
    REFERENCES `kindergarden`.`address` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_family_address2`
    FOREIGN KEY (`address_id1` )
    REFERENCES `kindergarden`.`address` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_family_contact1`
    FOREIGN KEY (`contact_id` )
    REFERENCES `kindergarden`.`contact` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kindergarden`.`parentage`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `kindergarden`.`parentage` (
  `id` INT NOT NULL ,
  `type` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kindergarden`.`employed`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `kindergarden`.`employed` (
  `id` INT NOT NULL ,
  `name` VARCHAR(60) NULL ,
  `surname` VARCHAR(90) NULL ,
  `id_adress` INT NULL ,
  `id_office` INT NULL ,
  `schedule` VARCHAR(45) NULL ,
  `task` VARCHAR(45) NULL ,
  `begin` DATE NULL ,
  `ended` DATE NULL ,
  `id_contact` INT NULL ,
  `contact_id` INT NOT NULL ,
  `address_id` INT NOT NULL ,
  PRIMARY KEY (`id`, `contact_id`, `address_id`) ,
  CONSTRAINT `fk_employed_contact1`
    FOREIGN KEY (`contact_id` )
    REFERENCES `kindergarden`.`contact` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_employed_address1`
    FOREIGN KEY (`address_id` )
    REFERENCES `kindergarden`.`address` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `kindergarden`.`rules`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `kindergarden`.`rules` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `rule` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kindergarden`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `kindergarden`.`users` (
  `id` INT NOT NULL ,
  `name` VARCHAR(50) NULL ,
  `id_rule` INT NULL ,
  `id_employed` INT NULL ,
  `rules_id` INT NOT NULL ,
  `employed_id` INT NOT NULL ,
  `employed_contact_id` INT NOT NULL ,
  `employed_address_id` INT NOT NULL ,
  PRIMARY KEY (`id`, `rules_id`, `employed_id`, `employed_contact_id`, `employed_address_id`) ,
  CONSTRAINT `fk_users_rules1`
    FOREIGN KEY (`rules_id` )
    REFERENCES `kindergarden`.`rules` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_employed1`
    FOREIGN KEY (`employed_id` , `employed_contact_id` , `employed_address_id` )
    REFERENCES `kindergarden`.`employed` (`id` , `contact_id` , `address_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `kindergarden`.`relationship`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `kindergarden`.`relationship` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '	' ,
  `id_kind` INT NULL ,
  `id_family` INT NULL ,
  `id_parentage` INT NULL ,
  `parentage_id` INT NOT NULL ,
  PRIMARY KEY (`id`, `parentage_id`) ,
  CONSTRAINT `fk_relationship_parentage1`
    FOREIGN KEY (`parentage_id` )
    REFERENCES `kindergarden`.`parentage` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `kindergarden`.`kinder_has_relationship`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `kindergarden`.`kinder_has_relationship` (
  `child_id` INT NOT NULL ,
  `child_ermergency_date_id` INT NOT NULL ,
  `child_kidergarten_id` INT NOT NULL ,
  `relationship_id` INT NOT NULL ,
  PRIMARY KEY (`child_id`, `child_ermergency_date_id`, `child_kidergarten_id`, `relationship_id`) ,
  CONSTRAINT `fk_child_has_relationship_child1`
    FOREIGN KEY (`child_id` , `child_ermergency_date_id` , `child_kidergarten_id` )
    REFERENCES `kindergarden`.`kinder` (`id` , `ermergency_date_id` , `kidergarten_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_child_has_relationship_relationship1`
    FOREIGN KEY (`relationship_id` )
    REFERENCES `kindergarden`.`relationship` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kindergarden`.`family_has_relationship`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `kindergarden`.`family_has_relationship` (
  `family_id` INT NOT NULL ,
  `family_address_id` INT NOT NULL ,
  `family_address_id1` INT NOT NULL ,
  `family_contact_id` INT NOT NULL ,
  `relationship_id` INT NOT NULL ,
  `relationship_parentage_id` INT NOT NULL ,
  PRIMARY KEY (`family_id`, `family_address_id`, `family_address_id1`, `family_contact_id`, `relationship_id`, `relationship_parentage_id`) ,
  CONSTRAINT `fk_family_has_relationship_family1`
    FOREIGN KEY (`family_id` , `family_address_id` , `family_address_id1` , `family_contact_id` )
    REFERENCES `kindergarden`.`family` (`id` , `address_id` , `address_id1` , `contact_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_family_has_relationship_relationship1`
    FOREIGN KEY (`relationship_id` , `relationship_parentage_id` )
    REFERENCES `kindergarden`.`relationship` (`id` , `parentage_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
