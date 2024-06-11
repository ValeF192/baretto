<?php
$sql="SELECT max(idingrediente) as massimo FROM ingrediente ";


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
   
$sql="SELECT * FROM portata_has_ingrediente   WHERE ingrediente_idingrediente='".$_POST[$i]."'";
///echo $sql;

$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

//echo $conta;

 if($conta==0){

    
  $sql="DELETE FROM ingrediente where idingrediente=$i";
  //echo $sql;
  
  
  
      //oggetto che rappresenta la risposta del db
     if(!$conn->query($sql)){



        $buonoEsito=false;
     }
        
        //oggetto che rappresenta la risposta del db
   
}
else{
 

    
    $buonoEsito=false;
 
    echo "ingrediente presente già nelle portate, modificale per poterlo rimuovere! <br>";
    header("refresh: 3; url=editmenu.php");  


  

}

}


}
if($buonoEsito){
echo "ingredienti eliminati!";
header("refresh: 3; url=deletemenu.php");
}
}

else {
    echo "utente non trovato!";
    header("refresh: 3; url=formaccesso.php");
}
