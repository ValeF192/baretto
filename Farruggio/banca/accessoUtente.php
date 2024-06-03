<?php

$ID=stripslashes(strtolower($_POST["ID"]));//email minuscola
$pwd=stripslashes($_POST["pwd"]);//levogli slash



$ID= $conn->real_escape_string($ID);//per accedere al database
$pwd= $conn->real_escape_string($pwd);//funzione del database per evitare l'inserimento di codice sql indesiderato (sql injection)

//$pwd=password_hash($pwd,PASSWORD_DEFAULT);
//echo "$email";
$sql= "SELECT * FROM Conto  WHERE CodiceFiscale='$ID'";//le righe dove la mail è uguale a qiuella inserita dall'utente
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail
if($conta==0){
    $sql= "SELECT * FROM Conto  WHERE NumeroConto='$ID'";//le righe dove la mail è uguale a qiuella inserita dall'utente
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail
}
if($conta==1){//la mail è univoca, quindi ne deve essere uscito uno
$row =$result->fetch_assoc();//row viene trasformato in un array associativo
$passwordRecuperata=$row["password"];
$controllo=false;
//echo $passwordRecuperata."<br>".$pwd."<br>";

if($pwd==$passwordRecuperata){//confrontas la password recuperata con quella salvata nel db , utilizzando lo stesso algoritmo di hash che è stato utilizzato per salvare la password in fase di registrazione
    $controllo=true;
}


if($controllo){
    session_start();//inizializza il cookie di sessione, la sessione inizia
    //il client mi sta inviando il cookie di sessione?
//il server crea il cookie e viene richiesto per ogni query
$_SESSION["nome"]=$row["Nome"];
$_SESSION["cognome"]=$row["Cognome"];
$_SESSION["numeroconto"]=$row["NumeroConto"];


    $_SESSION["codicefiscale"]=$row["CodiceFiscale"];
    $_SESSION["password"]=$passwordRecuperata;
    
 echo "login effettuato con successo, bentornato ".$row["Nome"]."!"; 
 echo "<br>Numero del conto:".$_SESSION["numeroconto"];  
 
 header("refresh: 3; url=index.php");
 exit;
}
else{
    echo "password errata";
    header("refresh: 3; url=formlogin.php");
    exit;
}
}
else if($conta==0){
echo "utente non presente";
header("refresh: 3; url=formlogin.php");
exit;
}


$result->free();
 $conn->close();