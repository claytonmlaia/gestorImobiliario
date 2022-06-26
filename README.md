# Gestor Imobiliario Utilizando PHP + MySql + Bootstrap 4

Instalação
------------

Execute este script no Banco de dados:

```sql
-- MySQL Workbench Synchronization
-- Generated: 2022-06-26 19:36
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: clayt

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE database teste;
use teste;

ALTER TABLE `teste`.`imoveis` 
DROP FOREIGN KEY `fk_imoveis_proprietarios`;

ALTER TABLE `teste`.`contratos` 
DROP FOREIGN KEY `fk_contratos_clientes1`;

ALTER TABLE `teste`.`imoveis` 
DROP COLUMN `proprietarios_id`,
ADD COLUMN `proprietarios_id` INT(11) NOT NULL AFTER `id`,
ADD INDEX `fk_imoveis_proprietarios_idx` (`proprietarios_id` ASC),
DROP INDEX `fk_imoveis_proprietarios_idx` ;
;

ALTER TABLE `teste`.`contratos` 
DROP COLUMN `clientes_id`,
DROP COLUMN `imoveis_id`,
DROP COLUMN `proprietarios_id`,
ADD COLUMN `proprietarios_id` INT(11) NOT NULL AFTER `id`,
ADD COLUMN `imoveis_id` INT(11) NOT NULL AFTER `proprietarios_id`,
ADD COLUMN `clientes_id` INT(11) NOT NULL AFTER `imoveis_id`,
ADD INDEX `fk_contratos_proprietarios1_idx` (`proprietarios_id` ASC),
ADD INDEX `fk_contratos_imoveis1_idx` (`imoveis_id` ASC),
ADD INDEX `fk_contratos_clientes1_idx` (`clientes_id` ASC),
DROP INDEX `fk_contratos_clientes1_idx` ,
DROP INDEX `fk_contratos_imoveis1_idx` ,
DROP INDEX `fk_contratos_proprietarios1_idx` ;
;

CREATE TABLE IF NOT EXISTS `teste`.`mensalidades` (
  `contratos_id` INT(11) NOT NULL,
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `situacao` TINYINT(4) NULL DEFAULT NULL,
  INDEX `fk_mensalidades_contratos1_idx` (`contratos_id` ASC),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_mensalidades_contratos1`
    FOREIGN KEY (`contratos_id`)
    REFERENCES `teste`.`contratos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `teste`.`repasses` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `contratos_id` INT(11) NOT NULL,
  `situacao` TINYINT(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_repasses_contratos1_idx` (`contratos_id` ASC),
  CONSTRAINT `fk_repasses_contratos1`
    FOREIGN KEY (`contratos_id`)
    REFERENCES `teste`.`contratos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


ALTER TABLE `teste`.`imoveis` 
ADD CONSTRAINT `fk_imoveis_proprietarios`
  FOREIGN KEY (`proprietarios_id`)
  REFERENCES `teste`.`proprietarios` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `teste`.`contratos` 
DROP FOREIGN KEY `fk_contratos_proprietarios1`,
DROP FOREIGN KEY `fk_contratos_imoveis1`;

ALTER TABLE `teste`.`contratos` ADD CONSTRAINT `fk_contratos_proprietarios1`
  FOREIGN KEY (`proprietarios_id`)
  REFERENCES `teste`.`proprietarios` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_contratos_imoveis1`
  FOREIGN KEY (`imoveis_id`)
  REFERENCES `teste`.`imoveis` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_contratos_clientes1`
  FOREIGN KEY (`clientes_id`)
  REFERENCES `teste`.`clientes` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

```
Existe um MER dentro da pasta 'app/DB/DB.mwb'

Configurar o arquivo Conexao.php dentro da pasta 'app/conexao': <br>

Foi utilizado o Laragon, para gerar o ambiente com apache e banco de dados MySQL.
No entanto, a versão do PHP utilizada foi a 7.4