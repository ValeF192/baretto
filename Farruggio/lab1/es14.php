<?php

if(array_key_exists("nome",$_GET)&&array_key_exists("cognome",$_GET)&&array_key_exists("sesso",$_GET)){
    echo "<h1>Buongiorno Sig.";
    if($_GET["sesso"]=="F"){
        echo "ra";
    }

    echo " ".$_GET['cognome']."</h1>";
}

else{
echo '<form method="get" action="">
<fieldset class="info_personali">
    <legend>
   Inserisci i tuoi dati:
    </legend>
    <ul style=" list-style: none;">
    <li>
            <label for="cognome">Cognome:</label>
            <input type="text" name="cognome" id="cognome">
        </li>
        <li>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome">
        </li>
        <br>
        <li>
        <label for="sesso">Sesso:</label>
        M
        <input type="radio" id="M" name="sesso" value="M">
      F
 <input type="radio" id="F" name="sesso" value="F">
</li>
<br>
        <li>
            <input type="submit"   value="Invia">
        
        </li>
    </ul>
</fieldset>

 </form>';
}