-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema aula
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema aula
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `aula` DEFAULT CHARACTER SET utf8 ;
USE `aula` ;

-- -----------------------------------------------------
-- Table `aula`.`estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aula`.`estado` (
  `EST_ID` INT NOT NULL AUTO_INCREMENT,
  `EST_NOME` VARCHAR(45) NULL,
  `EST_SIGLA` VARCHAR(45) NULL,
  PRIMARY KEY (`EST_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aula`.`cidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aula`.`cidade` (
  `CID_ID` INT NOT NULL AUTO_INCREMENT,
  `CID_NOME` VARCHAR(45) NULL,
  `EST_ID` INT NOT NULL,
  PRIMARY KEY (`CID_ID`, `EST_ID`),
  CONSTRAINT `fk_cidade_estado`
    FOREIGN KEY (`EST_ID`)
    REFERENCES `aula`.`estado` (`EST_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

