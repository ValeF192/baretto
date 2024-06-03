<?php
$sql="SELECT * FROM categoria   WHERE denominazione='".$_POST["denominazione"]."'";


$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail
if(empty($_POST["denominazione"])){
      echo "non puoi inserire una categoria vuota! <br>";
    header("refresh: 3; url=editmenu.php");
}


else if($conta>0){
    echo "categoria già presente! <br>";
header("refresh: 3; url=editmenu.php");  
}
else{
 

    if(strlen($_POST["denominazione"])>49){
        echo "testo troppo lungo! <br>";
         echo "hai inserito: ".strlen($_POST["denominazione"])." caratteri";
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
 
  $testo=$conn->real_escape_string(stripslashes($_POST["denominazione"]));


  $sql="INSERT INTO categoria(denominazione) VALUES('$testo');";

  if($conn->query($sql)){
    //oggetto che rappresenta la risposta del db
    echo "categoria archiviata con successo!";
 header("refresh: 3; url=editmenu.php");
  
}
}
else {
    echo "utente non trovato!";
    header("refresh: 3; url=formaccesso.php");
}
}
}