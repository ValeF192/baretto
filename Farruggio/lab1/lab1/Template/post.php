<section id="post">

    <article class="post">
        <header>
            <h2>Oggi il piatto del giorno è la carbonara alla Farruggio</h2>
        </header>
        <img align="right" src="./CARBONARA-DI-MARE-2-scaled-e1597062865219.jpg" alt="Carbonara" width="35%">
        <p>Lo sappiamo, toccare la carbonara, il grande classico della cucina romana, è sempre un azzardo. Ma con la
            carbonara alla Farruggio si riscrive la storia: il guanciale croccante viene sostituito dai cubetti di pesce
            dorato e saporito, mentre il condimento a base di uova avvolgente e dorato resta sempre lo stesso.
            A differenza della versione viareggina con crostacei e molluschi, la carbonara alla Farruggio è condita con
            un mix di tre gustose varietà di pesce: salmone, tonno e pesce spada a cubetti saltati in padella. Non
            preoccupatevi, scoprirete molto presto che con la classica crema di tuorli e formaggio formano un connubio
            perfetto. Infatti il risultato che otterrete dalla carbonara di mare è quello di un piatto ricco e cremoso
            dal profumo intenso, che conquisterà i vostri amici amanti del pesce. </p>
        <p>Inserito dal mitico ing. chef Farruggio il <time datetime="2023-10-03T12:10"> 3 Ottobre 2023 alle
                12:15</time></p>

        <p>

        </p>
    </article>
    <aside>
        <p>
            "Popo bona ao! questo piatto è incredibile, lo consiglio a tutti i viaggiatori che passano da Roma"
        </p>

        <p>
            Simone:"Ma cos'è sta robaaa?!?!?! la carbonara non me la devono tocca"
        </p>
    </aside>

    <header>
        <h2>Ma come dimenticare la Vera Carbonara romana</h2>
    </header>
    <img align="right" src="./Carbonara Pesa def.jpg" alt="Carbonara" width="35%">
    <p>La vera carbonara romana, come si fa a Roma: finalmente la ricetta che tutti dobbiamo conservare a portata di
        mano. A regalarcela sono i fratelli Simone e Francesco Panella, rispettivamente chef e ristoratore di quarta
        generazione del mitico ristorante Antica Pesa dal 1922. Il leggendario luogo che nel 2022 ha compiuto un secolo
        è gestito dalla famiglia Panella che ha intrecciato la storia di Roma con quella del ristorante con tanto di 40
        ricette autentiche della cucina romanesca raccontate in un bellissimo libro uscito per la Newton Compton Editori
        intitolato 100 anni di cucina romana nelle ricette e nella storia dell'Antica Pesa.</p>
    <p>Inserito dal mitico ing. chef Farruggio il <time datetime="2023-10-04T16:34"> 4 Ottobre 2023 alle 16:34</time>
    </p>

    <p>

    </p>
    </article>
    <aside>
        <p>
            "in questo ristorante sono presenti tante varianti della carbonara, ma l'originale non si batte!"
        </p>
    </aside>
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