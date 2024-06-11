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
$numcaselle=0;
    for($i=1;$i<=$massimo;$i++){
        // echo $i;
     
        
     if(isset($_POST[$i])){
$numcaselle++;

     }}
     if($numcaselle<2){
         
   $sql="UPDATE menu SET stato='DISATTIVATO'";
   //echo $sql;
   
   
   
       //oggetto che rappresenta la risposta del db
      $conn->query($sql);

for($i=1;$i<=$massimo;$i++){
   // echo $i;

   
if(isset($_POST[$i])){
   
//$sql="SELECT * FROM portata  inner join menu_has_portata  WHERE portata_idportata='".$_POST[$i]."'";
///echo $sql;

//$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
//$conta=$result->num_rows;//utenti con quella mail

//echo $conta;
$conta=0;

//$sql="DELETE FROM menu_has_portata where menu_idmenu=$i";
  //echo $sql;
  
  
  
      //oggetto che rappresenta la risposta del db
    // if(!$conn->query($sql)){



      //  $buonoEsito=false;
   //  }
   

  $sql="UPDATE menu SET stato='ATTIVO' where idmenu=$i";
  //echo $sql;
  
  
  
      //oggetto che rappresenta la risposta del db
     if($conn->query($sql)){



        $buonoEsito=true;
     }
        
        //oggetto che rappresenta la risposta del db
   


}


}
if($buonoEsito){
echo "menu attivato!";
header("refresh: 3; url=editmenu.php");
}
}
else{

    echo "solo un menu puo essere attivo!";
    header("refresh: 3; url=editmenu.php");

}




}
else {
    echo "utente non trovato!";
    header("refresh: 3; url=formaccesso.php");
}
