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
if(isset($_SESSION["ruolo"])){
if($_SESSION["ruolo"]=="studente"){//se la mail non è presente nell'array $session
    echo "
    <h1>Accesso negato per l'account:  ".$_SESSION["email"] ." </h1>
    <p>
        se vuoi accedere a questa pagina accedi come admin!
    </p>";
    header("refresh: 3; url=formregistrazione.php");//redirect alla registrazione
}
else{

    echo "
    <h1>Autorizzazione concessa per l'account:  ".$_SESSION["email"] ." </h1>
    <p>
        Benvenuto nell'area admin!
    </p>";
    header("refresh: 3; url=editmenu.php");
}
}
else{
    echo "
    <h1>Non sei loggato!</h1>
    <p>
        se vuoi accedere a questa pagina accedi come admin!
    </p>";
    header("refresh: 3; url=formregistrazione.php");//redirect alla registrazione
}
    ?>

   
    <?php //logout ?>
</body>
</html>