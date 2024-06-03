


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
    <title>strutture di Farruggio</title>

</head>
<body style="background-repeat: no-repeat; background-size: 105%;" >
<h2><a href="logout.php">Logout</a></h2>

 <form method="post" action="inserisci.php" enctype="multipart/form-data">
<fieldset class="info_personali">

    <legend>
       inserisci nuova struttura
    </legend>
   
    <ol style="padding-bottom: 20px;" >
        <p style="padding-top: 20px;" id="P">
        
</p>
<label for="note">nome: </label>
            <input type="text" name="nome" id="nome" maxlength="45"><br>

           

            <label for="indirizzo">indirizzo: </label>
            <input type="text" name="indirizzo" id="indirizzo" maxlength="45"><br>

            <label for="note">telefono: </label>
            <input type="number" name="telefono" id="telefono" maxlength="45"><br>

            <label for="email">email: </label>
            <input type="email" name="email" id="email" maxlength="45"><br>


            <label for="importo">prezzo a notte: </label>
            <input type="number" name="importo" id="importo" min="0" step="0.01"><br>
        
       
      
     
           

            <label for="lang">Categoria:</label>
<select name="categoria" id="categoria">
<?php
include "connessione.php";
$sql= "SELECT * FROM categoria ";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db


while($row=$result->fetch_assoc()){

echo '<option value="'.$row["idcategoria"].'">'.$row["nomecategoria"].'</option>';




}




?>

</select><br>


<label>regione:</label> <select name="regione" id="regione">
<?php
include "connessione.php";
$sql= "SELECT * FROM regione ";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db


while($row=$result->fetch_assoc()){

echo '<option value="'.$row["idregione"].'">'.$row["nomeregione"].'</option>';




}




?>

</select><br>
       
<label>Inserire l'immagine:</label>
    <input type="file" name="image">




       
            <input type="submit" value="invia">
     
    </ol>
</fieldset>

 </form>


 <form method="post" action="modifica.php" >
 <label for="struttura">struttura da modificare: </label>

 <select name="idstruttura" >
<?php
include "connessione.php";
$sql= "SELECT * FROM struttura ";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db


while($row=$result->fetch_assoc()){

echo '<option value="'.$row["idstruttura"].'">'.$row["idstruttura"].' - '.$row["nome"].'</option>';




}




?>

</select><br>

<label for="importo">nuovo prezzo a notte: </label>
            <input type="number" name="importo" id="importo" min="0" step="0.01"><br>
        
 <input type="submit" value="invia">
 </form>

 <form method="post" action="elimina.php" >
 <label for="struttura">struttura da eliminare: </label>

 <select name="idstruttura" >
<?php
include "connessione.php";
$sql= "SELECT * FROM struttura ";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db


while($row=$result->fetch_assoc()){

echo '<option value="'.$row["idstruttura"].'">'.$row["idstruttura"].' - '.$row["nome"].'</option>';




}




?>

</select><br>


 <input type="submit" value="invia">
 </form>
<br>
 <label for="lang">imposta criteri di ricerca:</label><br>
<form method="post" action="impostacr.php" >


<label for="lang">Categoria:</label>
<select name="categoria" id="categoria">
<?php
include "connessione.php";
$sql= "SELECT * FROM categoria ";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db


while($row=$result->fetch_assoc()){

echo '<option value="'.$row["idcategoria"].'">'.$row["nomecategoria"].'</option>';




}




?>

</select><br>


<label>regione:</label> <select name="regione" id="regione">
<?php
include "connessione.php";
$sql= "SELECT * FROM regione ";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db


while($row=$result->fetch_assoc()){

echo '<option value="'.$row["idregione"].'">'.$row["nomeregione"].'</option>';




}




?>

</select><br>
<input type="submit" value="imposta filtri">
</form>
<br>
<form method="post" action="impostap.php" >





<label>Provincia:</label> <select name="provincia" >
<?php
include "connessione.php";
$sql= "SELECT distinct provincia FROM regione ";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db


while($row=$result->fetch_assoc()){

echo '<option value="'.$row["provincia"].'">'.$row["provincia"].'</option>';




}




?>

</select>
<input type="submit" value="imposta filtro">
</form>
<br>
<form action="impostapr.php" method="post">
Strutture<br>Aventi prezzo a notte: <select name="SI" id="SI">
<option value="0">Superiore</option>
<option value="1">Inferiore</option>
</select> 
  A: <input type="number" name="importo" min="0" step="0.01">

<input type="submit" value="applica">


</form>


<form method="post" action="annullafiltri.php" >
<label>annulla filtri:</label>
<input type="submit" value="applica">
</form>

 <h2>Lista Completa Strutture</h2>
 <h2>Filtri Applicati: <?php $condizioni="";

if(array_key_exists("condizione1",$_SESSION)){
    if(!is_null($_SESSION["condizione1"])){

    $condizioni.=$_SESSION["condizione1"];
    }
}


if(array_key_exists("condizione2",$_SESSION)){
    if(!is_null($_SESSION["condizione2"])){

    if(array_key_exists("condizione1",$_SESSION)){
        if(!is_null($_SESSION["condizione1"])){
        $condizioni.=" AND ";
    }
    }

    $condizioni.=$_SESSION["condizione2"];
}
}

if(array_key_exists("condizione3",$_SESSION)){
if(!is_null($_SESSION["condizione3"])){
    if(array_key_exists("condizione2",$_SESSION)||array_key_exists("condizione1",$_SESSION)){
        if(!is_null($_SESSION["condizione2"])||!is_null($_SESSION["condizione1"])){

        $condizioni.=" AND ";
        }
    }

    $condizioni.=$_SESSION["condizione3"];
}
} echo $condizioni?></h2>


 <div style=" width: 300px; /* Larghezza della sezione */
            height: 60px; /* Altezza della sezione */
            overflow-y: scroll; /* Abilita lo scorrimento verticale */
            border: 1px solid #ccc; /* Bordo per la sezione */
            padding: 20px; /* Spaziatura interna */
            ">

            <?php

    include "connessione.php";

$condizioni="WHERE ";

if(array_key_exists("condizione1",$_SESSION)){
    if(!is_null($_SESSION["condizione1"])){

    $condizioni.=$_SESSION["condizione1"];
    }
}


if(array_key_exists("condizione2",$_SESSION)){
    if(!is_null($_SESSION["condizione2"])){

    if(array_key_exists("condizione1",$_SESSION)){
        if(!is_null($_SESSION["condizione1"])){
        $condizioni.=" AND ";
    }
    }

    $condizioni.=$_SESSION["condizione2"];
}
}

if(array_key_exists("condizione3",$_SESSION)){
if(!is_null($_SESSION["condizione3"])){
    if(array_key_exists("condizione2",$_SESSION)||array_key_exists("condizione1",$_SESSION)){
        if(!is_null($_SESSION["condizione2"])||!is_null($_SESSION["condizione1"])){

        $condizioni.=" AND ";
        }
    }

    $condizioni.=$_SESSION["condizione3"];
}
}

if($condizioni=="WHERE "){
    $condizioni="";
}
$sql= "SELECT * FROM struttura INNER JOIN categoria on categoria_idcategoria=idcategoria INNER JOIN regione ON regione_idregione=idregione $condizioni ";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

while($row=$result->fetch_assoc()){

    echo "<br>nome: ".$row["nome"]."<br>indirizzo: ".$row["indirizzo"]."<br>telefono: ".$row["telefono"]."<br>email: ".$row["email"]."<br>regione: ".$row["nomeregione"]."<br>categoria: ".$row["nomecategoria"]."<br>prezzo a notte: ".$row["prezzo"];
    echo '<br>immagine: <img src="data:image/jpg;charset=utf8;base64,'.base64_encode($row['foto']).'"  /><br>';
    
echo "<br>";
    
    
}


?> 

 </div>



</body>
</html>