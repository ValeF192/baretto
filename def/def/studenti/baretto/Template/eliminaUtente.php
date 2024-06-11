<?php
echo '<script src="./app.js"></script>';

$mailPresente=false;


//$emailattuale=$_POST["emailattuale"];

$emailattuale=stripslashes(strtolower($_SESSION["email"]));//email minuscola
    $emailattuale= $conn->real_escape_string($emailattuale);//per accedere al database


//$pwd=password_hash($pwd,PASSWORD_DEFAULT);
//echo "$email";
$sql= "SELECT * FROM utente WHERE email='$emailattuale'";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

if($conta==1){
    echo "abbiamo trovato la corrispondenza sul database<br>";
    $row=$result->fetch_assoc();
   $idCorrente= $row["codice"];
   $sql= "DELETE FROM commento WHERE idUtente='$idCorrente'";//le righe dove la mail è uguale a qiuella inserita dall'utente
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db

$sql="SELECT * FROM ordine where utente_codice='$idCorrente'";

$result=$conn->query($sql);//oggetto che rappresenta la risposta del db

while($row=$result->fetch_assoc())

{

$sql= "DELETE FROM ordine_has_portata WHERE ordine_idordine='".$row["idordine"]."'";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$conn->query($sql);//oggetto che rappresenta la risposta del db

$sql= "DELETE FROM ordine WHERE idordine='".$row["idordine"]."'";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$conn->query($sql);//oggetto che rappresenta la risposta del db
}
   

echo "ricorda, tutti i commenti e ordini che hai fatto saranno eliminati!<br>";
    $mailPresente=true;

}
elseif($conta==0){
    echo "non siamo riusciti a trovare la corrispondenza sul database<br>";
    $mailPresente=false;
    header("refresh: 3; url=formregistrazione.php");
    exit;
}


if($mailPresente){
   

$sql= "DELETE FROM utente WHERE email='$emailattuale'";//le righe dove la mail è uguale a qiuella inserita dall'utente

$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
//$conta=$result->num_rows;//utenti con quella mail



 echo '<script>';
 echo 'eliminaUtente();'; // Chiama la funzione JavaScript definita nel file JavaScript
 echo '</script>';
 
//echo $sql;

if($conn->query($sql)){
    echo "utente eliminato con successo!";   
  //  echo '<script>';
   // echo 'registraUtente("' . $_POST["nome"] . '", "' . $_POST["cognome"] . '", "' . $_POST["email"] . '");'; // Chiama la funzione JavaScript definita nel file JavaScript
   // echo '</script>';
    

   // header("refresh: 3; url=index.php");
 
    exit;

}
else{
    echo "errore!<br>".$conn->error."<br>";
    header("refresh: 3; url=formregistrazione.php");
    exit;
}
}
else{
    echo "mail non trovata!";   
    //  echo '<script>';
     // echo 'registraUtente("' . $_POST["nome"] . '", "' . $_POST["cognome"] . '", "' . $_POST["email"] . '");'; // Chiama la funzione JavaScript definita nel file JavaScript
     // echo '</script>';
      
  
      header("refresh: 3; url=index.php");
   
      exit;
}



$result->free();
 $conn->close();