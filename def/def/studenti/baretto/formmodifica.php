<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrati</title>
    <link rel="stylesheet" href="./css/style.css" type="text/css">
    <script src="./app.js"></script>
</head>
<body style="background-repeat: no-repeat; background-size: 105%;" background="./LSTR_Background_Menu_v2.jpg">
   
<?php
include "./Template/intestazione.html";

?>
<?php
include "./Template/barraLaterale.html";
?>

<form method="post"  action="modifica.php">
<fieldset  class="info_personali">

<legend>scegli cosa modificare:</legend>
<ol>
<input type="button" onclick="modificaNome()" value="Modifica nome">  <li style="float:center" id="NOME"></li>
<input type="button" onclick="modificaCognome()" value="Modifica cognome">  <li id="COGNOME" ></li>
<input type="button" onclick="modificaEmail()" value="Modifica email">   <li id="EMAIL"></li>
<input type="button" onclick="modificaPassword()" value="Modifica password"><li id="PASSWORD"></li>
<input type="hidden" name="emailattuale"  id="hiddenField">

<label for="password">password attuale: </label>
            <input type="password" name="pwdattuale" id="password">
   
    <li><input type="submit"  onclick="mailAttuale()" value="Modifica"><input type="reset" value="Reset"></li>
</ol><legend ><a href="formregistrazione.php">finito di modificare?</a></legend>
   
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
