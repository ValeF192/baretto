<?php

$host = "localhost";
$username = "myuser";
$password ="myuser";
$db_name ="homebanking";    

$conn = new mysqli($host, $username, $password, $db_name);

if($conn->connect_errno){
    echo "Impossibile connettersi al database";
    exit;
}

?>