drop database strutture;
create database strutture;
use strutture;

CREATE TABLE IF NOT EXISTS `strutture`.`categoria` (
  `idcategoria` INT NOT NULL auto_increment,
  `nomecategoria` VARCHAR(45) NULL,
  PRIMARY KEY (`idcategoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`regione`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `strutture`.`regione` (
  `idregione` INT NOT NULL auto_increment,
  `nomeregione` VARCHAR(45) NULL,
  `provincia` VARCHAR(45) NULL,
  PRIMARY KEY (`idregione`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`struttura`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `strutture`.`struttura` (
  `idstruttura` INT NOT NULL auto_increment,
  
  
  `indirizzo` VARCHAR(45) NULL,
  `telefono` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `prezzo` FLOAT(4,2) NULL,
  `foto` LONGBLOB NULL,
  `nome` VARCHAR(45) NULL,
  `categoria_idcategoria` INT NOT NULL,
  `regione_idregione` INT NOT NULL,
  PRIMARY KEY (`idstruttura`),
 
  

    FOREIGN KEY (`categoria_idcategoria`)
    REFERENCES `strutture`.`categoria` (`idcategoria`),
   
 
    FOREIGN KEY (`regione_idregione`)
    REFERENCES `strutture`.`regione` (`idregione`)
   )
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `strutture`.`utente` (
  `idutente` INT NOT NULL auto_increment,
  `nome` VARCHAR(45) NULL,
  `cognome` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  PRIMARY KEY (`idutente`),
  UNIQUE (`email`))
ENGINE = InnoDB;

INSERT INTO `categoria` (`idcategoria`, `nomecategoria`) VALUES (NULL, 'categoria1');
INSERT INTO `categoria` (`idcategoria`, `nomecategoria`) VALUES (NULL, 'categoria2');

INSERT INTO `regione` (`idregione`, `nomeregione`, `provincia`) VALUES (NULL, 'regione1', 'provincia1');
INSERT INTO `regione` (`idregione`, `nomeregione`, `provincia`) VALUES (NULL, 'regione2', 'provincia2');

INSERT INTO `utente` (`idutente`, `nome`, `cognome`, `email`, `password`) VALUES (NULL, 'Valerio', 'Farruggio', 'farruggiov12@gmail.com', '1234');
