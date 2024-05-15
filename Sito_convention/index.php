<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <?php
        include "Database.php";
        include "utilitis.php";
        $where="Home";
        $returnto1="index.php";
        $returnto2="index.php";
        include_once("navbar.php");
    ?>
    
    <div class="container-fluid p-3">
            <?php
                //fare in modo di creare versione incognita con tutti gli speech
                if(is_NOTAnonymus()){
                    Controllo_Utente();
                    if (Database::connect()){
                        if(isPart()){
                            $htmlmio=<<<XYZ
                            <div class="col text-end">
                                <form action="AggiungiSpeech.php" method="post">
                                    <button class="btn btn-secondary" type="submit">Aggiungi Speech</button>
                                </form>
                            </div>
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                            XYZ;
                            echo $htmlmio;
                            $queryTab= "SELECT FasciaOraria,Titolo,Argomento,IDSpeech,NpostiSala,Numero,PostiRimasti,IDProgramma_fk FROM Sceglie,Programma,Speech,Sala,Piano,PostiRimastiPerFasciaOraria WHERE Sceglie.IDProgramma_fk = Programma.IDProgramma AND Speech.IDSpeech = Programma.IDSpeech_fk AND Programma.NomeSala_fk = Sala.NomeSala AND Sala.Numero_fk = Piano.Numero AND Sala.NomeSala = PostiRimastiPerFasciaOraria.NomeSalaView AND Sceglie.IDPart_fk = ?";
                            $parametri=["i",$_SESSION['idPart']];
                            if($result=Database::executeQuery($queryTab,$parametri,true)){
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        // Recupero della data
                                        $Orario = $row["FasciaOraria"];
                
                                        // Recupero del relatore incaricato
                                        $queryRelatore = "SELECT Relatore.NomeRel, Relatore.CognomeRel FROM Relatore JOIN Relaziona ON Relatore.IDRel = Relaziona.IDRel_fk WHERE Relaziona.IDProgramma_fk = ?";
                                        $parametriRelatore=["i",$row["IDSpeech"]];
                                        $relatore_result = Database::executeQuery($queryRelatore,$parametriRelatore,true);
                                        $rowRelatore = $relatore_result->fetch_assoc();
                                        $htmlmio=<<<XYZ
                                        <div class='col-lg-3 col-md-4 col-sm-6 col-12 mb-4'>
                                            <div class="card h-75">
                                                <h5 class='card-title mb-0 text-center text-white bg-primary p-3'>{$row["Titolo"]}</h5>
                                                <hr class="mb-0 mt-0"></hr>
                                                <div class="card-body overflow-auto border-top">
                                                    <p class="card-text"><strong>Relatore:</strong> {$rowRelatore["NomeRel"]} {$rowRelatore["CognomeRel"]}</p>
                                                    <p class="card-text"><strong>Descrizione:</strong> {$row["Argomento"]}</p>
                                                    <p class="card-text"><strong>Orario:</strong> $Orario</p>
                                                    <p class="card-text"><strong>Sala:</strong> {$row["Numero"]}</p>
                                                    <p class="card-text"><strong>Posti disponibili:</strong> {$row["PostiRimasti"]}</p>
                                                </div>
                                                <hr class="mb-0 mt-0"></hr>
                                                <div class="row text-center p-2">
                                                    <div class="col">
                                                        button
                                                    </div>
                                                    <div class="col">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        XYZ;
                                        echo $htmlmio;
                                    }
                                } else {
                                    echo "Nessun speech trovato";
                                }
                            }
                        }
                        if(isArel()){
                            #Ottengo id del relatore
                            $queryTab= "SELECT NomeRel,CognomeRel,RSAzienda_fk FROM Relatore WHERE IDRel = ?";
                            $parametri=["i",$_SESSION["RelAnche"]];
                            if($risultatoUser=Database::executeQuery($queryTab,$parametri,true)){
                                if (($risultatoUser->num_rows) == 1){
                                    #controllo se l'id del relatore esiste
                                    $Risposta_user=$risultatoUser->fetch_assoc();
                                    echo "Benvenuto/a ".$Risposta_user["NomeRel"]." ".$Risposta_user["CognomeRel"]." della ".$Risposta_user["RSAzienda_fk"]."<br>";
                                }
                                else{
                                    echo "Utente non esistente";
                                    header("Location: ./destroyer_session.php");
                                    exit;
                                }
                            }
                            $queryTab= "SELECT FasciaOraria,Titolo,Argomento,IDSpeech FROM Relaziona,Programma,Speech WHERE Relaziona.IDProgramma_fk = Programma.IDProgramma AND Speech.IDSpeech = Programma.IDSpeech_fk AND Relaziona.IDRel_fk = ?";
                            $parametri=["i",$_SESSION['RelAnche']];
                            if($risultatoSpeech=Database::executeQuery($queryTab,$parametri,true)){
                                if (!($risultatoSpeech->num_rows) == 0){
                                    #controllo la query ha prodotto dei risultati
                                    $htmlmio=<<<XYZ
                                    <div>
                                        <table class='table'>
                                            <thead>
                                                <tr>
                                                    <th>Orario evento</th>
                                                    <th>Titolo</th>
                                                    <th>Argomento</th>
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
                                        echo "<tr>";
                                    }
                                    $htmlmio =<<<XYZ
                                            </tbody>
                                        </table>
                                    </div>
                                    XYZ;

                                }
                                else{
                                    echo "Non fai da relatore a nessun speech";
                                }
                            }
                        }
                    }
                    # Controllare se la sessione è attiva, in caso buttarlo fuori
                    # mostra i suoi dati e tutti i corsi e i corsi in cui è iscritto, in caso fosse anche relatore
                    # far vedere anche i suoi speech
                }
                else{
                    if (Database::connect()){
                        #Ottengo lista Speech con un bottone aggiungi
                        $queryTab="SELECT DISTINCT FasciaOraria,Titolo,Argomento,IDSpeech,NpostiSala,Numero,PostiRimasti,IDProgramma_fk FROM Sceglie,Programma,Speech,Sala,Piano,PostiRimastiPerFasciaOraria WHERE Sceglie.IDProgramma_fk = Programma.IDProgramma AND Speech.IDSpeech = Programma.IDSpeech_fk AND Programma.NomeSala_fk = Sala.NomeSala AND Sala.Numero_fk = Piano.Numero AND Sala.NomeSala = PostiRimastiPerFasciaOraria.NomeSalaView";
                            if($result=Database::executeQueryNormal($queryTab)){
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        // Recupero della data
                                        $Orario = $row["FasciaOraria"];
                
                                        // Recupero del relatore incaricato
                                        $queryRelatore = "SELECT Relatore.NomeRel, Relatore.CognomeRel FROM Relatore JOIN Relaziona ON Relatore.IDRel = Relaziona.IDRel_fk WHERE Relaziona.IDProgramma_fk = ?";
                                        $parametriRelatore=["i",$row["IDSpeech"]];
                                        $relatore_result = Database::executeQuery($queryRelatore,$parametriRelatore,true);
                                        $rowRelatore = $relatore_result->fetch_assoc();
                                        $htmlmio=<<<XYZ
                                        <div class='col-lg-3 col-md-4 col-sm-6 col-12 mb-4'>
                                            <div class="card h-75">
                                                <h5 class='card-title mb-0 text-center text-white bg-primary p-3'>{$row["Titolo"]}</h5>
                                                <hr class="mb-0 mt-0"></hr>
                                                <div class="card-body overflow-auto border-top">
                                                    <p class="card-text"><strong>Relatore:</strong> {$rowRelatore["NomeRel"]} {$rowRelatore["CognomeRel"]}</p>
                                                    <p class="card-text"><strong>Descrizione:</strong> {$row["Argomento"]}</p>
                                                    <p class="card-text"><strong>Orario:</strong> $Orario</p>
                                                    <p class="card-text"><strong>Sala:</strong> {$row["Numero"]}</p>
                                                    <p class="card-text"><strong>Posti disponibili:</strong> {$row["PostiRimasti"]}</p>
                                                </div>
                                                <hr class="mb-0 mt-0"></hr>
                                            </div>
                                        </div>
                                        XYZ;
                                        echo $htmlmio;
                                    }
                            } else {
                                echo "Nessun speech trovato";
                            }
                                
                        }
                    }
                }
            ?>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</html>
