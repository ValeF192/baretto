<?php

if(empty($_POST["testo"])){
      echo "non puoi inserire un commento vuoto! <br>";
    header("refresh: 3; url=index.php");
}
else{
   
    if(strlen($_POST["testo"])>2000){
        echo "commento troppo lungo! <br>";
         echo "hai inserito: ".strlen($_POST["testo"])." caratteri";
    header("refresh: 3; url=index.php");  
    }
    else{
  session_start();//inizializza il cookie di sessione, la sessione inizia
       
$emailCorrente=$_SESSION["email"];

$sql="SELECT * FROM utente WHERE email='$emailCorrente'";


$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

if($conta==1){
  $row=$result->fetch_assoc();  
  $idUtente=$row["codice"];
  $dataOggi = date('Y-m-d');
  $testo=$conn->real_escape_string(stripslashes($_POST["testo"]));
$oraCorrente = date('H:i');

  $sql="INSERT INTO commento(testo,data,idUtente,ora) VALUES('$testo','$dataOggi',$idUtente,'$oraCorrente');";

  if($conn->query($sql)){
    //oggetto che rappresenta la risposta del db
    echo "commento archiviato con successo!";
 header("refresh: 3; url=index.php");
  
}
}
else {
    echo "utente non trovato!";
    header("refresh: 3; url=formaccesso.php");
}
}
}