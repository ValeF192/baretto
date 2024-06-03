

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accedi</title>

</head>
<body style="background-repeat: no-repeat; background-size: 105%;">
   


<form method="post" action="accedi.php">
<fieldset class="info_personali">
    <legend>
    Accesso all'area riservata:
    </legend>
    <ol>
        
        <li>
            <label for="ID">Codice Fiscale o Numero Conto:</label>
            <input type="text" name="ID" id="ID">
        </li>
        <li>
            <label for="password">password</label>
            <input type="password" name="pwd" id="password">
        </li>
       
        <li>
            <input type="submit"   value="Accedi">
            <input type="reset" value="Reset">
        </li>
    </ol>
</fieldset>

 </form>



</body>
</html>
