<?php
    
session_start();//il client mi sta inviando il cookie di sessione?

if(!isset($_SESSION["numeroconto"])){//se la mail non è presente nell'array $session
    header("Location: formlogin.php");//redirect alla registrazione
}
else{
   echo " <h2>";
    echo "Numero Conto: ".$_SESSION["numeroconto"] ;
    echo "<br>Nome: ".$_SESSION["nome"] ;
    echo "<br>Cognome: ".$_SESSION["cognome"] ;
    echo "<br>Codice Fiscale: ".$_SESSION["codicefiscale"] ;




   

    include "connessione.php";
$sql= "SELECT SUM(importo) as 'Depositi' FROM Conto INNER JOIN Movimenti on Conto_NumeroConto=NumeroConto WHERE CD=1 AND NumeroConto='".$_SESSION["numeroconto"]."'";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db


$row=$result->fetch_assoc();


$sql= "SELECT SUM(importo) as 'Prelievi' FROM Conto INNER JOIN Movimenti on Conto_NumeroConto=NumeroConto WHERE CD=0 AND NumeroConto='".$_SESSION["numeroconto"]."'";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db


$row2=$result->fetch_assoc();



echo "<br>Soldi nel conto: ". $row["Depositi"]-$row2["Prelievi"];

echo "</h2>";
}
    ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banca di Farruggio</title>

</head>
<body style="background-repeat: no-repeat; background-size: 105%;" >
   

 <form method="post" action="eseguioperazione.php">
<fieldset class="info_personali">
    <legend>
        Prelievo/deposito
    </legend>
   
    <ol style="padding-bottom: 20px;" >
        <p style="padding-top: 20px;" id="P">
        
</p>
       
            <label for="importo">importo: </label>
            <input type="number" name="importo" id="importo" min="0" step="0.01"><br>
        
       
      
     
            <label for="note">motivo del prelievo/deposito: </label>
            <input type="text" name="causale" id="causale" maxlength="45"><br>

            <label for="lang">Tipo di Operazione:</label>
<select name="CD" id="CD">
<option value="0">Prelievo</option>
<option value="1">Deposito</option>
</select><br>

       





       
            <input type="submit" value="invia">
     
    </ol>
</fieldset>

 </form>

 <h2>Lista Completa Movimenti Carta</h2>

 <div style=" width: 300px; /* Larghezza della sezione */
            height: 60px; /* Altezza della sezione */
            overflow-y: scroll; /* Abilita lo scorrimento verticale */
            border: 1px solid #ccc; /* Bordo per la sezione */
            padding: 20px; /* Spaziatura interna */
            ">

            <?php

    include "connessione.php";
$sql= "SELECT * FROM Conto INNER JOIN Movimenti on Conto_NumeroConto=NumeroConto WHERE NumeroConto='".$_SESSION["numeroconto"]."'";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

while($row=$result->fetch_assoc()){
$operazione="";
if($row["CD"]==0){
$operazione="Prelievo";
}
else if($row["CD"]==1){
    $operazione="Deposito";
}

    $dateTime = new DateTime($row["DataRegistrazione"]);

// Formatta la data nel formato italiano
$dataItaliana = $dateTime->format('d-m-Y');
    echo "operazione: ".$operazione."<br>importo: ".$row["Importo"]."<br>Causale: ".$row ["Causale"]."<br>data: ".$dataItaliana."<br> ID movimento: ".$row ["ID"]."<br><br>";


    
    
}


?> 

 </div>


<h2>Visualizza da data a data</h2>

<form action="data_a_data.php" method="post">
Movimenti<br>Da: <input type="date" name="datainizio">
<br>A:<input type="date" name="datafine">
<br><input type="submit" value="applica">


</form>

 <div style=" width: 300px; /* Larghezza della sezione */
            height: 60px; /* Altezza della sezione */
            overflow-y: scroll; /* Abilita lo scorrimento verticale */
            border: 1px solid #ccc; /* Bordo per la sezione */
            padding: 20px; /* Spaziatura interna */
            ">

            <?php
if(isset($_SESSION["datainizio"])&&isset($_SESSION["datafine"])){
    include "connessione.php";
$sql= "SELECT * FROM Conto INNER JOIN Movimenti on Conto_NumeroConto=NumeroConto WHERE DataRegistrazione BETWEEN '".$_SESSION["datainizio"]."' AND '".$_SESSION["datafine"]."' AND  NumeroConto='".$_SESSION["numeroconto"]."'";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

while($row=$result->fetch_assoc()){
$operazione="";
if($row["CD"]==0){
$operazione="Prelievo";
}
else if($row["CD"]==1){
    $operazione="Deposito";
}

    $dateTime = new DateTime($row["DataRegistrazione"]);

// Formatta la data nel formato italiano
$dataItaliana = $dateTime->format('d-m-Y');
    echo "operazione: ".$operazione."<br>importo: ".$row["Importo"]."<br>Causale: ".$row ["Causale"]."<br>data: ".$dataItaliana."<br> ID movimento: ".$row ["ID"]."<br><br>";


    
    
}

}
?> 

 </div>




 <h2>Trova per parola chiave nella causale</h2>

<form action="parolachiave.php" method="post">
Movimenti<br>Contenenti la parola chiave : <input type="text" name="parolachiave">
o simili
<br><input type="submit" value="applica">


</form>

 <div style=" width: 300px; /* Larghezza della sezione */
            height: 60px; /* Altezza della sezione */
            overflow-y: scroll; /* Abilita lo scorrimento verticale */
            border: 1px solid #ccc; /* Bordo per la sezione */
            padding: 20px; /* Spaziatura interna */
            ">

            <?php
if(isset($_SESSION["parolachiave"])){
    include "connessione.php";
$sql= "SELECT * FROM Conto INNER JOIN Movimenti on Conto_NumeroConto=NumeroConto WHERE Causale LIKE '%".$_SESSION["parolachiave"]."%' AND  NumeroConto='".$_SESSION["numeroconto"]."'";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

while($row=$result->fetch_assoc()){
$operazione="";
if($row["CD"]==0){
$operazione="Prelievo";
}
else if($row["CD"]==1){
    $operazione="Deposito";
}

    $dateTime = new DateTime($row["DataRegistrazione"]);

// Formatta la data nel formato italiano
$dataItaliana = $dateTime->format('d-m-Y');
    echo "operazione: ".$operazione."<br>importo: ".$row["Importo"]."<br>Causale: ".$row ["Causale"]."<br>data: ".$dataItaliana."<br> ID movimento: ".$row ["ID"]."<br><br>";


    
    
}

}
?> 

 </div>



 <h2>Trova per valore dell'importo</h2>

<form action="trovaperimporto.php" method="post">
Movimenti<br>Aventi importo <select name="SI" id="SI">
<option value="0">Superiore</option>
<option value="1">Inferiore</option>
</select> 
  A: <input type="number" name="importo" min="0" step="0.01">

<br><input type="submit" value="applica">


</form>

 <div style=" width: 300px; /* Larghezza della sezione */
            height: 60px; /* Altezza della sezione */
            overflow-y: scroll; /* Abilita lo scorrimento verticale */
            border: 1px solid #ccc; /* Bordo per la sezione */
            padding: 20px; /* Spaziatura interna */
            ">

            <?php
if(isset($_SESSION["importo"])&&isset($_SESSION["SI"])){



    include "connessione.php";
$sql="";
    if($_SESSION["SI"] == 0){
        $sql = "SELECT * FROM Conto INNER JOIN Movimenti ON Conto_NumeroConto=NumeroConto WHERE Movimenti.Importo >= '".$_SESSION["importo"]."' AND NumeroConto='".$_SESSION["numeroconto"]."'";
    } else if ($_SESSION["SI"] == 1){
        $sql = "SELECT * FROM Conto INNER JOIN Movimenti ON Conto_NumeroConto=NumeroConto WHERE Movimenti.Importo <= '".$_SESSION["importo"]."' AND NumeroConto='".$_SESSION["numeroconto"]."'";
    }
//$sql= "SELECT * FROM Conto INNER JOIN Movimenti on Conto_NumeroConto=NumeroConto WHERE NumeroConto='".$_SESSION["numeroconto"]."'";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

while($row=$result->fetch_assoc()){
$operazione="";
if($row["CD"]==0){
$operazione="Prelievo";
}
else if($row["CD"]==1){
    $operazione="Deposito";
}

    $dateTime = new DateTime($row["DataRegistrazione"]);

// Formatta la data nel formato italiano
$dataItaliana = $dateTime->format('d-m-Y');
    echo "operazione: ".$operazione."<br>importo: ".$row["Importo"]."<br>Causale: ".$row ["Causale"]."<br>data: ".$dataItaliana."<br> ID movimento: ".$row ["ID"]."<br><br>";


    
    
}

}
?> 

 </div>





<a href="logout.php">Logout</a>


</body>
</html>