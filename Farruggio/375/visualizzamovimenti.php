<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>

    <?php

     //Prodotti (Codice, Descrizione e Prezzo) e Movimenti (Numero, Data, Quantità e CodiceProdotto)
   //Scrivi una pagina PHP per visualizzare il numero, la data e il codice del prodotto dei movimenti nel database Magazzino che hanno una quantità movimentata superiore a 50 pezzi.
    
    include './connessione.php';
    

    $sql= "SELECT * FROM movimenti WHERE quantita > 50";
    
    $result = $conn->query($sql);
    
    echo "<ol>";
    while($row=$result->fetch_assoc()){
    
    echo "<li>" . "Numero Movimento: " . $row['numero'];
    echo " Data Movimento: " . $row['datamovimento'];
    echo " Quantità: ". $row['quantita'];
    echo " Codice Prodotto: ". $row['codiceprodotto'];
    
    }
    
    $conn->close();
    
    
    ?>

</body>

</html>