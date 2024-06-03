
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

<form method="post"  action="registra.php">
<fieldset id="I" class="info_personali">


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


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Registrazione nuovo utente</h2>
    <form method="post" action="registra.php">

        Cognome:<input type="text" name="cognome">
        Nome:<input type="text" name="nome">
       Email:<input type="text" name="email">
       Password:<input type="password" name="password">
<input type="submit"  value="Registra">


    </form>
</body>
</html>

->