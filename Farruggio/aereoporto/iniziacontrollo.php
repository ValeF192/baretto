<?php
    
session_start();//il client mi sta inviando il cookie di sessione?

if(!isset($_SESSION["email"])){//se la mail non è presente nell'array $session
    header("Location: formlogin.php");//redirect alla registrazione
}
else{
    echo $_SESSION["email"] ;
   $_SESSION["datainizio"] =date('Y-m-d H:i:s');
   echo "<br>". $_SESSION["datainizio"];
   header("refresh: 0; url=index.php");

}
    ?>