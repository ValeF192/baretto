<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>

    <?php
   
    if(array_key_exists("numeroconto",$_GET)){
    include './connessione.php';
    
    $numeroconto = $_GET['numeroconto'];
    $sql= "SELECT * FROM movimenti WHERE numeroconto = $numeroconto";
    
    $result = $conn->query($sql);
    
    echo "<ol>";
    while($row=$result->fetch_assoc()){

         if($row["cd"]==true){
        $row["cd"]="credito";
    }
    else if ($row["cd"]==false){
        $row["cd"]="debito";
    }
    
    echo "<li>" . "Data Registrazione: " . $row['dataregistrazione'];
    echo " Importo: " . $row['importo'];
    echo " Causale: ". $row['causale'];
    echo " C/D: ". $row['cd'];
    
    }
    
    $conn->close();
    }
    else echo '<form method="get" action="">
        <p>
            Inserisci numero conto: <input type="number" name="numeroconto">
        </p>
        <input type="submit" value="Invia">
    </form>';
    ?>

</body>

</html>