<?php
    
session_start();//il client mi sta inviando il cookie di sessione?

if(!isset($_SESSION["email"])){//se la mail non è presente nell'array $session
    header("Location: formlogin.php");//redirect alla registrazione
}
else{
   // echo $_SESSION["email"] ;
}

if(!isset($_POST["idstruttura"])){
    echo "devi prima inserire almeno una struttura da eliminare! <br>";
  header("refresh: 3; url=index.php");
}
else if(empty($_POST["idstruttura"])){
      echo "non puoi inserire campi vuoti! <br>";
    header("refresh: 3; url=index.php");
}

   else{
  
    
       

  
//echo $oraCorrente." ".$_SESSION["datainizio"];
//$_SESSION["datainizio"]




$sql="DELETE FROM `struttura`  WHERE `idstruttura`= '".$_POST["idstruttura"]."'";
  if($conn->query($sql)){
    //oggetto che rappresenta la risposta del db
    echo "struttura eliminata con successo!";
 header("refresh: 3; url=index.php");
  
}


}
