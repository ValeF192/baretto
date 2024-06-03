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


        



        <div style="margin-top:1%">
            <form method="post" action="deleteingrediente.php">
                <label style="padding:1%;background-color: #c82f2f" for="ingrediente">Rimuovi ingredienti:</label><br><br>
              
         

          

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

   echo '  <input type="checkbox" name="'.$row ["idingrediente"].'" value="'.$row ["idingrediente"].'"/>';
    echo $row["denominazione"]."<br> allergene: ".$allergene."<br><br>";


    
    
}


?>      <input type="submit" value="Elimina">
<input type="reset" value="Reset">
</form>
</div> </div>






        <h1>portate</h1>


        <div class="scrolling-section">
        <div style="margin-top:1%">
            <form method="post" action="deleteportata.php">
                <label style="padding:1%;background-color: #c82f2f" for="ingrediente">Rimuovi portata:</label><br><br>
              
              

            

<?php

include "Template/connessione.php";
$sql= "SELECT * FROM portata";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

while($row=$result->fetch_assoc()){

echo "<br><br><b>";

echo  '<input type="checkbox" name="'.$row["idportata"].'" value="'.$row["idportata"].'"/>';
echo $row["nomeportata"]."</b><br>";

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


?>
    <br><br><input type="submit" value="Elimina">
                <input type="reset" value="Reset">
            </form>
        </div>

</div>




   

<h1>categorie</h1>
<div class="scrolling-section">
<div style="margin-top:1%">
            <form method="post" action="deletecategoria.php">
                <label style="padding:1%;background-color: #c82f2f" for="ingrediente">Rimuovi categoria:</label><br>
               

               

<?php

include "Template/connessione.php";
$sql= "SELECT * FROM categoria";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

while($row=$result->fetch_assoc()){
   echo "<br>".' <input type="checkbox" name="'.$row["idcategoria"].'" value="'.$row["idcategoria"].'"/>';

echo  $row["denominazione"]."<br>";




}


?> 


<br><input type="submit" value="Elimina">
                <input type="reset" value="Reset">
            </form>
        </div>
</div>









<h1>menu</h1>


<div class="scrolling-section">
<div style="margin-top:1%">
            <form method="post" action="delmenu.php">
                <label style="padding:1%;background-color: #c82f2f" for="ingrediente">Rimuovi Menu:</label>
                
                
          


                
                

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






<br><br><input type="submit" value="Elimina">
                <input type="reset" value="Reset">
            </form>
        </div>
</div>
<div class="scrolling-section">

<?php
echo '   <div style="margin-top:1%">
<form method="post" action="levadamenu.php">
    <label style="padding:1%;background-color: #c82f2f" for="">rimuovi portata a menu esistenete:</label><br><br>
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
   




echo '<label for="lang">Menu:</label>
<select name="menu" id="menu">';
$sqlm= "SELECT * FROM menu";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$resultm=$conn->query($sqlm);//oggetto che rappresenta la risposta del db


while($rowm=$resultm->fetch_assoc()){

echo '<option value="'.$rowm["idmenu"].'">'.$rowm["denominazione"].'</option>';




}


echo '</select><br>';















echo ' <br>

<input type="submit" value="Invia">
<input type="reset" value="Reset">
</form>
</div>';

?> </div>




<h2><a href="editmenu.php">Vuoi tornare a modificare?</a></h2>
    <?php 
include "./Template/misura.html";
 ?>



    <?php
include "./Template/footer.html";
?>
</body>

</html>