<?php

session_start();//il client mi sta inviando il cookie di sessione?

if(!isset($_SESSION["numeroconto"])){//se la mail non è presente nell'array $session
    header("Location: formlogin.php");//redirect alla registrazione
}
else{
$_SESSION["parolachiave"]=$_POST["parolachiave"];

header("Location: index.php");//redirect alla registrazione


}