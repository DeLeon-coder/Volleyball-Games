-- MySQL Script generated by MySQL Workbench
-- Wed Jul  3 12:07:48 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema 2024kyledeleon
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema 2024kyledeleon
-- -----------------------------------------------------
CREATE DATABASE IF NOT EXISTS `2024kyledeleon` DEFAULT CHARACTER SET utf8 ;
USE `2024kyledeleon` ;

-- -----------------------------------------------------
-- Table `2024kyledeleon`.`Team_Table`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `2024kyledeleon`.`Team_Table` (
  `team_id` INT NOT NULL,
  `team_name` VARCHAR(45) NOT NULL,
  `venue_id` INT NOT NULL,
  PRIMARY KEY (`team_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `2024kyledeleon`.`Match Time`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `2024kyledeleon`.`Match Time` (
  `match time` VARCHAR(45) NULL,
  `match_id` INT NOT NULL,
  `venue_id` VARCHAR(45 ) NULL,
  `date` INT NULL,
  PRIMARY KEY (`match_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `2024kyledeleon`.`Points table`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `2024kyledeleon`.`Points table` (
  `match_id` INT NOT NULL,
  `team_id` INT NOT NULL,
  `Set 1(Points)` INT NULL,
  `Set 2(Points)` INT NULL,
  `Set 3(Points)` INT NULL,
  `Match Time_match_id` INT NOT NULL,
  `Team_Table_team_id` INT NOT NULL,
  PRIMARY KEY (`match_id`, `team_id`),
  INDEX `fk_Points table_Match Time_idx` (`Match Time_match_id` ASC),
  INDEX `fk_Points table_Team_Table1_idx` (`Team_Table_team_id` ASC),
  CONSTRAINT `fk_Points table_Match Time`
    FOREIGN KEY (`Match Time_match_id`)
    REFERENCES `2024kyledeleon`.`Match Time` (`match_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Points table_Team_Table1`
    FOREIGN KEY (`Team_Table_team_id`)
    REFERENCES `2024kyledeleon`.`Team_Table` (`team_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;