
mysql -u myuser -p


CREATE DATABASE baretto;


USE baretto;
CREATE TABLE ruolo(
    idruolo INT NOT NULL AUTO_INCREMENT,
    denominazione VARCHAR(50) NOT NULL,
       PRIMARY KEY (idruolo)
  
);

CREATE TABLE utente (
codice INT(50) NOT NULL AUTO_INCREMENT ,
cognome VARCHAR(50) NOT NULL ,
nome VARCHAR(50) NOT NULL ,
email VARCHAR(50) NOT NULL ,
password VARCHAR(5000) NOT NULL ,
idruolo INT(50) NOT NULL  ,
  FOREIGN KEY (idruolo) REFERENCES ruolo(idruolo),
PRIMARY KEY (Codice), UNIQUE (Email)
);

CREATE TABLE commento(
    ID INT NOT NULL AUTO_INCREMENT,
    testo VARCHAR(2000) NOT NULL,
    data DATE NOT NULL,
    idUtente INT(10) NOT NULL,
    ora VARCHAR(10) NOT NULL,
       PRIMARY KEY (id),
    FOREIGN KEY (idUtente) REFERENCES utente(codice)
);
INSERT INTO `ruolo` (`idruolo`, `denominazione`) VALUES (NULL, 'studente');

INSERT INTO `ruolo` (`idruolo`, `denominazione`) VALUES (NULL, 'admin');

INSERT INTO `utente` (`codice`, `cognome`, `nome`, `email`, `password`, `idruolo`) VALUES (NULL, 'admin', 'admin', 'admin@itisfermi.edu.it', '$2y$10$df/mkScNgaqr1atMxa5zFucGA.dVwKfsJddGkiYSiLr3Pr5Tdsivi', '2');

CREATE TABLE `ingrediente` 
(`idingrediente` INT(10) NOT NULL AUTO_INCREMENT ,
 `denominazione` VARCHAR(50) NOT NULL ,
  `allergene` TINYINT NOT NULL ,
   PRIMARY KEY (`idingrediente`)) ;


CREATE TABLE IF NOT EXISTS `portata` (
  `idportata` INT NOT NULL AUTO_INCREMENT,
  `nomeportata` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idportata`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `portata_has_ingrediente` (
  `portata_idportata` INT(10) NOT NULL,
  `ingrediente_idingrediente` INT(10) NOT NULL,
  PRIMARY KEY (`portata_idportata`, `ingrediente_idingrediente`),
  FOREIGN KEY (`portata_idportata`)
    REFERENCES `portata` (`idportata`),
  FOREIGN KEY (`ingrediente_idingrediente`)
    REFERENCES `ingrediente` (`idingrediente`)
);

CREATE TABLE IF NOT EXISTS `categoria` (
  `idcategoria` INT NOT NULL AUTO_INCREMENT,
  `denominazione` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idcategoria`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `menu` (
  `idmenu` INT NOT NULL AUTO_INCREMENT,
  `denominazione` VARCHAR(45) NOT NULL,
  `stato` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`idmenu`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `menu_has_portata` (
  `menu_idmenu` INT NOT NULL,
  `portata_idportata` INT NOT NULL,
  `prezzo` FLOAT(4,2) NOT NULL,
  `categoria_idcategoria` INT ,
  PRIMARY KEY (`menu_idmenu`, `portata_idportata`),
 
  
    FOREIGN KEY (`menu_idmenu`)
    REFERENCES `menu` (`idmenu`),
 
    FOREIGN KEY (`portata_idportata`)
    REFERENCES `portata` (`idportata`),

    FOREIGN KEY (`categoria_idcategoria`)
    REFERENCES `categoria` (`idcategoria`)
    )
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `ordine` (
  `idordine` INT NOT NULL AUTO_INCREMENT,
  `stato` VARCHAR(30) NOT NULL,
   `utente_codice` INT NOT NULL ,
   FOREIGN KEY (`utente_codice`)
    REFERENCES `utente` (`codice`),
  PRIMARY KEY (`idordine`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `ordine_has_portata` (
  `ordine_idordine` INT NOT NULL,
   `menu_idmenu` INT NOT NULL,
  `portata_idportata` INT NOT NULL,
 
  `categoria_idcategoria` INT ,
   `quantita` INT(10) NOT NULL,
  PRIMARY KEY (`ordine_idordine`, `portata_idportata`),
 
 FOREIGN KEY (`ordine_idordine`)
    REFERENCES `ordine` (`idordine`),
  
    FOREIGN KEY (`menu_idmenu`)
    REFERENCES `menu` (`idmenu`),
 
    FOREIGN KEY (`portata_idportata`)
    REFERENCES `portata` (`idportata`),

    FOREIGN KEY (`categoria_idcategoria`)
    REFERENCES `categoria` (`idcategoria`)
    )
ENGINE = InnoDB;

INSERT INTO utente(cognome,nome,email,password) VALUES ('Farruggio','Valerio','farruggiov12@gmail.com','0000');
INSERT INTO utente(cognome,nome,email,password) VALUES ('Pazzo','Pippo','pippopazzo@gmail.com','1010');

INSERT INTO commento(testo,data,idUtente,ora) VALUES('ottimo ristorante','2005-03-04',1,'23:38');";
