<?php
    
session_start();//il client mi sta inviando il cookie di sessione?

if(!isset($_SESSION["email"])){//se la mail non è presente nell'array $session
    header("Location: formlogin.php");//redirect alla registrazione
}
else{
   // echo $_SESSION["email"] ;
}

if(!isset($_POST["regione"])||!isset($_POST["categoria"])){
    echo "devi prima memorizzare almeno una possibile regione e una possibile categoria! <br>";
    header("refresh: 3; url=index.php");
}


 if(empty($_POST["indirizzo"])||empty($_POST["telefono"])||empty($_POST["email"])||empty($_POST["importo"])){
      echo "non puoi inserire campi vuoti! <br>";
    header("refresh: 3; url=index.php");
}

   
  if(isset($_POST["regione"])&&isset($_POST["categoria"])&&!empty($_POST["indirizzo"])&&!empty($_POST["telefono"])&&!empty($_POST["email"])&&!empty($_POST["importo"]))
    
       {

  $testo=$conn->real_escape_string(stripslashes($_POST["indirizzo"]));
  $testo2=$conn->real_escape_string(stripslashes($_POST["nome"]));
//echo $oraCorrente." ".$_SESSION["datainizio"];
//$_SESSION["datainizio"]


/*

$sql="INSERT INTO `struttura` (`idstruttura`, `indirizzo`, `telefono`, `email`, `prezzo`, `foto`, `nome`, `categoria_idcategoria`, `regione_idregione`) VALUES ('', '$testo', '".$_POST["telefono"]."', '".$_POST["email"]."', '".$_POST["importo"]."', '$imgContent', '$testo2', '".$_POST["categoria"]."', '".$_POST["regione"]."')";
echo $sql;
  if($conn->query($sql)){
    //oggetto che rappresenta la risposta del db
    echo "struttura archiviata con successo!";
 //header("refresh: 3; url=index.php");
  
}
*/
$insert=false;
if(!empty($_FILES["image"]["name"])) { 
    // Get file info 
    $fileName = basename($_FILES["image"]["name"]); 
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
     
    // Allow certain file formats 
    $allowTypes = array('jpg','png','jpeg','gif'); 
    if(in_array($fileType, $allowTypes)){ 
        $image = $_FILES['image']['tmp_name']; 
        $imgContent = addslashes(file_get_contents($image)); 
     
        // Insert image content into database 
        $sql="INSERT INTO `struttura` (`idstruttura`, `indirizzo`, `telefono`, `email`, `prezzo`, `foto`, `nome`, `categoria_idcategoria`, `regione_idregione`) VALUES ('', '$testo', '".$_POST["telefono"]."', '".$_POST["email"]."', '".$_POST["importo"]."', '$imgContent', '$testo2', '".$_POST["categoria"]."', '".$_POST["regione"]."')";
        //echo $sql;
          if($conn->query($sql)){
            //oggetto che rappresenta la risposta del db
            $insert=true;
            echo "struttura archiviata con successo!<br>";
        
          
        }
         
        if($insert){ 
            $status = 'success'; 
            $statusMsg = "Foto inviata con successo "; 
           
        }else{ 
            $statusMsg = "Upload immagine fallito! perfavore riprova"; 
           //header("refresh: 3; url=index.php");
        }  
    }else{ 
        $statusMsg = 'Formato immagine non compatibile! I formati compatibili sono:  JPG, JPEG, PNG, GIF';
       // header("refresh: 3; url=index.php");

    } 
}else{ 
    $statusMsg = 'Perfavore inserisci un immagine'; 
    //header("refresh: 3; url=index.php");
} 
 

// Display status message 
echo $statusMsg; 
header("refresh: 3; url=index.php");
}