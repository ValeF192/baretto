<html>

<body>
    <h1>Indovina i 10 numeri segreti: </h1>

    <?php
echo "<form  method=\"GET\">";
    for($i=1;$i<=10;$i++){
         echo "<label for= \" numero_$i \"> numero $i</label> <input type=\"number\" name=\"numero_$i\" id=\"numero_$i\" ><br>";
   
    }
echo " <label for=\"random\"> numeri random sempre diversi</label> <input type=\"checkbox\" id=\"random\" name=\"random\"><br><input type=\"submit\" name=\"submit\" value=\"invia\">
</form>";
    
function converti($get){
    if(key_exists("numero_1",$get)){
    $convertita[]= (int)$get["numero_1"];
    for($i=2;$i<count($get)-1;$i++){
          if(key_exists("numero_".$i,$get)){
   $convertita[]= (int)$get["numero_".$i];
          }
    }
    return $convertita;
}
}
if(!array_key_exists("random",$_GET)){
    $_GET["random"]="off";
}
if(isset($_GET["random"]) && $_GET["random"] == "off"){
    define("corretti", array(45, 56, 32, 900, 76, 5, 333, 4, 1, 20));
} else {
    define("corretti", array(rand(0, 1000), rand(0, 1000), rand(0, 1000), rand(0, 1000), rand(0, 1000), rand(0, 1000), rand(0, 1000), rand(0, 1000), rand(0, 1000), rand(0, 1000)));
}
function risultati($get){
    if($get!=null){
    $indovinati=0;
    $out="";
    $inseriti=converti($get);
    if($inseriti!=null){
    for($i=0;$i<count($inseriti);$i++){
        $out .=(string)$inseriti[$i];
        if($inseriti[$i]==corretti[$i]){
           $out.=" ==> corretto!<br>";
           $indovinati++;
        }
        else{
           $out.=" ==> sbagliato! avresti dovuto mettere: ".corretti[$i]."<br>";   
        }
    }
    }
    

$out.="numeri indovinati: ".$indovinati."<br>";
     return $out;
     }
}
echo "<h1>".risultati($_GET)."</h1><br>" ;

    ?>
</body>

</html>