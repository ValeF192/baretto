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
  


<aside>
    <h1>ingredienti</h1>
        <div class="scrolling-section">

            <?php

    include "Template/connessione.php";
$sql= "SELECT * FROM ingrediente";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

while($row=$result->fetch_assoc()){
    $allergene="";
   if($row ["allergene"]==1){
$allergene="Si";
   }
   else{
    $allergene="No";
   }
    echo $row["denominazione"]."<br> allergene: ".$allergene."<br><br>";


    
    
}


?> </div>







        <div style="margin-top:1%">
            <form method="post" action="addingrediente.php">
                <label style="padding:1%;background-color: #c82f2f" for="ingrediente">Aggiungi nuovi ingredienti:</label>
                <input type="text" name="denominazione" id="denominazione">
                <input type="checkbox" name="allergene" value="si"/>allergene<br/><br/>

                <input type="submit" value="Invia">
                <input type="reset" value="Reset">
            </form>
        </div>



        <h1>portate</h1>


        <div class="scrolling-section">

<?php

include "Template/connessione.php";
$sql= "SELECT * FROM portata";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

while($row=$result->fetch_assoc()){

echo "<br><br><b>".$row["nomeportata"]."</b><br>";

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


?> </div>




        <div class="scrolling-section">

<?php
echo '   <div style="margin-top:1%">
<form method="post" action="addportata.php">
    <label style="padding:1%;background-color: #c82f2f" for="">Aggiungi nuove portate:</label><br><br>
    <label style="padding:1%;background-color: #c82f2f" for="nomeportata">Nome portata:</label>
    <input type="text" name="nomeportata" id="nomeportata"><br><br>
   ';
include "Template/connessione.php";
$sql= "SELECT * FROM ingrediente";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

while($row=$result->fetch_assoc()){
$allergene="";
if($row ["allergene"]==1){
$allergene="Si";
}
else{
$allergene="No";

}

echo '<input type="checkbox" name="'.$row["idingrediente"].'" value="'.$row["idingrediente"].'"/>';
echo $row["denominazione"]."<br> allergene: ".$allergene."<br><br>";





}
echo ' 

<input type="submit" value="Invia">
<input type="reset" value="Reset">
</form>
</div>';

?> </div>

<h1>categorie</h1>
<div class="scrolling-section">

<?php

include "Template/connessione.php";
$sql= "SELECT * FROM categoria";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

while($row=$result->fetch_assoc()){

echo "<br>".$row["denominazione"]."<br>";




}


?> </div>







<div style="margin-top:1%">
<form method="post" action="addcategoria.php">
    <label style="padding:1%;background-color: #c82f2f" for="categoria">Aggiungi nuove categorie:</label>
    <input type="text" name="denominazione" >
  

    <input type="submit" value="Invia">
    <input type="reset" value="Reset">
</form>
</div>

<h1>menu</h1>


<div class="scrolling-section">

<?php

include "Template/connessione.php";

$sql= "SELECT * FROM menu";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$resultm=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$resultm->num_rows;//utenti con quella mail

while($rowm=$resultm->fetch_assoc()){
echo "<br><br><b>Denominazione: ".$rowm["denominazione"]."</b><br>";

$sql= "SELECT * FROM portata inner join menu_has_portata on portata_idportata=portata.idportata where menu_idmenu=".$rowm["idmenu"]." order by categoria_idcategoria";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail
$precategoria="";
while($row=$result->fetch_assoc()){
$idcategoria=$row["categoria_idcategoria"];

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

echo "<br><br><b>-".$row["nomeportata"]."</b> Prezzo: ".$row["prezzo"]."<br>";

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

?> </div>







<div class="scrolling-section">

<?php
echo '   <div style="margin-top:1%">
<form method="post" action="addmenu.php">
    <label style="padding:1%;background-color: #c82f2f" for="">Aggiungi nuovo menu:</label><br><br>
    <label style="padding:1%;background-color: #c82f2f" for="denominazione">Nome menu:</label>
    <input type="text" name="denominazione"><br><br>
   ';
include "Template/connessione.php";
$sql= "SELECT * FROM ingrediente";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail




include "Template/connessione.php";
$sql= "SELECT * FROM portata";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

while($row=$result->fetch_assoc()){
    echo '<br><input type="checkbox" name="'.$row["idportata"].'" value="'.$row["idportata"].'"/>';
echo "<b>".$row["nomeportata"]."</b><br>";

echo '<br>Prezzo: <input type="number"  step="0.01" name="prezzo_'.$row["idportata"].'"/><br>';


echo '<label for="lang">Categoria:</label>
<select name="categoria_'.$row["idportata"].'" id="cat">';
$sqlc= "SELECT * FROM categoria";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$resultc=$conn->query($sqlc);//oggetto che rappresenta la risposta del db


while($rowc=$resultc->fetch_assoc()){

echo '<option value="'.$rowc["idcategoria"].'">'.$rowc["denominazione"].'</option>';




}


echo '</select><br>';

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






echo ' <br>

<input type="submit" value="Invia">
<input type="reset" value="Reset">
</form>
</div>';

?> </div>






<div class="scrolling-section">

<?php
echo '   <div style="margin-top:1%">
<form method="post" action="aggiungiamenu.php">
    <label style="padding:1%;background-color: #c82f2f" for="">aggiungi portata a menu esistenete:</label><br><br>
   <br><br>
   ';
include "Template/connessione.php";
$sql= "SELECT * FROM ingrediente";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail




include "Template/connessione.php";
echo '<label for="lang">Portata:</label>
<select name="portata" id="port">';
$sqlp= "SELECT * FROM portata";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$resultp=$conn->query($sqlp);//oggetto che rappresenta la risposta del db


while($rowp=$resultp->fetch_assoc()){

echo '<option value="'.$rowp["idportata"].'">'.$rowp["nomeportata"].'</option>';




}


echo '</select><br>';
   


echo '<label for="lang">Categoria:</label>
<select name="categoria" id="cat">';
$sqlc= "SELECT * FROM categoria";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$resultc=$conn->query($sqlc);//oggetto che rappresenta la risposta del db


while($rowc=$resultc->fetch_assoc()){

echo '<option value="'.$rowc["idcategoria"].'">'.$rowc["denominazione"].'</option>';




}


echo '</select><br>';


echo '<label for="lang">Menu:</label>
<select name="menu" id="menu">';
$sqlm= "SELECT * FROM menu";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$resultm=$conn->query($sqlm);//oggetto che rappresenta la risposta del db


while($rowm=$resultm->fetch_assoc()){

echo '<option value="'.$rowm["idmenu"].'">'.$rowm["denominazione"].'</option>';




}


echo '</select><br>';


echo '<br>Prezzo: <input type="number"  step="0.01" name="prezzo"/><br>';


















echo ' <br>

<input type="submit" value="Invia">
<input type="reset" value="Reset">
</form>
</div>';

?> </div>





<h1>Attiva Menu</h1>


<div class="scrolling-section">
<div style="margin-top:1%">
            <form method="post" action="attivamenu.php">
                <label style="padding:1%;background-color: #c82f2f" for="ingrediente">Attiva Menu:</label>
                
                
          

                

<?php

include "Template/connessione.php";

$sql= "SELECT * FROM menu";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$resultm=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$resultm->num_rows;//utenti con quella mail

while($rowm=$resultm->fetch_assoc()){

    echo       '<br><br><input type="checkbox" name="'.$rowm["idmenu"].'" value='.$rowm["idmenu"].'"/>';
echo "<b>Denominazione: ".$rowm["denominazione"]."</b><br>";

$sql= "SELECT * FROM portata inner join menu_has_portata on portata_idportata=portata.idportata where menu_idmenu=".$rowm["idmenu"]." order by categoria_idcategoria";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail
$precategoria="";
while($row=$result->fetch_assoc()){
    if(isset($row["categoria_idcategoria"])){
$idcategoria=$row["categoria_idcategoria"];

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

echo "<br><br><b>-".$row["nomeportata"]."</b> Prezzo: ".$row["prezzo"]."<br>";

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
?>
<br><br>
<input type="submit" value="attiva">
</div></div>


<h1>Ordini</h1>


<div class="scrolling-section">

<?php
$totaleOrdine=0;
include "Template/connessione.php";

$sql= "SELECT * FROM ordine inner join utente on utente_codice=utente.codice";//le righe dove la mail è uguale a qiuella inserita dall'utente
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










<h2>
<a href="deletemenu.php">Vuoi eliminare contenuti esistenti?</a></h2>
    <?php 
include "./Template/misura.html";
 ?>



    <?php
include "./Template/footer.html";
?>
</body>

</html>