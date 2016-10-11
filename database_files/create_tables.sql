-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema student-hospital-records
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema student-hospital-records
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `student-hospital-records` DEFAULT CHARACTER SET utf8 ;
USE `student-hospital-records` ;

-- -----------------------------------------------------
-- Table `student-hospital-records`.`tbl_usertype`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `student-hospital-records`.`tbl_usertype` (
  `typeid` INT UNSIGNED NOT NULL,
  `userdesc` VARCHAR(32) NULL,
  PRIMARY KEY (`typeid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student-hospital-records`.`tbl_useraccount`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `student-hospital-records`.`tbl_useraccount` (
  `userid` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(100) NOT NULL,
  `password` VARCHAR(100) NULL,
  `complete_name` VARCHAR(100) NOT NULL,
  `usertype` INT UNSIGNED NOT NULL,
  `modifieddate` TIMESTAMP NULL,
  `modifiedby` INT UNSIGNED NULL,
  PRIMARY KEY (`userid`, `usertype`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  INDEX `fk_tbl_studentaccount_tbl_studentaccount_idx` (`modifiedby` ASC),
  INDEX `fk_tbl_useraccount_tbl_usertype1_idx` (`usertype` ASC),
  CONSTRAINT `fk_tbl_studentaccount_tbl_studentaccount`
    FOREIGN KEY (`modifiedby`)
    REFERENCES `student-hospital-records`.`tbl_useraccount` (`userid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_useraccount_tbl_usertype1`
    FOREIGN KEY (`usertype`)
    REFERENCES `student-hospital-records`.`tbl_usertype` (`typeid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student-hospital-records`.`tbl_activitylog`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `student-hospital-records`.`tbl_activitylog` (
  `logno` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `logdesc` VARCHAR(100) NOT NULL,
  `logdate` TIMESTAMP NULL,
  `loguser` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`logno`, `loguser`),
  INDEX `fk_tbl_activitylog_tbl_useraccount1_idx` (`loguser` ASC),
  CONSTRAINT `fk_tbl_activitylog_tbl_useraccount1`
    FOREIGN KEY (`loguser`)
    REFERENCES `student-hospital-records`.`tbl_useraccount` (`userid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student-hospital-records`.`tbl_college`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `student-hospital-records`.`tbl_college` (
  `collegeid` INT UNSIGNED NOT NULL,
  `college` VARCHAR(10) NOT NULL,
  `collegedesc` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`collegeid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student-hospital-records`.`tbl_studentlist`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `student-hospital-records`.`tbl_studentlist` (
  `SN` BIGINT UNSIGNED NOT NULL,
  `first_name` VARCHAR(32) NOT NULL,
  `last_name` VARCHAR(32) NOT NULL,
  `collegecde` INT UNSIGNED NOT NULL,
  `course` VARCHAR(45) NULL,
  `age` INT NULL,
  `gender` VARCHAR(1) NULL,
  `yearlevel` INT(1) NULL,
  `address` TEXT NULL,
  `weight` FLOAT NULL,
  `height` FLOAT NULL,
  `complexion` TEXT NULL,
  `civil_status` VARCHAR(36) NULL,
  `cp_no` VARCHAR(20) NULL,
  `tel_no` VARCHAR(20) NULL,
  `bday` DATE NULL,
  `status` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`SN`),
  INDEX `fk_tbl_studentlist_tbl_college1_idx` (`collegecde` ASC),
  CONSTRAINT `fk_tbl_studentlist_tbl_college1`
    FOREIGN KEY (`collegecde`)
    REFERENCES `student-hospital-records`.`tbl_college` (`collegeid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student-hospital-records`.`tbl_certification`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `student-hospital-records`.`tbl_certification` (
  `sy` VARCHAR(10) NOT NULL,
  `sem` VARCHAR(5) NOT NULL,
  `SN` BIGINT UNSIGNED NOT NULL,
  `summary` TEXT NULL,
  `skin_disease` TINYINT(1) NOT NULL DEFAULT 0,
  `anemia` TINYINT(1) NOT NULL DEFAULT 0,
  `poorvision` TINYINT(1) NOT NULL DEFAULT 0,
  `intestinal_parasitism` TINYINT(1) NOT NULL DEFAULT 0,
  `pulmonary_tubercolosis` TINYINT(1) NOT NULL DEFAULT 0,
  `hypertension` TINYINT(1) NOT NULL DEFAULT 0,
  `urinary_tract_infection` TINYINT(1) NOT NULL DEFAULT 0,
  `others` TEXT NULL,
  `treatment_optional` TEXT NULL,
  `no_treatment` VARCHAR(45) NULL,
  `md_examineer_id` INT UNSIGNED NOT NULL,
  `dateexamined` TIMESTAMP NULL,
  PRIMARY KEY (`SN`, `md_examineer_id`, `sy`, `sem`),
  INDEX `fk_tbl_certification_tbl_useraccount1_idx` (`md_examineer_id` ASC),
  CONSTRAINT `fk_tbl_certification_tbl_studentlist1`
    FOREIGN KEY (`SN`)
    REFERENCES `student-hospital-records`.`tbl_studentlist` (`SN`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_certification_tbl_useraccount1`
    FOREIGN KEY (`md_examineer_id`)
    REFERENCES `student-hospital-records`.`tbl_useraccount` (`userid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student-hospital-records`.`tbl_hematology`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `student-hospital-records`.`tbl_hematology` (
  `SY` VARCHAR(10) NOT NULL,
  `sem` VARCHAR(10) NOT NULL,
  `SN` BIGINT UNSIGNED NOT NULL,
  `hemoglobin` FLOAT NULL,
  `hematocrit` FLOAT NULL,
  `red_blood` FLOAT NULL,
  `platelet` FLOAT NULL,
  `segmenters` FLOAT NULL,
  `lymphocytes` FLOAT NULL,
  `monocytes` FLOAT NULL,
  `eosinophiles` FLOAT NULL,
  `stab_cells` FLOAT NULL,
  `basophiles` FLOAT NULL,
  `date_saved` TIMESTAMP NULL,
  PRIMARY KEY (`SN`, `sem`, `SY`),
  CONSTRAINT `fk_tbl_hematology_tbl_studentlist1`
    FOREIGN KEY (`SN`)
    REFERENCES `student-hospital-records`.`tbl_studentlist` (`SN`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student-hospital-records`.`tbl_medicalhistory`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `student-hospital-records`.`tbl_medicalhistory` (
  `sy` VARCHAR(10) NOT NULL,
  `sem` VARCHAR(10) NOT NULL,
  `SN` BIGINT UNSIGNED NOT NULL,
  `present_symptoms` TEXT NULL,
  `hyptertension` TINYINT(1) NOT NULL DEFAULT 0,
  `diabetes` TINYINT(1) NOT NULL DEFAULT 0,
  `cardiac` TINYINT(1) NOT NULL DEFAULT 0,
  `astma` TINYINT(1) NOT NULL DEFAULT 0,
  `others` TEXT NULL,
  PRIMARY KEY (`sy`, `sem`, `SN`),
  INDEX `fk_tbl_medicalhistory_tbl_studentlist1_idx` (`SN` ASC),
  CONSTRAINT `fk_tbl_medicalhistory_tbl_studentlist1`
    FOREIGN KEY (`SN`)
    REFERENCES `student-hospital-records`.`tbl_studentlist` (`SN`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student-hospital-records`.`tbl_physicianaccount`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `student-hospital-records`.`tbl_physicianaccount` (
  `license_no` INT UNSIGNED NOT NULL,
  `physician_name` VARCHAR(255) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`license_no`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student-hospital-records`.`tbl_physicalexam`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `student-hospital-records`.`tbl_physicalexam` (
  `sy` VARCHAR(10) NOT NULL,
  `sem` VARCHAR(10) NOT NULL,
  `SN` BIGINT UNSIGNED NOT NULL,
  `skin` VARCHAR(255) NULL,
  `head_scalp` VARCHAR(255) NULL,
  `eyes_external` VARCHAR(255) NULL,
  `pupils_opthatmoscopic` VARCHAR(255) NULL,
  `ears` VARCHAR(255) NULL,
  `nose_sinuses` VARCHAR(255) NULL,
  `mouth_throat` VARCHAR(255) NULL,
  `neck_ln_thyroid` VARCHAR(255) NULL,
  `chest_breast_axilla` VARCHAR(255) NULL,
  `lungs` VARCHAR(255) NULL,
  `heart` VARCHAR(255) NULL,
  `abdomen` VARCHAR(255) NULL,
  `back` VARCHAR(255) NULL,
  `anus_rectum` VARCHAR(255) NULL,
  `gu_system` VARCHAR(255) NULL,
  `reflexes` VARCHAR(255) NULL,
  `extremities` VARCHAR(255) NULL,
  `license_no` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`sy`, `sem`, `SN`, `license_no`),
  INDEX `fk_tbl_physicalexam_tbl_studentlist1_idx` (`SN` ASC),
  INDEX `fk_tbl_physicalexam_tbl_physicianaccount1_idx` (`license_no` ASC),
  CONSTRAINT `fk_tbl_physicalexam_tbl_studentlist1`
    FOREIGN KEY (`SN`)
    REFERENCES `student-hospital-records`.`tbl_studentlist` (`SN`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_physicalexam_tbl_physicianaccount1`
    FOREIGN KEY (`license_no`)
    REFERENCES `student-hospital-records`.`tbl_physicianaccount` (`license_no`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student-hospital-records`.`tbl_refhematology`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `student-hospital-records`.`tbl_refhematology` (
  `ref_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `com_bld_count` VARCHAR(100) NOT NULL,
  `normal_min` FLOAT NOT NULL,
  `normal_max` FLOAT NOT NULL,
  `unit` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`ref_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student-hospital-records`.`tbl_refurinalysis`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `student-hospital-records`.`tbl_refurinalysis` (
  `ref_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `scopic_exam` VARCHAR(45) NULL,
  `normal_min` VARCHAR(45) NULL,
  `normal_max` VARCHAR(45) NULL,
  PRIMARY KEY (`ref_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student-hospital-records`.`tbl_urinalysis`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `student-hospital-records`.`tbl_urinalysis` (
  `sy` VARCHAR(10) NOT NULL,
  `sem` VARCHAR(10) NULL,
  `SN` BIGINT UNSIGNED NOT NULL,
  `color` VARCHAR(45) NULL,
  `transparency` VARCHAR(45) NULL,
  `reaction` VARCHAR(45) NULL,
  `sp_gravity` VARCHAR(45) NULL,
  `sugar` VARCHAR(45) NULL,
  `protien` VARCHAR(45) NULL,
  `pus_cells` VARCHAR(45) NULL,
  `red_cells` VARCHAR(45) NULL,
  `epithelial_cells` VARCHAR(45) NULL,
  `m_thread` VARCHAR(45) NULL,
  `bacteria` VARCHAR(45) NULL,
  `crystals` VARCHAR(45) NULL,
  `others` VARCHAR(45) NULL,
  `date_saved` TIMESTAMP NULL,
  PRIMARY KEY (`sy`, `SN`),
  INDEX `fk_tbl_urinalysis_tbl_studentlist1_idx` (`SN` ASC),
  CONSTRAINT `fk_tbl_urinalysis_tbl_studentlist1`
    FOREIGN KEY (`SN`)
    REFERENCES `student-hospital-records`.`tbl_studentlist` (`SN`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student-hospital-records`.`tbl_vitalsigns`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `student-hospital-records`.`tbl_vitalsigns` (
  `sy` VARCHAR(10) NOT NULL,
  `sem` VARCHAR(10) NOT NULL,
  `SN` BIGINT UNSIGNED NOT NULL,
  `pulse_rate` INT NULL,
  `blood_pressure` VARCHAR(10) NULL,
  `vision` VARCHAR(255) NULL,
  `color_vision` VARCHAR(255) NULL,
  `hearing` VARCHAR(255) NULL,
  `license_no` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`sy`, `sem`, `SN`, `license_no`),
  INDEX `fk_tbl_vitalsigns_tbl_studentlist1_idx` (`SN` ASC),
  INDEX `fk_tbl_vitalsigns_tbl_physicalexam1_idx` (`license_no` ASC),
  CONSTRAINT `fk_tbl_vitalsigns_tbl_studentlist1`
    FOREIGN KEY (`SN`)
    REFERENCES `student-hospital-records`.`tbl_studentlist` (`SN`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_vitalsigns_tbl_physicalexam1`
    FOREIGN KEY (`license_no`)
    REFERENCES `student-hospital-records`.`tbl_physicalexam` (`license_no`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student-hospital-records`.`tbl_xray`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `student-hospital-records`.`tbl_xray` (
  `sy` VARCHAR(10) NOT NULL,
  `sem` VARCHAR(10) NULL,
  `SN` BIGINT UNSIGNED NOT NULL,
  `findings` VARCHAR(255) NULL,
  `image_url` VARCHAR(255) NULL,
  `date_saved` TIMESTAMP NULL,
  PRIMARY KEY (`sy`, `SN`),
  INDEX `fk_tbl_xray_tbl_studentlist1_idx` (`SN` ASC),
  CONSTRAINT `fk_tbl_xray_tbl_studentlist1`
    FOREIGN KEY (`SN`)
    REFERENCES `student-hospital-records`.`tbl_studentlist` (`SN`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
