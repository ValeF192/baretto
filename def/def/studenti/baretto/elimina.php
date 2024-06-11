 <script src="./app.js"></script>
 <link rel="stylesheet" href="./css/style.css" type="text/css">
 <body style="background-repeat: no-repeat; background-size: 115%;" background="./LSTR_Background_Menu_v2.jpg">
 <?php
include "./Template/intestazione.html";

?>
 <?php
    session_start();//inizializza il cookie di sessione, la sessione inizia
     if(!isset($_POST["email"])&&isset($_SESSION["email"])){
echo '<form method="post" action="elimina.php"><fieldset class="info_personali"><legend>     Conferma la tua identità:   </legend>   <ol> <li>     <label for="email">Contatto email:</label>     <input type="email" name="email" id="email"> </li>   <li>        <label for="password">password</label>         <input type="password" name="pwd" id="password">        </li>   <li>     <input type="submit" value="Accedi">         <input type="reset" value="Reset">     </li>     </ol>    </fieldset></form>';
}
else if(isset($_POST["email"])&&$_POST["email"]==$_SESSION["email"]){
include "Template/connessione.php";


$email=stripslashes(strtolower($_POST["email"]));//email minuscola
$pwd=stripslashes($_POST["pwd"]);//levogli slash



$email= $conn->real_escape_string($email);//per accedere al database
$pwd= $conn->real_escape_string($pwd);//funzione del database per evitare l'inserimento di codice sql indesiderato (sql injection)

//$pwd=password_hash($pwd,PASSWORD_DEFAULT);
//echo "$email";
$sql= "SELECT * FROM utente inner join ruolo using(idruolo) WHERE email='$email'";//le righe dove la mail è uguale a qiuella inserita dall'utente
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

if($conta==1){//la mail è univoca, quindi ne deve essere uscito uno
$row =$result->fetch_assoc();//row viene trasformato in un array associativo
$passwordRecuperata=$row["password"];
$controllo=false;
//echo $passwordRecuperata."<br>".$pwd."<br>";

if(password_verify($pwd,$passwordRecuperata)){//confrontas la password recuperata con quella salvata nel db , utilizzando lo stesso algoritmo di hash che è stato utilizzato per salvare la password in fase di registrazione
    $controllo=true;
}


if($controllo){
    //il client mi sta inviando il cookie di sessione?
//il server crea il cookie e viene richiesto per ogni query

    
 
 include "Template/eliminaUtente.php";
 exit;
}
else{
    echo "password errata";
    echo '<script>';
 echo 'registraUtente("' . $row["nome"] . '", "' . $row["cognome"] . '", "' . $row["email"] . '");'; // Chiama la funzione JavaScript definita nel file JavaScript
 
 echo '</script>';
    header("refresh: 3; url=formregistrazione.php");
    exit;
}
}
else if($conta==0){
echo "utente non presente";
echo '<script>';
 echo 'registraUtente("' . $row["nome"] . '", "' . $row["cognome"] . '", "' . $row["email"] . '");'; // Chiama la funzione JavaScript definita nel file JavaScript
 
 echo '</script>';
header("refresh: 3; url=formregistrazione.php");
exit;
}









}
else if(isset($_POST["email"])){
    if($_POST["email"]!=$_SESSION["email"]){
include "Template/connessione.php";

$sql= "SELECT * FROM utente inner join ruolo using(idruolo) WHERE email='".$_SESSION["email"]."'";//le righe dove la mail è uguale a qiuella inserita dall'utente
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

$row =$result->fetch_assoc();
        
    echo "credenziali errate";
    echo '<script>';
 echo 'registraUtente("' . $row["nome"] . '", "' . $row["cognome"] . '", "' . $row["email"] . '");'; // Chiama la funzione JavaScript definita nel file JavaScript
 
 echo '</script>';
header("refresh: 3; url=formregistrazione.php");
}
}
?>

<?php
include "./Template/footer.html";

?>
 </body>