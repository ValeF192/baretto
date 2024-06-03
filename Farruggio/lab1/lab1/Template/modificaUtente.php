<?php
echo '<script src="./app.js"></script>';

session_start();//inizializza il cookie di sessione, la sessione inizia

$email=stripslashes(strtolower($_SESSION["email"]));//email minuscola
$pwd=stripslashes($_POST["pwdattuale"]);//levogli slash



$email= $conn->real_escape_string($email);//per accedere al database
$pwd= $conn->real_escape_string($pwd);//funzione del database per evitare l'inserimento di codice sql indesiderato (sql injection)

//$pwd=password_hash($pwd,PASSWORD_DEFAULT);
//echo "$email";
$sql= "SELECT * FROM utente inner join ruolo using(idruolo) WHERE email='$email'";//le righe dove la mail è uguale a qiuella inserita dall'utente
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

if($conta==1){//la mail è univoca, quindi ne deve essere uscito uno
$row =$result->fetch_assoc();//row viene trasformato in un array associativo
$passwordRecuperata=$row["password"];
$controllo=false;
//echo $passwordRecuperata."<br>".$pwd."<br>";

if(password_verify($pwd,$passwordRecuperata)){//confrontas la password recuperata con quella salvata nel db , utilizzando lo stesso algoritmo di hash che è stato utilizzato per salvare la password in fase di registrazione
    $controllo=true;
}


if($controllo){
    //il client mi sta inviando il cookie di sessione?
//il server crea il cookie e viene richiesto per ogni query
$_SESSION["nome"]=$row["nome"];
$_SESSION["cognome"]=$row["cognome"];
$_SESSION["ruolo"]=$row["denominazione"];


    $_SESSION["email"]=$email;
    $_SESSION["password"]=$passwordRecuperata;
    
 echo "login effettuato con successo, bentornato ".$row["nome"]."!"; 
 echo "<br>".$_SESSION["ruolo"];  
 echo '<script>';
 echo 'registraUtente("' . $row["nome"] . '", "' . $row["cognome"] . '", "' . $row["email"] . '");'; // Chiama la funzione JavaScript definita nel file JavaScript
 
 echo '</script>';
 $mailPresente=false;


 //$emailattuale=$_POST["emailattuale"];
 
 $emailattuale=stripslashes(strtolower($_POST["emailattuale"]));//email minuscola
     $emailattuale= $conn->real_escape_string($emailattuale);//per accedere al database
 
 
 //$pwd=password_hash($pwd,PASSWORD_DEFAULT);
 //echo "$email";
 $sql= "SELECT * FROM utente WHERE email='$emailattuale'";//le righe dove la mail è uguale a qiuella inserita dall'utente
 $result=$conn->query($sql);//oggetto che rappresenta la risposta del db
 $conta=$result->num_rows;//utenti con quella mail
 
 if($conta==1){
     echo "abbiamo trovato la corrispondenza sul database<br>";
     $mailPresente=true;
 
 }
 elseif($conta==0){
     echo "non siamo riusciti a trovare la corrispondenza sul database<br>";
     $mailPresente=false;
     header("refresh: 3; url=formmmodifica.php");
     exit;
 }
 
 
 if($mailPresente){
     $nome="";
     $cognome="";
     $email="";
     $pwdUtente="";
     $pwd="";
 if(array_key_exists("nome", $_POST)){
 $nome=$_POST["nome"];
 }
 if(array_key_exists("cognome", $_POST)){
 $cognome=$_POST["cognome"];
 }
 if(array_key_exists("email", $_POST)){
     $email=stripslashes(strtolower($_POST["email"]));//email minuscola
     $email= $conn->real_escape_string($email);//per accedere al database
 
 //$email=$_POST["email"];
 }
 if(array_key_exists("pwd", $_POST)){
     $pwd=stripslashes($_POST["pwd"]);//levogli slash
     $pwd= $conn->real_escape_string($pwd);//funzione del database per evitare l'inserimento di codice sql indesiderato (sql injection)
 $pwdUtente=password_hash($pwd,PASSWORD_DEFAULT);
 }
 
 $mailUtilizzata=false;
 
 $sql= "SELECT * FROM utente WHERE email='$email'";//le righe dove la mail è uguale a qiuella inserita dall'utente
 $result=$conn->query($sql);//oggetto che rappresenta la risposta del db
 $conta=$result->num_rows;//utenti con quella mail
 
 
 if($email==$emailattuale||$email==""){
 $conta=0;
 }
 
 if($conta>0){
     echo "stai tentando di utilizzare una mail già registrata<br>";
     $mailUtilizzata=true;
     header("refresh: 3; url=formmodifica.php");
     exit;
 
 }
 if(!$mailUtilizzata){
 
 if(!($cognome==""&&$nome==""&&$email==""&&$pwd=="")){
 $sql = "UPDATE utente SET ";
 if($cognome!=""){
 $sql.="cognome='$cognome'";
 if($nome!=""){
     $sql.=", ";
 }
 }
 if($nome!=""){
 $sql.="nome='$nome'";
 if($email!=""){
     $sql.=", ";
 }
 }
 if($email!=""){
 $sql.="email='$email'";
 if($pwd!=""){
     $sql.=", ";
 }
 }
 if($pwd!=""){
  $sql.="password='$pwdUtente'";
 }
 
  $sql.=" WHERE  email='$emailattuale' ";
 
  echo '<script>';
  echo 'modificaUtente("' . $cognome . '", "' . $nome . '", "' . $email . '");'; // Chiama la funzione JavaScript definita nel file JavaScript
  echo '</script>';
 
 //echo $sql;
 
 if($conn->query($sql)){
     //il client mi sta inviando il cookie di sessione?
     //il server crea il cookie e viene richiesto per ogni query
     if($email!=""){
         $_SESSION["email"]=$email;
     }
     else{
         $_SESSION["email"]=$emailattuale; 
     }
   //  echo $_SESSION["email"];
    
  //   echo $_SESSION["email"];
     echo "modifica effettuata!";   
   //  echo '<script>';
    // echo 'registraUtente("' . $_POST["nome"] . '", "' . $_POST["cognome"] . '", "' . $_POST["email"] . '");'; // Chiama la funzione JavaScript definita nel file JavaScript
    // echo '</script>';
     
    
 
     header("refresh: 3; url=loginok.php");
  
     exit;
 
 }
 else{
     echo "errore!<br>".$conn->error."<br>";
     header("refresh: 3; url=formmodifica.php");
     exit;
 }
 }
 else{
     echo "non c'erano modifiche!";   
     //  echo '<script>';
      // echo 'registraUtente("' . $_POST["nome"] . '", "' . $_POST["cognome"] . '", "' . $_POST["email"] . '");'; // Chiama la funzione JavaScript definita nel file JavaScript
      // echo '</script>';
       
   
       header("refresh: 3; url=index.php");
    
       exit;
 }
 }
 
 }
 $result->free();
  $conn->close();

}
else{
    echo "password errata";
    header("refresh: 3; url=formmodifica.php");
    exit;
}
}
else if($conta==0){
echo "utente non presente";
header("refresh: 3; url=formmodifica.php");
exit;
}


$result->free();
 $conn->close();







