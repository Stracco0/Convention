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
            $returnto1="index.php";
            $returnto2="AggiungiSpeech.php";
            include_once("navbar.php");
    ?>
    <div class="container-fluid p-3">
        <?php
                echo "<a href='index.php'><button class='btn  btn-primary mb-2'><i class='fas fa-arrow-left'></i></button></a>";
                if(Controllo_Utente()){
                    #l'utente ha cliccato ed è autenticato quindi aggiorno tempo sessione
                    RefreshTempo();
                    if (Database::connect()){
                        #Ottengo lista Speech con un bottone aggiungi
                        $queryTab= "SELECT DISTINCT FasciaOraria,Titolo,Argomento,IDSpeech,NpostiSala,Numero,PostiRimasti FROM Sceglie,Programma,Speech,Sala,Piano,PostiRimastiPerFasciaOraria WHERE Sceglie.IDProgramma_fk = Programma.IDProgramma AND Speech.IDSpeech = Programma.IDSpeech_fk AND Programma.NomeSala_fk = Sala.NomeSala AND Sala.Numero_fk = Piano.Numero AND Sala.NomeSala = PostiRimastiPerFasciaOraria.NomeSalaView";
                        if($risultatoSpeech=Database::executeQueryNormal($queryTab)){
                            if (!($risultatoSpeech->num_rows) == 0){

                                #controllo la query ha prodotto dei risultati
                                $htmlmio=<<<XYZ
                                <div class="row">
                                    <div class="col">
                                        <h2 class='card-title p-2 text-center p-3'>Speech Disponibili</h2>
                                    </div>
                                </div>
                                <div class="card">
                                    <table class='table mb-0'>
                                        <thead class="thead-dark">
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
                                            echo "<td><form action='Aggiungi.php' method='POST'><input type='hidden' name='IdPart' value=".$_SESSION['idPart']." /><input type='hidden' name='QualeSpeech' value=".$Risposta_speech["IDSpeech"]." /><button title='Iscriviti' type='submit' class='btn btn-secondary'><i class='fas fa-plus'></i></button></form></td>";
                                        }else{
                                            echo "<td><button type='submit' class='btn btn-secondary' title='Iscriviti' disabled><i class='fas fa-plus'></i></button></td>";
                                        }
                                    echo "<tr>";
                                }
                                $htmlmio =<<<XYZ
                                        </tbody>
                                    </div>
                                </table>
                                XYZ;
                            }
                            else{
                                Database::disconnect();
                                echo "<br>Non esiste nessuno speech in giornata";
                            }
                        }
                        Database::disconnect();
                    }
                }
                else{
                    Database::disconnect();
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
