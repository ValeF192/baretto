<?php
    
session_start();//il client mi sta inviando il cookie di sessione?

if(!isset($_SESSION["email"])){//se la mail non è presente nell'array $session
    header("Location: formlogin.php");//redirect alla registrazione
}
else{
    echo $_SESSION["email"] ;
}
    ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ristorante di Farruggio</title>
    <link rel="stylesheet" href="./css/style.css" type="text/css">

</head>
<body style="background-repeat: no-repeat; background-size: 105%;" >
   <?php

   if(!isset($_SESSION["datainizio"])){
echo '<a href="iniziacontrollo.php">Inizia controllo</a>';
   }
   else{
    echo 'Controllo iniziato alle ore:' .$_SESSION["datainizio"];

    echo '<a href="annullacontrollo.php">annulla controllo</a>';

   }
?>

 <form method="post" action="controlla.php">
<fieldset class="info_personali">
    <legend>
        Inserisci le Informazioni relative al controllo!
    </legend>
   
    <ol style="padding-bottom: 20px;" >
        <p style="padding-top: 20px;" id="P">
        
</p>
       
            <label for="importo">quale è l'importo</label>
            <input type="number" name="importo" id="importo" min="0" step="0.01"><br>
        
       
      
     
            <label for="note">Note</label>
            <input type="text" name="note" id="note" maxlength="45"><br>
      
        <?php
include "connessione.php";
echo '<label for="lang">Addetto:</label>
<select name="addetto" id="addetto">';
$sql= "SELECT * FROM addetto where funzionario_idfunzionario='".$_SESSION["idfunzionario"]."'";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db


while($row=$result->fetch_assoc()){

echo '<option value="'.$row["idaddetto"].'">'.$row["nome"].' '.$row["cognome"].'</option>';




}


echo '</select><br>';

?>


<?php
include "connessione.php";
echo '<label for="lang">Esito:</label>
<select name="esito" id="esito">';
$sql= "SELECT * FROM esito";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db


while($row=$result->fetch_assoc()){

echo '<option value="'.$row["tipo"].'"> '.$row["tipo"].'</option>';




}


echo '</select><br>';

?>

<?php
include "connessione.php";
echo '<label for="lang">Punto:</label>
<select name="punto" id="punto">';
$sql= "SELECT * FROM punto";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db


while($row=$result->fetch_assoc()){

echo '<option value="'.$row["idpunto"].'"> '.$row["denominazione"].'</option>';




}


echo '</select><br>';

?>
       
            <input type="submit" value="invia">
     
    </ol>
</fieldset>

 </form>


 <div class="scrolling-section">

            <?php

    include "connessione.php";
$sql= "SELECT * FROM controllo INNER JOIN addetto on addetto_idaddetto=idaddetto inner join punto on punto_idpunto=idpunto";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

while($row=$result->fetch_assoc()){
    $dateTime = new DateTime($row["data_inizio_controllo"]);

// Formatta la data nel formato italiano
$dataItaliana = $dateTime->format('d-m-Y');
    echo "importo: ".$row["importo_dazio"]."<br>note: ".$row ["note"]."<br>data: ".$dataItaliana."<br> secondi impiegati: ".$row ["tempo_controllo"]."<br>addetto: ".$row ["nome"]." ".$row ["cognome"]."<br> esito: ".$row ["esito_tipo"]."<br> punto: ".$row ["denominazione"]."<br><br>";


    
    
}


?> 




<a href="logout.php">Logout</a>


</body>
</html>