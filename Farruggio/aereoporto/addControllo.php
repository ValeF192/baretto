<?php
  session_start();//inizializza il cookie di sessione, la sessione inizia

if(!isset($_POST["esito"])||!isset($_POST["punto"])||!isset($_POST["addetto"])){
    echo "devi prima memorizzare almeno un possibile esito, un possibile punto di controllo, e un possibile addetto! <br>";
    header("refresh: 3; url=index.php");
}

if(!isset($_SESSION["datainizio"])){
    echo "devi prima iniziare il controllo! <br>";
    header("refresh: 3; url=index.php");
}
else if(empty($_POST["note"])||empty($_POST["importo"])){
      echo "non puoi inserire campi vuoti! <br>";
    header("refresh: 3; url=index.php");
}
else{
   
    if(strlen($_POST["note"])>45){
        echo "note troppo lunghe! <br>";
         echo "hai inserito: ".strlen($_POST["note"])." caratteri";
    header("refresh: 3; url=index.php");  
    }
    else{
       
$emailCorrente=$_SESSION["email"];

$sql="SELECT * FROM funzionario WHERE email='$emailCorrente'";


$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

if($conta==1){
  $row=$result->fetch_assoc();  
  $idUtente=$row["idfunzionario"];
  $dataOggi = date('Y-m-d');
  $testo=$conn->real_escape_string(stripslashes($_POST["note"]));
$oraCorrente =  date('Y-m-d H:i:s');
//echo $oraCorrente." ".$_SESSION["datainizio"];
//$_SESSION["datainizio"]
$sql="SELECT (UNIX_TIMESTAMP('$oraCorrente') - UNIX_TIMESTAMP('".$_SESSION["datainizio"]."')) as 'tempo'";
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$row=$result->fetch_assoc();
$tempo_controllo=$row["tempo"];  

$sql="INSERT INTO `controllo` (`data_inizio_controllo`, `importo_dazio`, `note`, `tempo_controllo`, `esito_tipo`, `addetto_idaddetto`, `punto_idpunto`) VALUES ('$dataOggi', '".$_POST["importo"]."', '$testo',' $tempo_controllo' , '".$_POST["esito"]."', '".$_POST["addetto"]."', '".$_POST["punto"]."')";

  if($conn->query($sql)){
    //oggetto che rappresenta la risposta del db
    echo "controllo archiviato con successo!";
 header("refresh: 3; url=annullacontrollo.php");
  
}
}
else {
    echo "utente non trovato!";
    header("refresh: 3; url=formlogin.php");
}
}
}