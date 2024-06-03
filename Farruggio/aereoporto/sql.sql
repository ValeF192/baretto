drop database merce;
CREATE database merce;
use merce;

-- -----------------------------------------------------
-- Table `merce`.`passeggero`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `merce`.`passeggero` (
  `cognome` VARCHAR(45) NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `nazionalita` VARCHAR(45) NULL,
  `num_carta` INT NULL,
  `aereoporto_partenza` INT NULL,
  `aereoporto_destinazione` INT NULL,
  `idpasseggero` INT NOT NULL auto_increment,
  PRIMARY KEY (`idpasseggero`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `merce`.`esito`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `merce`.`esito` (
  `tipo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`tipo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `merce`.`funzionario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `merce`.`funzionario` (
  `idfunzionario` INT NOT NULL auto_increment,
  `nome` VARCHAR(45) NULL,
  `cognome` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  PRIMARY KEY (`idfunzionario`),
  UNIQUE (`email`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `merce`.`addetto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `merce`.`addetto` (
  `idaddetto` INT NOT NULL auto_increment,
  `nome` VARCHAR(45) NULL,
  `cognome` VARCHAR(45) NULL,
  `funzionario_idfunzionario` INT NOT NULL,
  PRIMARY KEY (`idaddetto`),
  
  CONSTRAINT `fk_addetto_funzionario1`
    FOREIGN KEY (`funzionario_idfunzionario`)
    REFERENCES `merce`.`funzionario` (`idfunzionario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `merce`.`punto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `merce`.`punto` (
  `idpunto` INT NOT NULL auto_increment,
  `denominazione` VARCHAR(45) NULL,
  PRIMARY KEY (`idpunto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `merce`.`controllo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `merce`.`controllo` (
  `data_inizio_controllo` DATETIME NULL,
  `importo_dazio` FLOAT(4,2) NULL,
  `note` VARCHAR(45) NULL,
  `idcontrollo` int NOT NULL auto_increment ,
  `tempo_controllo` INT NULL,
  `esito_tipo` VARCHAR(45) NOT NULL,
  `addetto_idaddetto` INT NOT NULL,
  `punto_idpunto` INT NOT NULL,
  PRIMARY KEY (`idcontrollo`),
 
  CONSTRAINT `fk_controllo_esito1`
    FOREIGN KEY (`esito_tipo`)
    REFERENCES `merce`.`esito` (`tipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_controllo_addetto1`
    FOREIGN KEY (`addetto_idaddetto`)
    REFERENCES `merce`.`addetto` (`idaddetto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_controllo_punto1`
    FOREIGN KEY (`punto_idpunto`)
    REFERENCES `merce`.`punto` (`idpunto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `merce`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `merce`.`categoria` (
  `idcategoria` INT NOT NULL auto_increment,
  `denominazione` VARCHAR(45) NULL,
  PRIMARY KEY (`idcategoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `merce`.`merce`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `merce`.`merce` (
  `descrizione` VARCHAR(60) NULL,
  `quantita` VARCHAR(45) NULL,
  `idmerce` INT NOT NULL auto_increment,
  `controllo_idcontrollo` int NOT NULL,
  `sequestrata` TINYINT NULL,
  `categoria_idcategoria` INT NOT NULL,
  PRIMARY KEY (`idmerce`),
  
  CONSTRAINT `fk_merce_controllo`
    FOREIGN KEY (`controllo_idcontrollo`)
    REFERENCES `merce`.`controllo` (`idcontrollo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_merce_categoria1`
    FOREIGN KEY (`categoria_idcategoria`)
    REFERENCES `merce`.`categoria` (`idcategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `merce`.`seganlazione`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `merce`.`seganlazione` (
  `idseganlazione` INT NOT NULL auto_increment,
  `note` VARCHAR(45) NULL,
  `passeggero_idpasseggero` INT NOT NULL,
  `funzionario_idfunzionario` INT NOT NULL,
  PRIMARY KEY (`idseganlazione`),
  
  CONSTRAINT `fk_seganlazione_passeggero1`
    FOREIGN KEY (`passeggero_idpasseggero`)
    REFERENCES `merce`.`passeggero` (`idpasseggero`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_seganlazione_funzionario1`
    FOREIGN KEY (`funzionario_idfunzionario`)
    REFERENCES `merce`.`funzionario` (`idfunzionario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `merce`.`contestazione`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `merce`.`contestazione` (
  `idcontestazione` INT NOT NULL auto_increment,
  `note` VARCHAR(45) NULL,
  `controllo_idcontrollo` int NOT NULL,
  `addetto_idaddetto` INT NOT NULL,
  PRIMARY KEY (`idcontestazione`),
  
  CONSTRAINT `fk_contestazione_controllo1`
    FOREIGN KEY (`controllo_idcontrollo`)
    REFERENCES `merce`.`controllo` (`idcontrollo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contestazione_addetto1`
    FOREIGN KEY (`addetto_idaddetto`)
    REFERENCES `merce`.`addetto` (`idaddetto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `merce`.`controllo_has_passeggero`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `merce`.`controllo_has_passeggero` (
  `controllo_idcontrollo` int  NOT NULL,
  `passeggero_idpasseggero` INT NOT NULL,
  PRIMARY KEY (`controllo_idcontrollo`, `passeggero_idpasseggero`),
 
  CONSTRAINT `fk_controllo_has_passeggero_controllo1`
    FOREIGN KEY (`controllo_idcontrollo`)
    REFERENCES `merce`.`controllo` (`idcontrollo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_controllo_has_passeggero_passeggero1`
    FOREIGN KEY (`passeggero_idpasseggero`)
    REFERENCES `merce`.`passeggero` (`idpasseggero`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



INSERT INTO `funzionario` (`idfunzionario`, `nome`, `cognome`, `email`, `password`) VALUES (NULL, 'Pippo', 'Pazzo', 'admin@gmail.com', 'admin');
INSERT INTO `funzionario` (`idfunzionario`, `nome`, `cognome`, `email`, `password`) VALUES (NULL, 'Valerio', 'Farruggio', 'farruggiov12@gmail.com', '1234');

INSERT INTO `esito` (`tipo`) VALUES ('positivo');
INSERT INTO `esito` (`tipo`) VALUES ('negativo');

INSERT INTO `punto` (`idpunto`, `denominazione`) VALUES (NULL, 'punto1');
INSERT INTO `punto` (`idpunto`, `denominazione`) VALUES (NULL, 'punto2');

INSERT INTO `addetto` (`idaddetto`, `nome`, `cognome`, `funzionario_idfunzionario`) VALUES (NULL, 'porco', 'porcello', '1');
INSERT INTO `addetto` (`idaddetto`, `nome`, `cognome`, `funzionario_idfunzionario`) VALUES (NULL, 'cane', 'cancello', '2');