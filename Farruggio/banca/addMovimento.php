<?php
  session_start();//inizializza il cookie di sessione, la sessione inizia
  
    include "connessione.php";
    $sql= "SELECT SUM(importo) as 'Depositi' FROM Conto INNER JOIN Movimenti on Conto_NumeroConto=NumeroConto WHERE CD=1 AND NumeroConto='".$_SESSION["numeroconto"]."'";//le righe dove la mail è uguale a qiuella inserita dall'utente
    //echo $sql;
    $result=$conn->query($sql);//oggetto che rappresenta la risposta del db
    
    
    $row=$result->fetch_assoc();
    
    
    $sql= "SELECT SUM(importo) as 'Prelievi' FROM Conto INNER JOIN Movimenti on Conto_NumeroConto=NumeroConto WHERE CD=0 AND NumeroConto='".$_SESSION["numeroconto"]."'";//le righe dove la mail è uguale a qiuella inserita dall'utente
    //echo $sql;
    $result=$conn->query($sql);//oggetto che rappresenta la risposta del db
    
    
    $row2=$result->fetch_assoc();
    
    
    
    $soldinelconto= $row["Depositi"]-$row2["Prelievi"];
    if(empty($_POST["causale"])||empty($_POST["importo"])){
        echo "non puoi inserire campi vuoti! <br>";
      header("refresh: 3; url=index.php");
  }
    else if($_POST["importo"]>99){
        echo "non puoi prelevare o depositare più di 99 euro! <br>";
        header("refresh: 3; url=index.php");
    
    
    }
   else if(($soldinelconto-$_POST["importo"])<0&&$_POST["CD"]==0){
        echo "non puoi prelevare, non hai abbastanza soldi! <br>";
        header("refresh: 3; url=index.php");

  
}
 
 
else{
   
    if(strlen($_POST["causale"])>45){
        echo "causale  troppo lunga! <br>";
         echo "hai inserito: ".strlen($_POST["causale"])." caratteri";
    header("refresh: 3; url=index.php");  
    }
    else{
       
$numeroconto=$_SESSION["numeroconto"];

$sql="SELECT * FROM Conto WHERE NumeroConto='$numeroconto'";


$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

if($conta==1){
  $row=$result->fetch_assoc();  
 
  $dataOggi = date('Y-m-d');
  $testo=$conn->real_escape_string(stripslashes($_POST["causale"]));
$oraCorrente =  date('Y-m-d H:i:s');
//echo $oraCorrente." ".$_SESSION["datainizio"];
//$_SESSION["datainizio"]

$sql="INSERT INTO `movimenti` (`ID`, `DataRegistrazione`, `CD`, `Causale`, `Importo`, `Conto_NumeroConto`) VALUES (NULL, '$dataOggi', '".$_POST["CD"]."', '$testo', '".$_POST["importo"]."', '".$_SESSION["numeroconto"]."');";

  if($conn->query($sql)){
    //oggetto che rappresenta la risposta del db
    echo "operazione effettuata con successo!";
 header("refresh: 3; url=index.php");
  
}
}
else {
    echo "utente non trovato!";
    header("refresh: 3; url=formlogin.php");
}
}
}


