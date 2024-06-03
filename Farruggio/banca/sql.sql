DROP  DATABASE banca;
CREATE DATABASE banca;

CREATE TABLE  `banca`.`Conto` (
  `NumeroConto` INT NOT NULL AUTO_INCREMENT,
  `Cognome` VARCHAR(45) NULL,
  `Nome` VARCHAR(45) NULL,
  `DataNascita` DATE NULL,
  `CodiceFiscale` CHAR(16) NULL,
  `password` VARCHAR(100) NULL,
  PRIMARY KEY (`NumeroConto`))
ENGINE = InnoDB;



CREATE TABLE  `banca`.`Movimenti` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `DataRegistrazione` DATE NULL,
  `CD` TINYINT NULL,
  `Causale` VARCHAR(45) NULL,
  `Importo` FLOAT(4,2) NULL,
  `Conto_NumeroConto` INT NOT NULL,
  PRIMARY KEY (`ID`),
  

    FOREIGN KEY (`Conto_NumeroConto`)
    REFERENCES `banca`.`Conto` (`NumeroConto`))
ENGINE = InnoDB;

INSERT INTO `conto` (`NumeroConto`, `Cognome`, `Nome`, `DataNascita`, `CodiceFiscale`, `password`) VALUES (NULL, 'Farruggio', 'Valerio', '2005-04-03', 'FRRVLR05D03H501Q', '1234');