<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ristorante di Farruggio</title>
    <link rel="stylesheet" href="./css/style.css" type="text/css">

</head>
<body style="background-repeat: no-repeat; background-size: 105%;" background="./LSTR_Background_Menu_v2.jpg">
   
<?php
include "./Template/intestazione.html";

?>
<?php
include "./Template/barraLaterale.html";
?>

 <form method="get" action="info.php">
<fieldset class="info_personali">
    <legend>
        Inserisci le tue informazioni per completare la prenotazione!
    </legend>
   
    <ol style="padding-bottom: 20px;" >
        <p style="padding-top: 20px;" id="P">
        
</p>
        <li>
            <label for="quanti">Quanti siete?</label>
            <input type="number" name="quanti" id="quanti" min="0" max="20">
        </li>
        <li>
            <label for="dataprenotazione">Che giorno? a che ora?</label>
            <input type="datetime-local" name="dataprenotazione" id="dataprenotazione" value="17-10-2023">
        </li>
      
        <li>
            <label for="url">se sei un critico inserisci qui l'url del tuo sito, aspetteremo con ansia la tua recensione! </label>
            <input type="url" name="url" id="url">
        </li>
        <li>
            <label for="colore">Scegli il tuo colore, la tavola verrà decorata con esso</label>
            <input type="color" name="colore" id="colore">
        </li>
        <li>
            <input type="submit" value="invia">
        </li>
    </ol>
</fieldset>

 </form>

<?php 
include "./Template/misura.html";
 ?>
 


<?php
include "./Template/footer.html";
?>

</body>
</html>