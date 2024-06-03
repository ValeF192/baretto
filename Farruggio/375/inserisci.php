<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width>, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    //Prodotti (Codice, Descrizione e Prezzo) e Movimenti (Numero, Data, Quantità e CodiceProdotto)
if(array_key_exists("prezzo",$_GET)){
    include './connessione.php';
    
    $codiceprodotto=$_GET["codiceprodotto"];
    $descrizione = $_GET['descrizione'];
    $prezzo = $_GET['prezzo'];
    $nome_tabella = "prodotti";
    
    
    $sql= "INSERT INTO $nome_tabella(codiceprodotto,descrizione,prezzo) VALUES('$codiceprodotto','$descrizione','$prezzo')";
    
    $conn->query($sql);
}
else if(array_key_exists("datamovimento",$_GET)){
     

    //Prodotti (Codice, Descrizione e Prezzo) e Movimenti (Numero, Data, Quantità e CodiceProdotto)
    
    include './connessione.php';
    
    
    $datamovimento = $_GET['datamovimento'];
    $quantita = $_GET['quantita'];
    $codiceprodotto = $_GET['codiceprodotto'];
    $nome_tabella = "movimenti";
    
    
    $sql= "INSERT INTO $nome_tabella(datamovimento,quantita,codiceprodotto) VALUES('$datamovimento','$quantita','$codiceprodotto')";
    
    $conn->query($sql);

     
}
else {


echo '  <h1>Prodotto</h1>
    <form action="" method="get">

        <p>Codice Prodotto: </p>
        <input type="number" name="codiceprodotto">
        <p>Descrizione: </p>
        <input type="text" name="descrizione"><br>

        <p>Prezzo: </p>
        <input type="number" name="prezzo">

        <input type="submit" value="invia">
    </form>



    <h1>Movimento</h1>
    <form action="" method="get">
        <p>Data: </p>
        <input type="date" name="datamovimento"><br>
        <p>Quantità: </p>
        <input type="number" name="quantita">

        <p>Codice Prodotto: </p>
        <input type="number" name="codiceprodotto">


        <input type="submit" value="invia">
    </form>';
}

?>

</body>

</html>