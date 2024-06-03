<?php
$sql="SELECT max(idcategoria) as massimo FROM categoria ";


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
   
$sql="SELECT * FROM categoria  inner join menu_has_portata  WHERE categoria_idcategoria='".$_POST[$i]."'";
///echo $sql;

$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

//echo $conta;

 if($conta==0){

    
  $sql="DELETE FROM categoria where idcategoria=$i";
  //echo $sql;
  
  
  
      //oggetto che rappresenta la risposta del db
     if(!$conn->query($sql)){



        $buonoEsito=false;
     }
        
        //oggetto che rappresenta la risposta del db
   
}
else{
 

    $buonoEsito=false;

 
    echo "categoria presente già nei menu, modificali per poterla rimuovere! <br>";
    header("refresh: 3; url=editmenu.php");  


  

}

}


}
if($buonoEsito){
echo "categorie eliminate!";
header("refresh: 3; url=deletemenu.php");
}
}

else {
    echo "utente non trovato!";
    header("refresh: 3; url=formaccesso.php");
}
