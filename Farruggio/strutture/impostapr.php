
<?php
    
session_start();//il client mi sta inviando il cookie di sessione?

if(!isset($_SESSION["email"])){//se la mail non è presente nell'array $session
    header("Location: formlogin.php");//redirect alla registrazione
}
else{
   // echo $_SESSION["email"] ;
}
    
$segno="";
if($_POST["SI"]==0){
    $segno=">";

}
else if($_POST["SI"]==1){
    $segno="<";
}
if(!empty($_POST["importo"])){
$_SESSION["condizione3"]="prezzo $segno '".$_POST["importo"]."'";
echo "seguenti criteri impostati: ".$_SESSION["condizione3"];
}
else{
    echo "inserire un importo per applicare il filtro!";
}
header("refresh: 3; url=index.php");


