<!DOCTYPE html>


<script type="text/javascript">
var maxcat=-1;
var prezzototale=0;
var prezzoparziale=0;
var menuA=-1;

function Calcola(massimomenu,massimocategoria,massimoportata){


    


   var nocategorie=false;
   if(massimocategoria==-1){
massimocategoria=1;
nocategorie=true;

if(maxcat!=-1){
    massimocategoria=maxcat;
    
}


}else{
   maxcat= massimocategoria;
}
 //var prodotti=0;

elementiC=0;
   for (var m=1;m<=massimomenu;m++){


    
for (var i=1;i<=massimocategoria;i++){
   

              

    for (var x=1;x<=massimoportata;x++){
        var elementoPrezzo="";
      


       elementoPrezzo =document.getElementById("prezzo_"+m+"_"+i+"_"+x);
  

      
        if(elementoPrezzo!=null){
          
// Ottieni il contenuto testuale dell'elemento
var prezzoTestuale = elementoPrezzo.textContent;
//alert(prezzoTestuale);

// Rimuovi eventuali spazi bianchi e converti il testo in un numero float
 var prezzo= parseFloat(prezzoTestuale);

var num=document.getElementById(m+"_"+i+"_"+x).value;
//alert(prezzo); 
prezzoparziale+=prezzo*num;
if(parseInt(m)==parseInt(menuA)){
aggiornaCarrello(m, i, x, num, prezzo);
   
}

        }
   
    
        
  

}


if(document.getElementById("totale_"+m+"_"+i)!=null){
document.getElementById("totale_"+m+"_"+i).innerHTML =prezzoparziale;
}
prezzototale+=prezzoparziale;
prezzoparziale=0;

}

if(document.getElementById("totale_menu_"+m)!=null){

 

for (var p=1;p<=massimoportata;p++){
var elementoPrezzo="";

elementoPrezzo =document.getElementById("prezzo_"+m+"_NULL_"+p);
if(elementoPrezzo!=null){

var prezzoTestuale = elementoPrezzo.textContent;
var  prezzo= parseFloat(prezzoTestuale);
var num=document.getElementById(m+"_NULL_"+p).value;
prezzototale+=prezzo*num;


//alert(prezzototale);
//alert(prodotti);
//alert(menuA);
//alert(m);
if(parseInt(m)==parseInt(menuA)){
aggiornaCarrello(m, 0, p, num, prezzo);

}
//alert(lastnull);

}
}







document.getElementById("totale_menu_"+m).innerHTML =prezzototale;
if(m==menuA){
document.getElementById("totale_carrello").textContent = prezzototale;
}

}
prezzototale=0;

   }


    // Seleziona l'elemento con id "prezzo_1_1"

}
var elementiC=0;

function menuAttivo(menu){
    menuA=menu;
}
function aggiornaCarrello(menu, categoria, portata, quantita, prezzo) {
    var carrello = document.getElementById("carrello");
    var idElemento = "carrello_" + menu + "_" + categoria + "_" + portata;
    var elementoCarrello = document.getElementById(idElemento);
   
    if (quantita > 0) {
        
        if (elementoCarrello == null) {
            elementoCarrello = document.createElement("tr");
            elementoCarrello.id = idElemento;

            var tdNome = document.createElement("td");
          
if(categoria==0){
    categoria="NULL";
}

            tdNome.textContent =   document.getElementById("nome_"+menu + "_" + categoria + "_" + portata).textContent;

            var tdQuantita = document.createElement("td");
            tdQuantita.id = "quantita_" + idElemento;
            tdQuantita.textContent = quantita;

            var tdPrezzo = document.createElement("td");
            tdPrezzo.textContent = (prezzo * quantita).toFixed(2) + "€";

            elementoCarrello.appendChild(tdNome);
            elementoCarrello.appendChild(tdQuantita);
            elementoCarrello.appendChild(tdPrezzo);

            carrello.appendChild(elementoCarrello);
        } else {
           // elementiC--;
            document.getElementById("quantita_" + idElemento).textContent = quantita;
            elementoCarrello.querySelector("td:last-child").textContent = (prezzo * quantita).toFixed(2) + "€";
        }
    } else if (elementoCarrello != null) {
       // elementiC--;
        carrello.removeChild(elementoCarrello);
    }

    elementiC+=parseFloat(quantita);
    document.getElementById("prodotti").textContent = elementiC;

}
    </script>


<?php
session_start();//il client mi sta inviando il cookie di sessione?

if(!isset($_SESSION["email"])){//se la mail non è presente nell'array $session
    header("Location: formregistrazione.php");//redirect alla registrazione
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

<table border="1" style="background-color:white;width:50%;height:50%">

<thead>

<?php

include "Template/connessione.php";

$sql= "SELECT * FROM menu";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$resultm=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$resultm->num_rows;//utenti con quella mail
$tot="";
$stampato=false;
while($rowm=$resultm->fetch_assoc()){
    if($rowm["stato"]=="ATTIVO"){
        echo "<script>menuAttivo(".$rowm["idmenu"].") </script>";
        echo '<form  action="ordina.php" method="post">';
 
        }
    echo ' <tr><th colspan="4">Menu: '.$rowm["denominazione"].'</th></tr>';
//echo "<br><br><b>Denominazione: ".$rowm["denominazione"]."</b><br>";

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
    $stampato=false; 
    if($tot!=""){
        $stampato=false;
        echo $tot;
        $tot="";
    }
    
         
    
  
       $tot= '  <tr><th colspan="3"><strong>Totale '.$rowc["denominazione"].':</strong></th><th><strong id="totale_'.$rowm["idmenu"].'_'.$rowc["idcategoria"].'">0</strong><strong>&euro;</strong></th></tr>';
      
    echo ' <tr><th colspan="4">'.$rowc["denominazione"].'</th></tr>';
//echo "<br><br><b>categoria: ".$rowc["denominazione"]."</b><br>";
$precategoria=$rowc["denominazione"];
}
}
$sqlmaxm= "SELECT max(idmenu) as massimo FROM menu";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$resultmaxm=$conn->query($sqlmaxm);//oggetto che rappresenta la risposta del db

$rowmaxm=$resultmaxm->fetch_assoc();
$massimom=$rowmaxm["massimo"];



$sqlmaxc= "SELECT max(idcategoria) as massimo FROM categoria";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$resultmaxc=$conn->query($sqlmaxc);//oggetto che rappresenta la risposta del db

$rowmaxc=$resultmaxc->fetch_assoc();
$massimoc=$rowmaxc["massimo"];

$sqlmaxp= "SELECT max(idportata) as massimo FROM portata";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$resultmaxp=$conn->query($sqlmaxp);//oggetto che rappresenta la risposta del db

$rowmaxp=$resultmaxp->fetch_assoc();
$massimop=$rowmaxp["massimo"];


if(!isset($rowc["idcategoria"])){
    $rowc["idcategoria"]="NULL";
    $massimoc=-1;
}
else if($rowc["idcategoria"]=="NULL"){
    $massimoc=-1;
}
echo '    <td><input type="number" value="0" step="1" min="0" max="3" onclick="Calcola('.$massimom.','.$massimoc.','.$massimop.')" id="'.$rowm["idmenu"].'_'.$rowc["idcategoria"].'_'.$row["idportata"].'" name="'.$rowm["idmenu"].'_'.$rowc["idcategoria"].'_'.$row["idportata"].'"/><br>
</td>

<td  id="nome_'.$rowm["idmenu"].'_'.$rowc["idcategoria"].'_'.$row["idportata"].'"  >'.$row["nomeportata"].'</td>

';

//echo "<br><br><b>-".$row["nomeportata"]."</b> Prezzo: ".$row["prezzo"]."<br>";

$sql= "SELECT ingrediente.denominazione, ingrediente.allergene FROM ingrediente inner join portata_has_ingrediente on idingrediente=ingrediente_idingrediente inner join portata on idportata=portata_idportata where portata.nomeportata='".$row["nomeportata"]."'";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result2=$conn->query($sql);//oggetto che rappresenta la risposta del db


$prima=true;
echo "<td>";
while($row2=$result2->fetch_assoc()){
   //echo "hhhhhhhhhhhhhhhhh";
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
echo "</td>";

echo '<td><strong><strong   id="prezzo_'.$rowm["idmenu"].'_'.$rowc["idcategoria"].'_'.$row["idportata"].'">'.$row["prezzo"].'</strong>&euro;</strong></td></tr>';


  
}
if(!$stampato){
    echo $tot;
 
    $tot="";
}
echo '  <tr><th colspan="3"><strong>Totale Menu '.$rowm["denominazione"].':</strong></th><th><strong id="totale_menu_'.$rowm["idmenu"].'">0</strong><strong>&euro;</strong></th></tr>';
if($rowm["stato"]=="ATTIVO"){
    echo '<td colspan="4"><input type="submit" value="invia ordine"></td></form>';
    }
        echo '</thead></table><br><br><table border="1" style="background-color:white;width:50%;height:50%">
    
        <thead>';
    
}


?> 



  
   
    
      
 </thead>
 <tbody>
 <tfoot>


</tfoot>

</table>
 
</div>


    <?php 
include "./Template/misura.html";
 ?>


<h1 id="prodotti">0</h1>
    <table id="carrello"   border="1" style="background-color:white;width:50%;height:50%">
    </table>

    <table border="1" style="background-color:white;width:50%;height:50%">
    <td><p><strong  id="totale_carrello" >0</strong>&euro;</p></td>
    </table>
    <?php
include "./Template/footer.html";
?>
</body>

</html>