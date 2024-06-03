<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sessione iniziata!</title>
</head>
<body>
    <?php
    
session_start();//il client mi sta inviando il cookie di sessione?

if(!isset($_SESSION["email"])){//se la mail non è presente nell'array $session
    header("Location: formregistrazione.php");//redirect alla registrazione
}
else{
    header("refresh: 3; url=index.php");
}
    ?>

    <h1>Sessione corrente per l'account: <?= $_SESSION["email"] ?> </h1>
    <p>
        Benvenuto nell'area riservata!
    </p>
   
    <?php //logout ?>
</body>
</html>