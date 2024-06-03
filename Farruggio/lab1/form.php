<html>
<?php
echo "<form  method=\"GET\">";
    for($i=1;$i<=10;$i++){
         echo "<label for= \" numero_$i \"> numero $i</label> <input type=\"number\" name=\"numero_$i\" id=\"numero_$i\" ><br>";
   
    }
echo "<input type=\"submit\" name=\"submit\" value=\"invia\">
</form>";
    function media($get){
        $elementi=converti($get);
    // echo "\nfunzione media risponde: ";
    $somma=0;
    if($elementi!=null){
  for($i=0; $i<count($elementi);$i++){
     $somma+=(int)$elementi[$i] ;
  }  

  $media=$somma/count($elementi);
  //echo "\nmedia: ".$media;
  return "media: ".$media;
  }
}
function piuPiccoloPiuGrande($get){
    $elementi=converti($get);
    if($elementi!=null){
  //   echo "\nfunzione piuPiccoloPiuGrande risponde: ";
   $piuPiccolo=$elementi[0];
   $piuGrande=$elementi[0];
  for($i=0; $i<count($elementi);$i++){
      
      if($elementi[$i]>$piuGrande){
          $piuGrande=$elementi[$i];
      }
      if($elementi[$i]<$piuPiccolo){
           $piuPiccolo=$elementi[$i];
      }
    
  }  
    
    if($piuPiccolo==$piuGrande){
        return "\nTutti gli elementi sono uguali a ".$piuGrande;
        
    }
    else{
        return "\npiù piccolo: ".$piuPiccolo."<br>più grande: ".$piuGrande;
    }
    }
}

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


echo "<h1>".media($_GET)."</h1><br>" ;
echo "<h1>".piuPiccoloPiuGrande($_GET)."</h1><br>" ;
    ?>

</html>