<?php
echo '<script src="./app.js"></script>';

$mailPresente=false;
$email=stripslashes(strtolower($_POST["email"]));//email minuscola
$pwd=stripslashes($_POST["pwd"]);//levogli slash



$email= $conn->real_escape_string($email);//per accedere al database
$pwd= $conn->real_escape_string($pwd);//funzione del database per evitare l'inserimento di codice sql indesiderato (sql injection)

//$pwd=password_hash($pwd,PASSWORD_DEFAULT);
//echo "$email";
$sql= "SELECT * FROM utente WHERE email='$email'";//le righe dove la mail è uguale a qiuella inserita dall'utente
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

if($conta==0){
$mailPresente=false;
}
else{
    echo "c'è già un utente registrato con la stessa mail, scegline un'altra!";
    $mailPresente=true;
    header("refresh: 3; url=formregistrazione.php");
    exit;
}

if (!$mailPresente && $_POST["nome"] != "" && $_POST["cognome"] != "" && $_POST["email"] != "" && $_POST["pwd"] != "") {
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $email = $_POST["email"];
    $pwdUtente = password_hash($_POST["pwd"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO utente (cognome, nome, email, password,idruolo) ";
    $sql .= "VALUES ('$cognome', '$nome', '$email', '$pwdUtente',1)";

    if ($conn->query($sql)) {
        $_SESSION["ruolo"]="studente";


        echo "utente registrato, benvenuto " . $_POST["nome"] . "!";

        echo "<br>".$_SESSION["ruolo"];
        echo '<script>';
        echo 'registraUtente("' . $_POST["nome"] . '", "' . $_POST["cognome"] . '", "' . $_POST["email"] . '");'; // Chiama la funzione JavaScript definita nel file JavaScript
        echo '</script>';
        session_start();//inizializza il cookie di sessione, la sessione inizia
        
        $_SESSION["nome"]=$_POST["nome"];
$_SESSION["cognome"]=$_POST["cognome"];
        
        $_SESSION["email"]=$_POST["email"];

        $_SESSION["ruolo"]="studente";
        header("refresh: 3; url=loginok.php");
        exit;
    } else {
        echo "errore!<br>" . $conn->error . "<br>";
        header("refresh: 3; url=formregistrazione.php");
        exit;
    }
} else {
    echo "non puoi inserire campi vuoti! <br>";
    header("refresh: 3; url=formregistrazione.php");
    exit; // Esce dallo script PHP quando ci sono campi vuoti
}
$result->free();
$conn->close();