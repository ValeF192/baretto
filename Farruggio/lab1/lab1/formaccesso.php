

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accedi</title>
    <link rel="stylesheet" href="./css/style.css" type="text/css">

</head>
<body style="background-repeat: no-repeat; background-size: 105%;" background="./LSTR_Background_Menu_v2.jpg">
   
<?php
include "./Template/intestazione.html";

?>
<?php
include "./Template/barraLaterale.html";
?>

<form method="post" action="accedi.php">
<fieldset class="info_personali">
    <legend>
    Accesso all'area riservata:
    </legend>
    <ol>
        
        <li>
            <label for="email">Contatto email:</label>
            <input type="email" name="email" id="email">
        </li>
        <li>
            <label for="password">password</label>
            <input type="password" name="pwd" id="password">
        </li>
       
        <li>
            <input type="submit"   value="Accedi">
            <input type="reset" value="Reset">
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
