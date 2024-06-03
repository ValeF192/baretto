<?php
$sql="SELECT * FROM portata   WHERE nomeportata='".$_POST["nomeportata"]."'";


$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

if(empty($_POST["nomeportata"])){
      echo "non puoi inserire una portata vuota! <br>";
    header("refresh: 3; url=editmenu.php");
}


  else if($conta>0){
      echo "portata già presente! <br>";
 
      $sql="SELECT max(idingrediente) as massimo FROM ingrediente";


    $result=$conn->query($sql);//oggetto che rappresenta la risposta del db
    $row=$result->fetch_assoc(); 

    $sql="SELECT idportata from portata where nomeportata='".$_POST["nomeportata"]."'";


    $result=$conn->query($sql);//oggetto che rappresenta la risposta del db
    $conta=$result->num_rows;//utenti con quella mail
    $row2=$result->fetch_assoc(); 



    $sql="DELETE  from portata_has_ingrediente where portata_idportata='".$row2["idportata"]."'";


    $result=$conn->query($sql);//oggetto che rappresenta la risposta del db

   for($i=1;$i<=$row["massimo"];$i++){
    if(isset($_POST[$i])){
    $sql="INSERT INTO portata_has_ingrediente(ingrediente_idingrediente,portata_idportata) VALUES ('".$_POST[$i]."','".$row2["idportata"]."') ";
    

    $result=$conn->query($sql);//oggetto che rappresenta la risposta del db
}
   
   } 



    //oggetto che rappresenta la risposta del db
    echo "portata modificata con successo!";
 header("refresh: 3; url=editmenu.php");


  } 

else{
  
   
    if(strlen($_POST["nomeportata"])>49){
        echo "testo troppo lungo! <br>";
         echo "hai inserito: ".strlen($_POST["nomeportata"])." caratteri";
    header("refresh: 3; url=editmenu.php");  
    }
    else{
  session_start();//inizializza il cookie di sessione, la sessione inizia
       
$emailCorrente=$_SESSION["email"];

$sql="SELECT * FROM utente  inner join ruolo using (idruolo) WHERE email='$emailCorrente'";


$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail
$row=$result->fetch_assoc(); 

if($conta==1&&$row["denominazione"]!="studente"){
 
  $testo=$conn->real_escape_string(stripslashes($_POST["nomeportata"]));
/*$allergene=$_POST["allergene"];
if(isset($allergene)){
    $allergene=1;
}
else{
    $allergene=0;
}*/

  $sql="INSERT INTO portata(nomeportata) VALUES('$testo');";

  if($conn->query($sql)){

    $sql="SELECT max(idingrediente) as massimo FROM ingrediente";


    $result=$conn->query($sql);//oggetto che rappresenta la risposta del db
    $row=$result->fetch_assoc(); 

    $sql="SELECT idportata from portata where nomeportata='".$_POST["nomeportata"]."'";


    $result=$conn->query($sql);//oggetto che rappresenta la risposta del db
    $conta=$result->num_rows;//utenti con quella mail
    $row2=$result->fetch_assoc(); 

   for($i=1;$i<=$row["massimo"];$i++){
    if(isset($_POST[$i])){
    $sql="INSERT INTO portata_has_ingrediente(ingrediente_idingrediente,portata_idportata) VALUES ('".$_POST[$i]."','".$row2["idportata"]."') ";
    

    $result=$conn->query($sql);//oggetto che rappresenta la risposta del db
}
   
   } 



    //oggetto che rappresenta la risposta del db
    echo "portata archiviata con successo!";
 header("refresh: 3; url=editmenu.php");
  
}
}
else {
    echo "utente non trovato!";
    header("refresh: 3; url=formaccesso.php");
}
}
}