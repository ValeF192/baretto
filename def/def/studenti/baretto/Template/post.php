<section id="post">

    <article class="post">
        <header>
            <h2>Benvenuti nell'Applicazione di Farruggio</h2>
        </header>
        <img align="right" src="." alt="" width="35%">
        <p>Divertitevi a testare la mia applicazione per fare ordini al bar</p>
        <p>Inserito dal mitico ing. chef Farruggio il <time datetime="2023-10-03T12:10"> 3 Ottobre 2023 alle
                12:15</time></p>

        <p>

        </p>
    </article>
    

    <h1> Hai un feedback? dimmi cosa ne pensi della mia applicazione qui:</h1>
    <aside>
        <div class="scrolling-section">

            <?php

    include "connessione.php";
$sql= "SELECT * FROM utente INNER JOIN commento ON codice=idUtente";//le righe dove la mail è uguale a qiuella inserita dall'utente
//echo $sql;
$result=$conn->query($sql);//oggetto che rappresenta la risposta del db
$conta=$result->num_rows;//utenti con quella mail

while($row=$result->fetch_assoc()){
    $dateTime = new DateTime($row["data"]);

// Formatta la data nel formato italiano
$dataItaliana = $dateTime->format('d-m-Y');
    echo $row["nome"].": ".$row ["testo"]."<br>".$dataItaliana." ore ".$row ["ora"]."<br><br>";


    
    
}


?> </div>
        <div style="margin-top:1%">
            <form method="post" action="commenta.php">
                <label style="padding:1%;background-color: #c82f2f" for="commento">Commento:</label>
                <input type="text" name="testo" id="testo">
                <input type="submit" value="Invia">
                <input type="reset" value="Reset">
            </form>
        </div>

    </aside>

</section>