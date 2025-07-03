# stage_opdracht_TechMere

ik heb eigelijk meer een website dan een app gemaakt en ook geen instalatie instructies daarom.

ik heb gebruik gemaakt van AI dat is omdat ik zelf dus niet veel ervaaring heb met laravel en het beetje wat ik had was van een schoolopdracht ergens aan het begin van dit jaar. ik heb het voral gebruikt als ik geen duidelijke informatie kon vinden op het internet over wat ik wouw doen of wanneer iets niet werkte en ik kwam er na een uur nogsteeds niet achter meestal waaren dat typ fouten die ik niet zag.

op Herd staat PHP 8.3 dus daar ga ik vanuit als je dit zelf wil gebruiken heb je dezelfde database nodig, hieronder de code die je in mysql kan zetten daarvoor ik zelf kreeg het voor de een of andere reeden niet voor elkaar om herd en mysql zamen te laten werken en moest naast die 2 ook docker gebruiken ik denk dat het mischien iets met de port te maken heeft.
-------------------------------------------------------------------------------------------------------
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema stage_opdracht_techmere
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema stage_opdracht_techmere
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `stage_opdracht_techmere` DEFAULT CHARACTER SET utf8mb4 ;
USE `stage_opdracht_techmere` ;

-- -----------------------------------------------------
-- Table `stage_opdracht_techmere`.`cache`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stage_opdracht_techmere`.`cache` ;

CREATE TABLE IF NOT EXISTS `stage_opdracht_techmere`.`cache` (
  `key` VARCHAR(255) NOT NULL,
  `value` MEDIUMTEXT NOT NULL,
  `expiration` INT(11) NOT NULL,
  PRIMARY KEY (`key`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `stage_opdracht_techmere`.`cache_locks`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stage_opdracht_techmere`.`cache_locks` ;

CREATE TABLE IF NOT EXISTS `stage_opdracht_techmere`.`cache_locks` (
  `key` VARCHAR(255) NOT NULL,
  `owner` VARCHAR(255) NOT NULL,
  `expiration` INT(11) NOT NULL,
  PRIMARY KEY (`key`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `stage_opdracht_techmere`.`event_data`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stage_opdracht_techmere`.`event_data` ;

CREATE TABLE IF NOT EXISTS `stage_opdracht_techmere`.`event_data` (
  `idevent_data` INT(20) NOT NULL AUTO_INCREMENT,
  `event_name` VARCHAR(255) NOT NULL,
  `event_date` DATE NOT NULL,
  `event_locatie` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idevent_data`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `stage_opdracht_techmere`.`migrations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stage_opdracht_techmere`.`migrations` ;

CREATE TABLE IF NOT EXISTS `stage_opdracht_techmere`.`migrations` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255) NOT NULL,
  `batch` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `stage_opdracht_techmere`.`password_reset_tokens`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stage_opdracht_techmere`.`password_reset_tokens` ;

CREATE TABLE IF NOT EXISTS `stage_opdracht_techmere`.`password_reset_tokens` (
  `email` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`email`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `stage_opdracht_techmere`.`sessions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stage_opdracht_techmere`.`sessions` ;

CREATE TABLE IF NOT EXISTS `stage_opdracht_techmere`.`sessions` (
  `id` VARCHAR(255) NOT NULL,
  `user_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `ip_address` VARCHAR(45) NULL DEFAULT NULL,
  `user_agent` TEXT NULL DEFAULT NULL,
  `payload` LONGTEXT NOT NULL,
  `last_activity` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `sessions_user_id_index` (`user_id` ASC) VISIBLE,
  INDEX `sessions_last_activity_index` (`last_activity` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `stage_opdracht_techmere`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stage_opdracht_techmere`.`users` ;

CREATE TABLE IF NOT EXISTS `stage_opdracht_techmere`.`users` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `lastname` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `age` DATE NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `locatie` VARCHAR(255) NOT NULL,
  `remember_token` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `users_email_unique` (`email` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `stage_opdracht_techmere`.`users_has_event_data`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stage_opdracht_techmere`.`users_has_event_data` ;

CREATE TABLE IF NOT EXISTS `stage_opdracht_techmere`.`users_has_event_data` (
  `users_id` BIGINT(20) UNSIGNED NOT NULL,
  `event_data_idevent_data` INT(20) NOT NULL,
  PRIMARY KEY (`users_id`, `event_data_idevent_data`),
  INDEX `fk_users_has_event_data_event_data1_idx` (`event_data_idevent_data` ASC) VISIBLE,
  INDEX `fk_users_has_event_data_users_idx` (`users_id` ASC) VISIBLE,
  CONSTRAINT `fk_users_has_event_data_event_data1`
    FOREIGN KEY (`event_data_idevent_data`)
    REFERENCES `stage_opdracht_techmere`.`event_data` (`idevent_data`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_event_data_users`
    FOREIGN KEY (`users_id`)
    REFERENCES `stage_opdracht_techmere`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
----------------------------------------------------------------------------------------------


ik heb eigelijk meer dus een website heel simpel je logt in als je geen account hebt moet je je registreren dan kan je zien dat er een lijst is met event's die ik heb laten maken met een factory en als het event nog niet is geweest of op die dag is kan je je aanmelden. je kan op een andere pagina zien waar je je voor hebt aangemeld als je ergens al geweest zou zijn zie je dat ook en als er op die dag een evenement is zie je dat met het weer van de dag want dat is mischien wel fijn om te weten als voorberijding voor het evenelemt.

ik heb een api van volgensmij knmi gebruikt voor weer was kompleet gratis tot 300 calls op een dag en aangezien ik ze;f niet zoveel cals hoef te doen voor deze opdracht leek dat me wel goed
https://weerlive.nl/api/weerlive_api_v2.php?key=&locatie=Almere (zonder mijn api key).

![Schermafbeelding 2025-07-03 161705](https://github.com/user-attachments/assets/faf067c2-d59a-4d89-b58d-78f3a49b1e45)
![Schermafbeelding 2025-07-03 161819](https://github.com/user-attachments/assets/ddb1cd08-46a2-47f9-9599-652e26516fff)
![Schermafbeelding 2025-07-03 161847](https://github.com/user-attachments/assets/085daecc-4b51-4949-a4b8-e391b2dff15e)
![Schermafbeelding 2025-07-03 161910](https://github.com/user-attachments/assets/fc009415-42b8-45d1-a541-6463ff2f09dd)
![Schermafbeelding 2025-07-03 162001](https://github.com/user-attachments/assets/8b9e2ed4-a717-4388-b174-d80bf036629a)
![Schermafbeelding 2025-07-03 162020](https://github.com/user-attachments/assets/d991c038-baf5-4b33-9f05-dd4f9b5e7de1)
