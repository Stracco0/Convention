<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zona Admin</title>
    <?php include "dependencies.php"; ?>
    <style>
        iframe {
            display:block;
            width:  100% !important;
            height: 100% ;
        }
    </style>
</head>
<body>
    <?php
        include "Database.php";
        include "utilitis.php";
        $returnto1="admin.php";
        $returnto2="admin.php";
        $where="Admin";
        include_once("navbar.php");
    ?>
    <div class="container-fluid p-3">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            <?php
                if(Controllo_Cookie(true) && Controllo_Utente()){
                    if (Database::connect()){
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
                                    <div class='col'>
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
                                                <td><form action='Partecipanti.php' method='POST'><input type='hidden' name='Titolo' value={$row["Titolo"]} /><input type='hidden' name='Programma' value={$row["IDProgramma_fk"]} /><button type='submit' class='btn btn-primary'>Visualizza Partecipanti</button></form></td>
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
                            Database::disconnect();
                        }
                    }
                }
            ?>
        </div> <!-- Chiudi row -->
    </div>
</body>
</html>
