<?php





  
   
    
    

  session_start();//inizializza il cookie di sessione, la sessione inizia
       
$emailCorrente=$_SESSION["email"];

$sql="SELECT * FROM utente  inner join ruolo using (idruolo) WHERE email='$emailCorrente'";


$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail
$row=$result->fetch_assoc(); 
$id=$row["codice"];
if($conta==1){
 
/*$allergene=$_POST["allergene"];
if(isset($allergene)){
    $allergene=1;
}
else{
    $allergene=0;
}*/

  $sql="INSERT INTO ordine(utente_codice) VALUES($id);";

  if($conn->query($sql)){

    $sqlmaxm= "SELECT max(idmenu) as massimo FROM menu";//le righe dove la mail è uguale a qiuella inserita dall'utente
    //echo $sql;
    $resultmaxm=$conn->query($sqlmaxm);//oggetto che rappresenta la risposta del db
    
    $rowmaxm=$resultmaxm->fetch_assoc();
    $massimom=$rowmaxm["massimo"];
    
    
    
    $sqlmaxc= "SELECT max(idcategoria) as massimo FROM categoria";//le righe dove la mail è uguale a qiuella inserita dall'utente
    //echo $sql;
    $resultmaxc=$conn->query($sqlmaxc);//oggetto che rappresenta la risposta del db
    
    $rowmaxc=$resultmaxc->fetch_assoc();
    $massimoc=$rowmaxc["massimo"];
    
    $sqlmaxp= "SELECT max(idportata) as massimo FROM portata";//le righe dove la mail è uguale a qiuella inserita dall'utente
    //echo $sql;
    $resultmaxp=$conn->query($sqlmaxp);//oggetto che rappresenta la risposta del db
    
    $rowmaxp=$resultmaxp->fetch_assoc();
    $massimop=$rowmaxp["massimo"];

    $sql="SELECT max(idordine) as ultimo from ordine ";


    $result=$conn->query($sql);//oggetto che rappresenta la risposta del db
    //$conta=$result->num_rows;//utenti con quella mail
    $row2=$result->fetch_assoc(); 

    $ultimo=$row2["ultimo"];



//echo $massimom." ".$massimoc." ".$massimop;
    for ($m=1;$m<=$massimom;$m++){


        for ($p2=1;$p2<=$massimop;$p2++){
           
            if(isset( $_POST[$m."_NULL_".$p2])){
                if( $_POST[$m."_NULL_".$p2]>0){
                    
$sql="SELECT * from `ordine_has_portata` where `ordine_idordine`='$ultimo' and `portata_idportata`='$p2'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$conta=$result->num_rows;//utenti con quella mail

if($conta==0){
         $sql =  "INSERT INTO `ordine_has_portata` (`ordine_idordine`, `menu_idmenu`, `portata_idportata`,  `quantita`) VALUES ('$ultimo', '$m', '$p2','". $_POST[$m."_NULL_".$p2]."')";
         $conn->query($sql);
}
        }
        }
        if(!empty($massimoc)){
        for ($c=1;$c<=$massimoc;$c++){
           
       
                      
        
            for ($p=1;$p<=$massimop;$p++){
                if(isset( $_POST[$m."_".$c."_".$p])){
               
                    if($_POST[$m."_".$c."_".$p]>0){

$sql="SELECT * from `ordine_has_portata` where `ordine_idordine`='$ultimo' and `portata_idportata`='$p'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$conta=$result->num_rows;//utenti con quella mail

if($conta==0){

                    $sql =  "INSERT INTO `ordine_has_portata` (`ordine_idordine`, `menu_idmenu`, `portata_idportata`, `categoria_idcategoria`, `quantita`) VALUES ('$ultimo', '$m', '$p', '$c','". $_POST[$m."_".$c."_".$p]."')";
                    $conn->query($sql);}
                }
            }
        }}
    }
        
        
             //  elementoPrezzo =document.getElementById("prezzo_"+m+"_"+i+"_"+x);

          
  
}
}

$sql="SELECT * from ordine_has_portata where ordine_idordine='$ultimo'";
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
//$conta=$result->num_rows;//utenti con quella mail
$row2=$result->fetch_assoc(); 

$conta=$result->num_rows;//utenti con quella mail

if($conta==0){
   $sql="DELETE from ordine where idordine='$ultimo'";
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db

   echo "non puoi fare un ordine vuoto!";
   header("refresh: 3; url=menu.php");

}
else{

//echo $_POST["1_NULL_1"];
//oggetto che rappresenta la risposta del db
echo "ordine archiviato con successo!";
header("refresh: 3; url=menu.php");
}
//header("refresh: 3; url=editmenu.php");
}}
else {
    echo "utente non trovato!";
    header("refresh: 3; url=formaccesso.php");
}

