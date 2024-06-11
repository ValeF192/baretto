<?php 
$host ="localhost";
$db_name="baretto";
$username ="root";
$password="root";

$conn = new mysqli($host,$username,$password,$db_name);

if($conn->connect_errno){
echo " si è verificato un errore di connessione al database<br>";
echo $conn->error."<br>";
exit;
}else{
 //echo "puoi continuare!";  
}