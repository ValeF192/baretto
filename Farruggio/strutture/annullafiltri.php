<?php
    
session_start();//il client mi sta inviando il cookie di sessione?

if(!isset($_SESSION["email"])){//se la mail non è presente nell'array $session
    header("Location: formlogin.php");//redirect alla registrazione
}
else{
   // echo $_SESSION["email"] ;
}

$_SESSION["condizione1"]=NULL;
$_SESSION["condizione2"]=NULL;
$_SESSION["condizione3"]=NULL;

header("refresh: 3; url=index.php");

echo "filtri annullati!";

