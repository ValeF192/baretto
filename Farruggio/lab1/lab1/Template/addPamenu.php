<?php



session_start();//inizializza il cookie di sessione, la sessione inizia
       
$emailCorrente=$_SESSION["email"];

$sql="SELECT * FROM utente  inner join ruolo using (idruolo) WHERE email='$emailCorrente'";


$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail
$row=$result->fetch_assoc(); 

if($conta==1&&$row["denominazione"]!="studente"){
 
  
/*$allergene=$_POST["allergene"];
if(isset($allergene)){
    $allergene=1;
}
else{
    $allergene=0;
}*/

  

  if(isset($_POST["menu"])&&isset($_POST["portata"])){

    $sql="SELECT * from menu_has_portata where menu_idmenu='".$_POST["menu"]."' and portata_idportata='".$_POST["portata"]."'";


    $result=$conn->query($sql);//oggetto che rappresenta la risposta del db
    $conta=$result->num_rows;//utenti con quella mail
    if ($conta>0){
        $sql="DELETE from menu_has_portata where menu_idmenu='".$_POST["menu"]."' and portata_idportata='".$_POST["portata"]."'";


        $result=$conn->query($sql);//oggetto che rappresenta la risposta del db
    }


    if(isset($_POST["prezzo"])
    ){

      $sql="";
      if(! isset($_POST["categoria"])){

        $sql="INSERT INTO menu_has_portata(menu_idmenu,portata_idportata,prezzo) VALUES ('".$_POST["menu"]."','".$_POST["portata"]."','".$_POST["prezzo"]."') ";
   
       }

       else{

       
    $sql="INSERT INTO menu_has_portata(menu_idmenu,portata_idportata,prezzo,categoria_idcategoria) VALUES ('".$_POST["menu"]."','".$_POST["portata"]."','".$_POST["prezzo"]."','".$_POST["categoria"]."') ";
         }

    $result=$conn->query($sql);//oggetto che rappresenta la risposta del db
}
   
   



    //oggetto che rappresenta la risposta del db
    echo "portata associata al menu con successo!";
 header("refresh: 3; url=editmenu.php");
}
else{
    echo "devi prima creare almeno un menu e una portata da poterci associare";
    header("refresh: 3; url=editmenu.php");
}

}
else {
    echo "utente non trovato!";
    header("refresh: 3; url=formaccesso.php");
}