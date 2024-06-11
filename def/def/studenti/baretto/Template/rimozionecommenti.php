<?php

$sql="SELECT max(ID) as massimo FROM commento ";

//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

$row=$result->fetch_assoc(); 

$massimo= $row["massimo"];



session_start();//inizializza il cookie di sessione, la sessione inizia
       
$emailCorrente=$_SESSION["email"];

$sql="SELECT * FROM utente  inner join ruolo using (idruolo) WHERE email='$emailCorrente'";


$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail
$row=$result->fetch_assoc(); 
$buonoEsito=true;
if($conta==1&&$row["denominazione"]!="studente"){


for($i=1;$i<=$massimo;$i++){
  // echo $i;

   
if(isset($_POST[$i])){
   
$sql="DELETE FROM commento   WHERE ID='".$_POST[$i]."'";
//cho $sql;

if($result=$conn->query($sql)){
    $buonoEsito=true;
}//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

//echo $conta;

 

}


}
if($buonoEsito){
echo "commenti eliminati!";
header("refresh: 3; url=deletemenu.php");
}
}

else {
    echo "utente non trovato!";
    header("refresh: 3; url=formaccesso.php");
}
