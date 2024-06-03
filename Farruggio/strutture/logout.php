<?php
session_start();
$_SESSION=array();//elimino la sessione
session_destroy();
echo "<h1>Disconnessione effettuata!</h1>";
  header("refresh: 3; url=formlogin.php");

?>