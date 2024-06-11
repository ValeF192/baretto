<?php




$sql="SELECT max(idmenu) as massimo FROM menu ";


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
   $sqlo="SELECT * from ordine_has_portata where menu_idmenu=$i";
   $resulto=$conn->query($sqlo);//oggetto che rappresenta la risposta del db
   $contao=$resulto->num_rows;//utenti con quella mail
   
   if($contao==0){
//$sql="SELECT * FROM portata  inner join menu_has_portata  WHERE portata_idportata='".$_POST[$i]."'";
///echo $sql;

//$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
//$conta=$result->num_rows;//utenti con quella mail

//echo $conta;
$conta=0;
 if($conta==0){
$sql="DELETE FROM menu_has_portata where menu_idmenu=$i";
  //echo $sql;
  
  
  
      //oggetto che rappresenta la risposta del db
     if(!$conn->query($sql)){



        $buonoEsito=false;
     }
    
  $sql="DELETE FROM menu where idmenu=$i";
  //echo $sql;
  
  
  
      //oggetto che rappresenta la risposta del db
     if(!$conn->query($sql)){



        $buonoEsito=false;
     }
        
        //oggetto che rappresenta la risposta del db
   
}
else{
 

    $buonoEsito=false;

 
  //  echo "portata presente già nei menu, modificali per poterla rimuovere! <br>";
  //  header("refresh: 3; url=editmenu.php");  


  

}
}

}


}
if($buonoEsito){
echo "menu eliminati!<br> attenzione, i menu su cui sono presenti ordini non saranno eliminati!";
header("refresh: 3; url=deletemenu.php");
}
}

else {
    echo "utente non trovato!";
    header("refresh: 3; url=formaccesso.php");
}
