<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi</title>
</head>
<body>
    <?php
            include "Database.php";
            include "utilitis.php";
            Controllo_Cookie(false);
            $where="Aggiungi";
            include_once("navbar.php");
    ?>
    <div class="container-fluid p-3">
        <?php
                echo "<a href='index.php'><button class='btn btn-primary'>Indietro</button></a>";
                if(Controllo_Utente()){
                    #l'utente ha cliccato ed è autenticato quindi aggiorno tempo sessione
                    RefreshTempo();
                    if (Database::connect()){
                        #Ottengo lista Speech con un bottone aggiungi
                        $queryTab= "SELECT DISTINCT FasciaOraria,Titolo,Argomento,IDSpeech,NpostiSala,Numero,PostiRimasti FROM Sceglie,Programma,Speech,Sala,Piano,PostiRimastiPerFasciaOraria WHERE Sceglie.IDProgramma_fk = Programma.IDProgramma AND Speech.IDSpeech = Programma.IDSpeech_fk AND Programma.NomeSala_fk = Sala.NomeSala AND Sala.Numero_fk = Piano.Numero AND Sala.NomeSala = PostiRimastiPerFasciaOraria.NomeSalaView";
                        if($risultatoSpeech=Database::executeQueryNormal($queryTab)){
                            echo "";
                            if (!($risultatoSpeech->num_rows) == 0){
                                #controllo la query ha prodotto dei risultati
                                $htmlmio=<<<XYZ
                                <table class='table'>
                                    <thead>
                                        <tr>
                                            <th>Orario evento</th>
                                            <th>Titolo</th>
                                            <th>Argomento</th>
                                            <th>Piano</th>
                                            <th>Posti rimanenti</th>
                                            <th>Azioni</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                XYZ;
                                echo $htmlmio;
                                while($Risposta_speech=mysqli_fetch_array($risultatoSpeech)) {
                                    echo "<tr>";
                                        echo "<td>" . $Risposta_speech["FasciaOraria"] . "</td>";
                                        echo "<td>" . $Risposta_speech["Titolo"] . "</td>";
                                        echo "<td>" . $Risposta_speech["Argomento"] . "</td>";
                                        echo "<td>" . $Risposta_speech["Numero"] . "</td>";
                                        echo "<td>" .$Risposta_speech["PostiRimasti"]. "</td>"; #aggiungere vista che permetta di vedere quanti posti rimangono, in caso non ci fosserò più posti diventa grigio
                                        if ($Risposta_speech["PostiRimasti"] > 0){
                                            echo "<td><form action='Aggiungi.php' method='POST'><input type='hidden' name='IdPart' value=".$_SESSION['idPart']." /><input type='hidden' name='QualeSpeech' value=".$Risposta_speech["IDSpeech"]." /><button type='submit' class='btn btn-secondary'>Aggiungi</button></form></td>";
                                        }else{
                                            echo "<td><button type='submit' class='btn btn-secondary' disabled>Aggiungi</button></td>";
                                        }
                                    echo "<tr>";
                                }
                                $htmlmio =<<<XYZ
                                    </tbody>
                                </table>
                                XYZ;
                            }
                            else{
                                echo "Non esiste nessuno speech in giornata";
                            }
                        }
                    }
                }
                else{
                    header("Location: ./destroyer_session.php");
                    exit;
                }
                if($_REQUEST["user"]=="AlreadyExists"){
                    alert("Sei già iscritto a questo evento");
                }
                function alert($msg) {
                    echo "<script type='text/javascript'>alert('$msg');</script>";
                }
        ?>
    </div>
</body>
</html>
