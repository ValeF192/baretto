<?php

$email=stripslashes(strtolower($_POST["email"]));//email minuscola
$pwd=stripslashes($_POST["pwd"]);//levogli slash



$email= $conn->real_escape_string($email);//per accedere al database
$pwd= $conn->real_escape_string($pwd);//funzione del database per evitare l'inserimento di codice sql indesiderato (sql injection)

//$pwd=password_hash($pwd,PASSWORD_DEFAULT);
//echo "$email";
$sql= "SELECT * FROM funzionario  WHERE email='$email'";//le righe dove la mail è uguale a qiuella inserita dall'utente
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

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
$_SESSION["nome"]=$row["nome"];
$_SESSION["cognome"]=$row["cognome"];
$_SESSION["idfunzionario"]=$row["idfunzionario"];


    $_SESSION["email"]=$email;
    $_SESSION["password"]=$passwordRecuperata;
    
 echo "login effettuato con successo, bentornato ".$row["nome"]."!"; 
 echo "<br>".$_SESSION["idfunzionario"];  
 
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