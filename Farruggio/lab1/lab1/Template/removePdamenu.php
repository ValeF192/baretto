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
        $menu=$_POST["menu"];
$portata=$_POST["portata"];


    $sqlo="SELECT * from ordine_has_portata where menu_idmenu=$menu and portata_idportata=$portata";
    $resulto=$conn->query($sqlo);//oggetto che rappresenta la risposta del db
    $contao=$resulto->num_rows;//utenti con quella mail
        if($contao==0){
        $sql="DELETE from menu_has_portata where menu_idmenu='".$_POST["menu"]."' and portata_idportata='".$_POST["portata"]."'";


        $result=$conn->query($sql);//oggetto che rappresenta la risposta del db

    }
        echo "portata rimossa con successo dal menu!<br>n.b. le portate che sono state ordinate non saranno eliminate!";
        header("refresh: 3; url=deletemenu.php");
    
    }
    else{
        echo "la portata selezionata non appartiene al menu selezionato!";
        header("refresh: 3; url=deletemenu.php");
    }

  }
    
else{
    echo "devi prima creare almeno un menu e associarci almeno una portata da poter eliminare";
    header("refresh: 3; url=deletemenu.php");
}

}
else {
    echo "utente non trovato!";
    header("refresh: 3; url=formaccesso.php");
}