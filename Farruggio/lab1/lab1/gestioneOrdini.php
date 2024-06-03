<!DOCTYPE html>




<?php
session_start();//il client mi sta inviando il cookie di sessione?

if($_SESSION["ruolo"]=="studente"||!isset($_SESSION["email"])){//se la mail non è presente nell'array $session
    header("Location: index.php");//redirect alla registrazione
}


?>




<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ristorante di Farruggio</title>
    <link rel="stylesheet" href="./css/style.css" type="text/css">


</head>

<body style="background-repeat: no-repeat; background-size: 115%;" background="./LSTR_Background_Menu_v2.jpg">

    <?php
include "./Template/intestazione.html";

?>
    <?php
include "./Template/barraLaterale.html";
?>


<h1>Ordini In Arrivo</h1>


<div class="scrolling-section">

<?php
$totaleOrdine=0;
include "Template/connessione.php";

$sql= "SELECT * FROM ordine inner join utente on utente_codice=utente.codice where stato=''";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$resultm=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$resultm->num_rows;//utenti con quella mail

while($rowm=$resultm->fetch_assoc()){
    if($totaleOrdine!=0){
        echo "<br><b>Totale: ".$totaleOrdine."</b>";}

    $totaleOrdine=0;

echo "<br><br><b>ID ordine: ".$rowm["idordine"]."</b><br>"."<b>Nome e Cognome: ".$rowm["nome"]." ".$rowm["cognome"]."</b>"."<br>Email: ".$rowm["email"];

if(isset($rowm["stato"])){
    echo "<br><br>Stato: ".$rowm["stato"];}

$sql= "SELECT * FROM portata inner join ordine_has_portata on portata_idportata=portata.idportata where ordine_idordine=".$rowm["idordine"]." order by categoria_idcategoria";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db





$conta=$result->num_rows;//utenti con quella mail
$precategoria="";
while($row=$result->fetch_assoc()){

    $idmenu=$row["menu_idmenu"];
    $idcategoria=$row["categoria_idcategoria"];

    $idportata=$row["portata_idportata"];

$add1="";
$add2="";
    if(isset($row["categoria_idcategoria"])){
$add1="and  categoria_idcategoria= $idcategoria";
$add2="order by categoria_idcategoria";
    }
    $sql= "SELECT * FROM portata inner join menu_has_portata on portata_idportata=portata.idportata where menu_idmenu= $idmenu $add1 and  portata_idportata= $idportata $add2";//le righe dove la mail è uguale a qiuella inserita dall'utente
    $result2=$conn->query($sql);//oggetto che rappresenta la risposta del db

    $rowpr=$result2->fetch_assoc();



if(isset($row["categoria_idcategoria"]))
{

$sql= "SELECT * FROM categoria where idcategoria=$idcategoria";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$resultc=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$resultc->num_rows;//utenti con quella mail

$rowc=$resultc->fetch_assoc();
//echo $rowc["denominazione"];
if($rowc["denominazione"]!=$precategoria){
echo "<br><br><b>categoria: ".$rowc["denominazione"]."</b><br>";
$precategoria=$rowc["denominazione"];
}
}

echo "<br><br><b>-".$row["nomeportata"];
echo "</b> Quantità: ".$row["quantita"]."<br>";
echo "Prezzo: ".$rowpr["prezzo"]."<br>";

$totaleOrdine+=$rowpr["prezzo"]*$row["quantita"];

$sql= "SELECT ingrediente.denominazione, ingrediente.allergene FROM ingrediente inner join portata_has_ingrediente on idingrediente=ingrediente_idingrediente inner join portata on idportata=portata_idportata where portata.nomeportata='".$row["nomeportata"]."'";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result2=$conn->query($sql);//oggetto che rappresenta la risposta del db


$prima=true;
while($row2=$result2->fetch_assoc()){
   
   if($row2 ["allergene"]==1){


    if(!$prima){
    echo ", ";
  
   }
   else{
    echo "<br>allergeni:<br>";
   }
   $prima=false;
    echo $row2["denominazione"]."";
   }
   
}
echo "<br>";
$sql= "SELECT ingrediente.denominazione, ingrediente.allergene FROM ingrediente inner join portata_has_ingrediente on idingrediente=ingrediente_idingrediente inner join portata on idportata=portata_idportata where portata.nomeportata='".$row["nomeportata"]."'";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result2=$conn->query($sql);//oggetto che rappresenta la risposta del db


$prima=true;
while($row2=$result2->fetch_assoc()){
   
   if($row2 ["allergene"]==0){
    if(!$prima){
        echo ",";
       
       }
       else{
        echo "ingredienti:<br>";
       }
       $prima=false;
    echo $row2["denominazione"];
   }
   
}


}
}
if($totaleOrdine!=0){
    echo "<br><b>Totale: ".$totaleOrdine."</b>";}
?> </div>





<h1>Accetta Ordini</h1>


<div class="scrolling-section">

<?php
$totaleOrdine=0;
include "Template/connessione.php";

$sql= "SELECT * FROM ordine inner join utente on utente_codice=utente.codice where stato=''";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$resultm=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$resultm->num_rows;//utenti con quella mail

while($rowm=$resultm->fetch_assoc()){
    if($totaleOrdine!=0){
        echo "<br><b>Totale: ".$totaleOrdine."</b>";}

    $totaleOrdine=0;

echo "<br><br><b>ID ordine: ".$rowm["idordine"]."</b><br>"."<b>Nome e Cognome: ".$rowm["nome"]." ".$rowm["cognome"]."</b>"."<br>Email: ".$rowm["email"];

if(isset($rowm["stato"])){
    echo "<br><br>Stato: ".$rowm["stato"];}

$sql= "SELECT * FROM portata inner join ordine_has_portata on portata_idportata=portata.idportata where ordine_idordine=".$rowm["idordine"]." order by categoria_idcategoria";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db





$conta=$result->num_rows;//utenti con quella mail
$precategoria="";
while($row=$result->fetch_assoc()){

    $idmenu=$row["menu_idmenu"];
    $idcategoria=$row["categoria_idcategoria"];

    $idportata=$row["portata_idportata"];

$add1="";
$add2="";
    if(isset($row["categoria_idcategoria"])){
$add1="and  categoria_idcategoria= $idcategoria";
$add2="order by categoria_idcategoria";
    }
    $sql= "SELECT * FROM portata inner join menu_has_portata on portata_idportata=portata.idportata where menu_idmenu= $idmenu $add1 and  portata_idportata= $idportata $add2";//le righe dove la mail è uguale a qiuella inserita dall'utente
    $result2=$conn->query($sql);//oggetto che rappresenta la risposta del db

    $rowpr=$result2->fetch_assoc();



if(isset($row["categoria_idcategoria"]))
{

$sql= "SELECT * FROM categoria where idcategoria=$idcategoria";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$resultc=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$resultc->num_rows;//utenti con quella mail

$rowc=$resultc->fetch_assoc();
//echo $rowc["denominazione"];
if($rowc["denominazione"]!=$precategoria){
echo "<br><br><b>categoria: ".$rowc["denominazione"]."</b><br>";
$precategoria=$rowc["denominazione"];
}
}

echo "<br><br><b>-".$row["nomeportata"]."</b> Quantità: ".$row["quantita"]."<br>"."Prezzo: ".$rowpr["prezzo"]."<br>";

$totaleOrdine+=$rowpr["prezzo"]*$row["quantita"];

$sql= "SELECT ingrediente.denominazione, ingrediente.allergene FROM ingrediente inner join portata_has_ingrediente on idingrediente=ingrediente_idingrediente inner join portata on idportata=portata_idportata where portata.nomeportata='".$row["nomeportata"]."'";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result2=$conn->query($sql);//oggetto che rappresenta la risposta del db


$prima=true;
while($row2=$result2->fetch_assoc()){
   
   if($row2 ["allergene"]==1){


    if(!$prima){
    echo ", ";
  
   }
   else{
    echo "<br>allergeni:<br>";
   }
   $prima=false;
    echo $row2["denominazione"]."";
   }
   
}
echo "<br>";
$sql= "SELECT ingrediente.denominazione, ingrediente.allergene FROM ingrediente inner join portata_has_ingrediente on idingrediente=ingrediente_idingrediente inner join portata on idportata=portata_idportata where portata.nomeportata='".$row["nomeportata"]."'";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result2=$conn->query($sql);//oggetto che rappresenta la risposta del db


$prima=true;
while($row2=$result2->fetch_assoc()){
   
   if($row2 ["allergene"]==0){
    if(!$prima){
        echo ",";
       
       }
       else{
        echo "ingredienti:<br>";
       }
       $prima=false;
    echo $row2["denominazione"];
   }
   
}


}
}
if($totaleOrdine!=0){
    echo "<br><b>Totale: ".$totaleOrdine."</b>";}
?> </div>
<div class="scrolling-section">
<form method="post" action="accettaordine.php">
                <label style="padding:1%;background-color: #c82f2f" for="ingrediente">Accetta Ordine:</label>
<?php
$totaleOrdine=0;
include "Template/connessione.php";

$sql= "SELECT * FROM ordine inner join utente on utente_codice=utente.codice where stato=''";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$resultm=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$resultm->num_rows;//utenti con quella mail

while($rowm=$resultm->fetch_assoc()){

    if($totaleOrdine!=0){
        echo "<br><b>Totale: ".$totaleOrdine."</b>";}

    $totaleOrdine=0;


    echo       '<br><br><input type="checkbox" name="'.$rowm["idordine"].'" value='.$rowm["idordine"].'"/>';
echo "<b>ID ordine: ".$rowm["idordine"]."</b><br>"."<b>Nome e Cognome: ".$rowm["nome"]." ".$rowm["cognome"]."</b>"."<br>Email: ".$rowm["email"];

if(isset($rowm["stato"])){
    echo "<br><br>Stato: ".$rowm["stato"];}

$sql= "SELECT * FROM portata inner join ordine_has_portata on portata_idportata=portata.idportata where ordine_idordine=".$rowm["idordine"]." order by categoria_idcategoria";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db





$conta=$result->num_rows;//utenti con quella mail
$precategoria="";
while($row=$result->fetch_assoc()){

    $idmenu=$row["menu_idmenu"];
    $idcategoria=$row["categoria_idcategoria"];

    $idportata=$row["portata_idportata"];

$add1="";
$add2="";
    if(isset($row["categoria_idcategoria"])){
$add1="and  categoria_idcategoria= $idcategoria";
$add2="order by categoria_idcategoria";
    }
    $sql= "SELECT * FROM portata inner join menu_has_portata on portata_idportata=portata.idportata where menu_idmenu= $idmenu $add1 and  portata_idportata= $idportata $add2";//le righe dove la mail è uguale a qiuella inserita dall'utente
    $result2=$conn->query($sql);//oggetto che rappresenta la risposta del db

    $rowpr=$result2->fetch_assoc();



if(isset($row["categoria_idcategoria"]))
{

$sql= "SELECT * FROM categoria where idcategoria=$idcategoria";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$resultc=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$resultc->num_rows;//utenti con quella mail

$rowc=$resultc->fetch_assoc();
//echo $rowc["denominazione"];
if($rowc["denominazione"]!=$precategoria){
echo "<br><br><b>categoria: ".$rowc["denominazione"]."</b><br>";
$precategoria=$rowc["denominazione"];
}
}

echo "<br><br><b>-".$row["nomeportata"]."</b> Quantità: ".$row["quantita"]."<br>"."Prezzo: ".$rowpr["prezzo"]."<br>";

$totaleOrdine+=$rowpr["prezzo"]*$row["quantita"];

$sql= "SELECT ingrediente.denominazione, ingrediente.allergene FROM ingrediente inner join portata_has_ingrediente on idingrediente=ingrediente_idingrediente inner join portata on idportata=portata_idportata where portata.nomeportata='".$row["nomeportata"]."'";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result2=$conn->query($sql);//oggetto che rappresenta la risposta del db


$prima=true;
while($row2=$result2->fetch_assoc()){
   
   if($row2 ["allergene"]==1){


    if(!$prima){
    echo ", ";
  
   }
   else{
    echo "<br>allergeni:<br>";
   }
   $prima=false;
    echo $row2["denominazione"]."";
   }
   
}
echo "<br>";
$sql= "SELECT ingrediente.denominazione, ingrediente.allergene FROM ingrediente inner join portata_has_ingrediente on idingrediente=ingrediente_idingrediente inner join portata on idportata=portata_idportata where portata.nomeportata='".$row["nomeportata"]."'";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result2=$conn->query($sql);//oggetto che rappresenta la risposta del db


$prima=true;
while($row2=$result2->fetch_assoc()){
   
   if($row2 ["allergene"]==0){
    if(!$prima){
        echo ",";
       
       }
       else{
        echo "ingredienti:<br>";
       }
       $prima=false;
    echo $row2["denominazione"];
   }
   
}


}
}
if($totaleOrdine!=0){
    echo "<br><b>Totale: ".$totaleOrdine."</b>";}
?> <br><br>
<input type="submit" value="Accetta ordini">
</form>

</div>

<h1>Segnala Ordini come Pronti </h1>


<div class="scrolling-section">

<?php
$totaleOrdine=0;
include "Template/connessione.php";

$sql= "SELECT * FROM ordine inner join utente on utente_codice=utente.codice where stato='ACCETTATO'";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$resultm=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$resultm->num_rows;//utenti con quella mail

while($rowm=$resultm->fetch_assoc()){
    if($totaleOrdine!=0){
        echo "<br><b>Totale: ".$totaleOrdine."</b>";}

    $totaleOrdine=0;

echo "<br><br><b>ID ordine: ".$rowm["idordine"]."</b><br>"."<b>Nome e Cognome: ".$rowm["nome"]." ".$rowm["cognome"]."</b>"."<br>Email: ".$rowm["email"];

if(isset($rowm["stato"])){
    echo "<br><br>Stato: ".$rowm["stato"];}

$sql= "SELECT * FROM portata inner join ordine_has_portata on portata_idportata=portata.idportata where ordine_idordine=".$rowm["idordine"]." order by categoria_idcategoria";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db





$conta=$result->num_rows;//utenti con quella mail
$precategoria="";
while($row=$result->fetch_assoc()){

    $idmenu=$row["menu_idmenu"];
    $idcategoria=$row["categoria_idcategoria"];

    $idportata=$row["portata_idportata"];

$add1="";
$add2="";
    if(isset($row["categoria_idcategoria"])){
$add1="and  categoria_idcategoria= $idcategoria";
$add2="order by categoria_idcategoria";
    }
    $sql= "SELECT * FROM portata inner join menu_has_portata on portata_idportata=portata.idportata where menu_idmenu= $idmenu $add1 and  portata_idportata= $idportata $add2";//le righe dove la mail è uguale a qiuella inserita dall'utente
    $result2=$conn->query($sql);//oggetto che rappresenta la risposta del db

    $rowpr=$result2->fetch_assoc();



if(isset($row["categoria_idcategoria"]))
{

$sql= "SELECT * FROM categoria where idcategoria=$idcategoria";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$resultc=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$resultc->num_rows;//utenti con quella mail

$rowc=$resultc->fetch_assoc();
//echo $rowc["denominazione"];
if($rowc["denominazione"]!=$precategoria){
echo "<br><br><b>categoria: ".$rowc["denominazione"]."</b><br>";
$precategoria=$rowc["denominazione"];
}
}

echo "<br><br><b>-".$row["nomeportata"]."</b> Quantità: ".$row["quantita"]."<br>"."Prezzo: ".$rowpr["prezzo"]."<br>";

$totaleOrdine+=$rowpr["prezzo"]*$row["quantita"];

$sql= "SELECT ingrediente.denominazione, ingrediente.allergene FROM ingrediente inner join portata_has_ingrediente on idingrediente=ingrediente_idingrediente inner join portata on idportata=portata_idportata where portata.nomeportata='".$row["nomeportata"]."'";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result2=$conn->query($sql);//oggetto che rappresenta la risposta del db


$prima=true;
while($row2=$result2->fetch_assoc()){
   
   if($row2 ["allergene"]==1){


    if(!$prima){
    echo ", ";
  
   }
   else{
    echo "<br>allergeni:<br>";
   }
   $prima=false;
    echo $row2["denominazione"]."";
   }
   
}
echo "<br>";
$sql= "SELECT ingrediente.denominazione, ingrediente.allergene FROM ingrediente inner join portata_has_ingrediente on idingrediente=ingrediente_idingrediente inner join portata on idportata=portata_idportata where portata.nomeportata='".$row["nomeportata"]."'";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result2=$conn->query($sql);//oggetto che rappresenta la risposta del db


$prima=true;
while($row2=$result2->fetch_assoc()){
   
   if($row2 ["allergene"]==0){
    if(!$prima){
        echo ",";
       
       }
       else{
        echo "ingredienti:<br>";
       }
       $prima=false;
    echo $row2["denominazione"];
   }
   
}


}
}
if($totaleOrdine!=0){
    echo "<br><b>Totale: ".$totaleOrdine."</b>";}
?> </div>
<div class="scrolling-section">
<form method="post" action="ordinepronto.php">
                <label style="padding:1%;background-color: #c82f2f" for="ingrediente">Segnala ordine come pronto:</label>
<?php
$totaleOrdine=0;
include "Template/connessione.php";

$sql= "SELECT * FROM ordine inner join utente on utente_codice=utente.codice where stato='ACCETTATO'";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$resultm=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$resultm->num_rows;//utenti con quella mail

while($rowm=$resultm->fetch_assoc()){

    if($totaleOrdine!=0){
        echo "<br><b>Totale: ".$totaleOrdine."</b>";}

    $totaleOrdine=0;


    echo       '<br><br><input type="checkbox" name="'.$rowm["idordine"].'" value='.$rowm["idordine"].'"/>';
echo "<b>ID ordine: ".$rowm["idordine"]."</b><br>"."<b>Nome e Cognome: ".$rowm["nome"]." ".$rowm["cognome"]."</b>"."<br>Email: ".$rowm["email"];

if(isset($rowm["stato"])){
    echo "<br><br>Stato: ".$rowm["stato"];}

$sql= "SELECT * FROM portata inner join ordine_has_portata on portata_idportata=portata.idportata where ordine_idordine=".$rowm["idordine"]." order by categoria_idcategoria";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db





$conta=$result->num_rows;//utenti con quella mail
$precategoria="";
while($row=$result->fetch_assoc()){

    $idmenu=$row["menu_idmenu"];
    $idcategoria=$row["categoria_idcategoria"];

    $idportata=$row["portata_idportata"];

$add1="";
$add2="";
    if(isset($row["categoria_idcategoria"])){
$add1="and  categoria_idcategoria= $idcategoria";
$add2="order by categoria_idcategoria";
    }
    $sql= "SELECT * FROM portata inner join menu_has_portata on portata_idportata=portata.idportata where menu_idmenu= $idmenu $add1 and  portata_idportata= $idportata $add2";//le righe dove la mail è uguale a qiuella inserita dall'utente
    $result2=$conn->query($sql);//oggetto che rappresenta la risposta del db

    $rowpr=$result2->fetch_assoc();



if(isset($row["categoria_idcategoria"]))
{

$sql= "SELECT * FROM categoria where idcategoria=$idcategoria";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$resultc=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$resultc->num_rows;//utenti con quella mail

$rowc=$resultc->fetch_assoc();
//echo $rowc["denominazione"];
if($rowc["denominazione"]!=$precategoria){
echo "<br><br><b>categoria: ".$rowc["denominazione"]."</b><br>";
$precategoria=$rowc["denominazione"];
}
}

echo "<br><br><b>-".$row["nomeportata"]."</b> Quantità: ".$row["quantita"]."<br>"."Prezzo: ".$rowpr["prezzo"]."<br>";

$totaleOrdine+=$rowpr["prezzo"]*$row["quantita"];

$sql= "SELECT ingrediente.denominazione, ingrediente.allergene FROM ingrediente inner join portata_has_ingrediente on idingrediente=ingrediente_idingrediente inner join portata on idportata=portata_idportata where portata.nomeportata='".$row["nomeportata"]."'";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result2=$conn->query($sql);//oggetto che rappresenta la risposta del db


$prima=true;
while($row2=$result2->fetch_assoc()){
   
   if($row2 ["allergene"]==1){


    if(!$prima){
    echo ", ";
  
   }
   else{
    echo "<br>allergeni:<br>";
   }
   $prima=false;
    echo $row2["denominazione"]."";
   }
   
}
echo "<br>";
$sql= "SELECT ingrediente.denominazione, ingrediente.allergene FROM ingrediente inner join portata_has_ingrediente on idingrediente=ingrediente_idingrediente inner join portata on idportata=portata_idportata where portata.nomeportata='".$row["nomeportata"]."'";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result2=$conn->query($sql);//oggetto che rappresenta la risposta del db


$prima=true;
while($row2=$result2->fetch_assoc()){
   
   if($row2 ["allergene"]==0){
    if(!$prima){
        echo ",";
       
       }
       else{
        echo "ingredienti:<br>";
       }
       $prima=false;
    echo $row2["denominazione"];
   }
   
}


}
}
if($totaleOrdine!=0){
    echo "<br><b>Totale: ".$totaleOrdine."</b>";}
?> <br><br>
<input type="submit" value="Segnala come pronti">
</form>

</div>

<h1>Elimina Ordini</h1>


<div class="scrolling-section">
<form method="post" action="delordine.php">
                <label style="padding:1%;background-color: #c82f2f" for="ingrediente">Rimuovi Ordine:</label>
<?php
$totaleOrdine=0;
include "Template/connessione.php";

$sql= "SELECT * FROM ordine inner join utente on utente_codice=utente.codice order by stato";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$resultm=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$resultm->num_rows;//utenti con quella mail

while($rowm=$resultm->fetch_assoc()){

    if($totaleOrdine!=0){
        echo "<br><b>Totale: ".$totaleOrdine."</b>";}

    $totaleOrdine=0;


    echo       '<br><br><input type="checkbox" name="'.$rowm["idordine"].'" value='.$rowm["idordine"].'"/>';
echo "<b>ID ordine: ".$rowm["idordine"]."</b><br>"."<b>Nome e Cognome: ".$rowm["nome"]." ".$rowm["cognome"]."</b>"."<br>Email: ".$rowm["email"];

if(isset($rowm["stato"])){
    echo "<br><br>Stato: ".$rowm["stato"];}

$sql= "SELECT * FROM portata inner join ordine_has_portata on portata_idportata=portata.idportata where ordine_idordine=".$rowm["idordine"]." order by categoria_idcategoria";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db





$conta=$result->num_rows;//utenti con quella mail
$precategoria="";
while($row=$result->fetch_assoc()){

    $idmenu=$row["menu_idmenu"];
    $idcategoria=$row["categoria_idcategoria"];

    $idportata=$row["portata_idportata"];

$add1="";
$add2="";
    if(isset($row["categoria_idcategoria"])){
$add1="and  categoria_idcategoria= $idcategoria";
$add2="order by categoria_idcategoria";
    }
    $sql= "SELECT * FROM portata inner join menu_has_portata on portata_idportata=portata.idportata where menu_idmenu= $idmenu $add1 and  portata_idportata= $idportata $add2";//le righe dove la mail è uguale a qiuella inserita dall'utente
    $result2=$conn->query($sql);//oggetto che rappresenta la risposta del db

    $rowpr=$result2->fetch_assoc();



if(isset($row["categoria_idcategoria"]))
{

$sql= "SELECT * FROM categoria where idcategoria=$idcategoria";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$resultc=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$resultc->num_rows;//utenti con quella mail

$rowc=$resultc->fetch_assoc();
//echo $rowc["denominazione"];
if($rowc["denominazione"]!=$precategoria){
echo "<br><br><b>categoria: ".$rowc["denominazione"]."</b><br>";
$precategoria=$rowc["denominazione"];
}
}

echo "<br><br><b>-".$row["nomeportata"]."</b> Quantità: ".$row["quantita"]."<br>"."Prezzo: ".$rowpr["prezzo"]."<br>";

$totaleOrdine+=$rowpr["prezzo"]*$row["quantita"];

$sql= "SELECT ingrediente.denominazione, ingrediente.allergene FROM ingrediente inner join portata_has_ingrediente on idingrediente=ingrediente_idingrediente inner join portata on idportata=portata_idportata where portata.nomeportata='".$row["nomeportata"]."'";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result2=$conn->query($sql);//oggetto che rappresenta la risposta del db


$prima=true;
while($row2=$result2->fetch_assoc()){
   
   if($row2 ["allergene"]==1){


    if(!$prima){
    echo ", ";
  
   }
   else{
    echo "<br>allergeni:<br>";
   }
   $prima=false;
    echo $row2["denominazione"]."";
   }
   
}
echo "<br>";
$sql= "SELECT ingrediente.denominazione, ingrediente.allergene FROM ingrediente inner join portata_has_ingrediente on idingrediente=ingrediente_idingrediente inner join portata on idportata=portata_idportata where portata.nomeportata='".$row["nomeportata"]."'";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result2=$conn->query($sql);//oggetto che rappresenta la risposta del db


$prima=true;
while($row2=$result2->fetch_assoc()){
   
   if($row2 ["allergene"]==0){
    if(!$prima){
        echo ",";
       
       }
       else{
        echo "ingredienti:<br>";
       }
       $prima=false;
    echo $row2["denominazione"];
   }
   
}


}
}
if($totaleOrdine!=0){
    echo "<br><b>Totale: ".$totaleOrdine."</b>";}
?> <br><br>
<input type="submit" value="Elimina ordine">
</form>

</div>



    <?php 
include "./Template/misura.html";
 ?>



    <?php
include "./Template/footer.html";
?>
</body>

</html>