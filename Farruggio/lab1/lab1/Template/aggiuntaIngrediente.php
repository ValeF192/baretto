<?php
$sql="SELECT * FROM ingrediente   WHERE denominazione='".$_POST["denominazione"]."'";


$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

if(empty($_POST["denominazione"])){
      echo "non puoi inserire un ingrediente vuoto! <br>";
    header("refresh: 3; url=editmenu.php");
}


  else if($conta>0){
      echo "ingrediente già presente! <br>";
      if(isset($_POST["allergene"])){
        $allergene=$_POST["allergene"];
        
        }
        if(isset($allergene)){
            $allergene=1;
        }
        else{
            $allergene=0;
        }


  $sql="UPDATE ingrediente SET allergene=$allergene where denominazione='".$_POST["denominazione"]."'";

  if($conn->query($sql)){
    //oggetto che rappresenta la risposta del db
    echo "ingrediente modificato con successo!";
 header("refresh: 3; url=editmenu.php");
  
}
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

  if(isset($_POST["allergene"])){
$allergene=$_POST["allergene"];

}
if(isset($allergene)){
    $allergene=1;
}
else{
    $allergene=0;
}

  $sql="INSERT INTO ingrediente(denominazione,allergene) VALUES('$testo','$allergene');";

  if($conn->query($sql)){
    //oggetto che rappresenta la risposta del db
    echo "ingrediente archiviato con successo!";
 header("refresh: 3; url=editmenu.php");
  
}
}
else {
    echo "utente non trovato!";
    header("refresh: 3; url=formaccesso.php");
}
}
}