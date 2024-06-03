<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width>, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php

//Conti (NumeroConto, Cognome, Nome, DataNascita, CodiceFiscale) Movimenti (ID, DataRegistrazione, C/D (credito/debito), Causale, Importo, NumeroConto
if(array_key_exists("nome",$_GET)){
    include './connessione.php';
    
    $nome_tabella="conti";
    $numerononto = $_GET['numeroconto'];
    $cognome = $_GET['cognome'];
    $nome = $_GET['nome'];
    $datanascita = $_GET['datanascita'];
    $codicefiscale = $_GET['codicefiscale'];
    
    $sql= "INSERT INTO $nome_tabella(numeroconto,cognome,nome,datanascita,codicefiscale) VALUES('$numerononto','$cognome','$nome','$datanascita','$codicefiscale')";
    
    $conn->query($sql);
}
else if(array_key_exists("numeroconto",$_GET)){
     include './connessione.php';

    //Conti (NumeroConto, Cognome, Nome, DataNascita, CodiceFiscale) Movimenti (ID, DataRegistrazione, C/D (credito/debito), Causale, Importo, NumeroConto

    
    $nome_tabella="movimenti";
    
    
  
    $dataregistrazione = $_GET['dataregistrazione'];
      $cd = $_GET['cd'];
    $causale = $_GET['causale'];
$importo = $_GET['importo'];
    $numeroconto = $_GET['numeroconto'];
    if($cd=="credito"){
        $cd=true;
    }
    else if ($cd=="debito"){
        $cd=false;
    }
    
    $sql= "INSERT INTO $nome_tabella(dataregistrazione,cd,causale,importo,numeroconto) VALUES('$dataregistrazione','$cd','$causale','$importo','$numeroconto')";
    
    $conn->query($sql);

     
}


?>
    <h1>Conto</h1>
    <form action="" method="get">
        <p>Data di nascita: </p>
        <input type="date" name="datanascita"><br>
        <p>Nome: </p>
        <input type="text" name="nome"><br>
        <p>Cognome: </p>
        <input type="text" name="cognome"><br>
        <p>Codice Fiscale: </p>
        <input type="text" name="codicefiscale"><br>
        <p>Numero Conto: </p>
        <input type="number" name="numeroconto"><br>
        <input type="submit" value="invia">
    </form>



    <h1>Movimento</h1>
    <form action="" method="get">
        <p>Data: </p>
        <input type="date" name="dataregistrazione"><br>
        <p>Causale: </p>
        <input type="text" name="causale"><br>
        <p>Importo: </p>
        <input type="number" name="importo"><br>
        <p>credito o debito: </p><br>
        credito <input type="radio" name="cd" value="credito"><br>
        debito <input type="radio" name="cd" value="debito"><br>
        <p>Numero conto: </p><br>
        <input type="number" name="numeroconto">

        <input type="submit" value="invia">
    </form>
</body>

</html>