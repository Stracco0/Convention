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
            if(!is_NOTAnonymus()){
                $htmlmio=<<<XYZ
                    <div class="row">
                        <div class="col">
                            <h5 class='card-title p-2 text-center p-3'>SPEECH DISPONIBILI</h5>
                        </div>
                    </div>
                XYZ;
                echo $htmlmio;
                echo '<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">';
            }
            elseif(isPart() && !isArel()){
                $htmlmio=<<<XYZ
                    <div class="row">
                        <div class="col">
                            <h2 class='card-title p-2 text-center p-3'>PARTECEPI IN</h2>
                        </div>
                    </div>
                    <div class="col text-end pr-0 mb-3">
                        <form action="AggiungiSpeech.php" method="post">
                            <button class="btn btn-secondary" type="submit"><i class="fas fa-plus"></i> Aggiungi Speech</button>
                        </form>
                    </div>
                XYZ;
                echo $htmlmio;
            }
            elseif(!isPart() && isArel()){
                $htmlmio=<<<XYZ
                    <div class="row">
                        <div class="col">
                            <h2 class='card-title p-2 text-center p-3'>FAI DA RELATORE IN</h2>
                        </div>
                    </div>
                XYZ;
                echo $htmlmio;
            }
            

        ?>
            <?php
                //fare in modo di creare versione incognita con tutti gli speech
                if(is_NOTAnonymus()){
                    Controllo_Utente();
                    if (Database::connect()){
                        if(isPart() && !isArel()){
                            $htmlmio=<<<XYZ
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
                                                <div class="row p-2">
                                                    <div class="col text-end">
                                                        <form action="Abbandona.php" method="post"><input type="hidden" name="QualeSpeech" value={$row["IDSpeech"]}><input type="hidden" name="IdPart" value={$_SESSION['idPart']}><button title="Abbandona Speech" onClick="javascript: return confirm('Sicuro di voler abbandonare lo Speech?');" class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button></form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        XYZ;
                                        echo $htmlmio;
                                    }
                                } else {
                                    $htmlmio=<<<XYZ
                                        <div class="col-12">
                                            <div class="row">
                                                <h5 class='card-title p-2 text-center p-3'>NON PARTECIPI A NESSUNO SPEECH</h5>
                                            </div>
                                        </div>
                                    XYZ;
                                    echo $htmlmio;
                                }
                            }
                        }
                        if(!isPart() && isArel()){
                            #Ottengo id del relatore
                            $htmlmio=<<<XYZ
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                            XYZ;
                            echo $htmlmio;
                            $queryTab= "SELECT Programma.FasciaOraria, Speech.Titolo, Speech.Argomento, Speech.IDSpeech, Sala.NpostiSala, Piano.Numero, PostiRimastiPerFasciaOraria.PostiRimasti, Programma.IDProgramma, Relatore.NomeRel, Relatore.CognomeRel FROM Relaziona JOIN Programma ON Relaziona.IDProgramma_fk = Programma.IDProgramma JOIN Speech ON Programma.IDSpeech_fk = Speech.IDSpeech JOIN Sala ON Programma.NomeSala_fk = Sala.NomeSala JOIN Piano ON Sala.Numero_fk = Piano.Numero JOIN PostiRimastiPerFasciaOraria ON Sala.NomeSala = PostiRimastiPerFasciaOraria.NomeSalaView AND Programma.IDProgramma = PostiRimastiPerFasciaOraria.IDProgrammaView JOIN Relatore ON Relaziona.IDRel_fk = Relatore.IDRel WHERE Relatore.IDRel = ?";
                            $parametri=["i",$_SESSION['RelAnche']];
                            if($result=Database::executeQuery($queryTab,$parametri,true)){
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        $Orario = $row["FasciaOraria"];
                                        $htmlmio=<<<XYZ
                                        <div class='col-lg-3 col-md-4 col-sm-6 col-12 mb-4'>
                                            <div class="card h-75">
                                                <h5 class='card-title mb-0 text-center text-white bg-primary p-3'>{$row["Titolo"]}</h5>
                                                <hr class="mb-0 mt-0"></hr>
                                                <div class="card-body overflow-auto border-top">
                                                    <p class="card-text"><strong>Relatore:</strong> {$row["NomeRel"]} {$row["CognomeRel"]}</p>
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
                                    $htmlmio=<<<XYZ
                                        <div class="col-12">
                                            <div class="row">
                                                <h5 class='card-title p-2 text-center p-3'>NON RELAZIONI NESSUNO SPEECH</h5>
                                            </div>
                                        </div>
                                    XYZ;
                                    echo $htmlmio;
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
                                Database::disconnect();
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
