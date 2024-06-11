<?php

$sql="SELECT * FROM menu   WHERE denominazione='".$_POST["denominazione"]."'";


$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

if(empty($_POST["denominazione"])){
      echo "non puoi inserire un menu senza nome! <br>";
    header("refresh: 3; url=editmenu.php");
}

  else if($conta>0){
      echo "menu già presente! <br>";
      $sql="SELECT max(idportata) as massimo FROM portata";


      $result=$conn->query($sql);//oggetto che rappresenta la risposta del db
      $row=$result->fetch_assoc(); 
  
      $sql="SELECT idmenu from menu where denominazione='".$_POST["denominazione"]."'";
  
  
      $result=$conn->query($sql);//oggetto che rappresenta la risposta del db
      $conta=$result->num_rows;//utenti con quella mail
      $row2=$result->fetch_assoc(); 
      $sql="DELETE FROM  menu_has_portata where menu_idmenu= '".$row2["idmenu"]."'";
      //echo $sql;
  
      $result=$conn->query($sql);//oggetto che rappresenta la risposta del db
  
     for($i=1;$i<=$row["massimo"];$i++){
     
  
        
      
  
     
  

   if(isset($_POST[$i])&&isset($_POST["prezzo_".$i])
  ){
    
    $sqlc="SELECT * FROM  menu_has_portata where menu_idmenu= '".$row2["idmenu"]."' and portata_idportata= '".$_POST[$i]."'";
  
  
    $resultc=$conn->query($sqlc);//oggetto che rappresenta la risposta del db
    $conta=$resultc->num_rows;//utenti con quella mail
    if($conta==0){
$sql="";
     if(! isset($_POST["categoria_".$i])){

      $sql="INSERT INTO menu_has_portata(menu_idmenu,portata_idportata,prezzo) VALUES ('".$row2["idmenu"]."','".$_POST[$i]."','".$_POST["prezzo_".$i]."') ";
   
     }
     else{
      $sql="INSERT INTO menu_has_portata(menu_idmenu,portata_idportata,prezzo,categoria_idcategoria) VALUES ('".$row2["idmenu"]."','".$_POST[$i]."','".$_POST["prezzo_".$i]."','".$_POST["categoria_".$i]."') ";
    }
     // echo $sql;
  
      $result=$conn->query($sql);//oggetto che rappresenta la risposta del db
    }
  }
     
     } 
  
  
  
      //oggetto che rappresenta la risposta del db
      echo "menu modificato con successo!";
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

  
/*$allergene=$_POST["allergene"];
if(isset($allergene)){
    $allergene=1;
}
else{
    $allergene=0;
}*/

  $sql="INSERT INTO menu(denominazione,stato) VALUES('$testo','')";
  
  if($conn->query($sql)){

    $sql="SELECT max(idportata) as massimo FROM portata";


    $result=$conn->query($sql);//oggetto che rappresenta la risposta del db
    $row=$result->fetch_assoc(); 

    $sql="SELECT idmenu from menu where denominazione='".$_POST["denominazione"]."'";


    $result=$conn->query($sql);//oggetto che rappresenta la risposta del db
    $conta=$result->num_rows;//utenti con quella mail
    $row2=$result->fetch_assoc(); 

   for($i=1;$i<=$row["massimo"];$i++){
    if(isset($_POST[$i])&&isset($_POST["prezzo_".$i])
    ){

      $sql="";
      if(! isset($_POST["categoria_".$i])){

        $sql="INSERT INTO menu_has_portata(menu_idmenu,portata_idportata,prezzo) VALUES ('".$row2["idmenu"]."','".$_POST[$i]."','".$_POST["prezzo_".$i]."') ";
   
       }

       else{

       
    $sql="INSERT INTO menu_has_portata(menu_idmenu,portata_idportata,prezzo,categoria_idcategoria) VALUES ('".$row2["idmenu"]."','".$_POST[$i]."','".$_POST["prezzo_".$i]."','".$_POST["categoria_".$i]."') ";
         }

    $result=$conn->query($sql);//oggetto che rappresenta la risposta del db
}
   
   } 



    //oggetto che rappresenta la risposta del db
    echo "menu archiviato con successo!";
 header("refresh: 3; url=editmenu.php");
  
}
}
else {
    echo "utente non trovato!";
    header("refresh: 3; url=formaccesso.php");
}
}
}