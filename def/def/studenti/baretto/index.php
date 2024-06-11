<!DOCTYPE html>
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



    <?php 
include "./Template/post.php";
 ?>

    <?php 
include "./Template/misura.html";
 ?>



    <?php
include "./Template/footer.html";
?>
</body>

</html>