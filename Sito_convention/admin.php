<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zona Admin</title>
</head>
<body>
    <?php
        include "Database.php";
        include "utilitis.php";
        $returnto1="admin.php";
        $returnto2="admin.php";
        $where="Admin";
        include_once("navbar.php");
        Controllo_Cookie(false);
        Controllo_Utente_admin();
        if ($_REQUEST["confirmer"]=="errormodprogramma"){
            echo "<div class=' m-2 alert alert-danger' role='alert'>Programma non modificato, SOVRAPPOSIZIONE!</div>";
        }
        if ($_REQUEST["confirmer"]=="erroraddprogramma"){
            echo "<div class=' m-2 alert alert-danger' role='alert'>Programma non aggiunto, SOVRAPPOSIZIONE!</div>";
        }
        if ($_REQUEST["confirmer"]=="delProgramma"){
            echo "<div class=' m-2 alert alert-danger' role='alert'>Programma eliminato!</div>";
        }
        if ($_REQUEST["confirmer"]=="modifyProgramma"){
            echo "<div class=' m-2 alert alert-success' role='alert'>Programma modificato!</div>";
        }
        if ($_REQUEST["confirmer"]=="addedProgramma"){
            echo "<div class=' m-2 alert alert-primary' role='alert'>Programma aggiunto!</div>";
        }
        if ($_REQUEST["confirmer"]=="modifiedSpeech"){
            echo "<div class=' m-2 alert alert-success' role='alert'>Speech modificato!</div>";
        }
        if ($_REQUEST["confirmer"]=="addedSpeech"){
            echo "<div class=' m-2 alert alert-primary' role='alert'>Speech aggiunto!</div>";
        }
        if ($_REQUEST["confirmer"]=="delPart"){
            echo "<div class=' m-2 alert alert-danger' role='alert'>Partecipante eliminato!</div>";
        }
        if ($_REQUEST["confirmer"]=="modifiedPart"){
            echo "<div class=' m-2 alert alert-success' role='alert'>Partecipante modificato!</div>";
        }
        if ($_REQUEST["confirmer"]=="addedPart"){
            echo "<div class=' m-2 alert alert-primary' role='alert'>Partecipante aggiunto!</div>";
        }
        if ($_REQUEST["confirmer"]=="delAzienda"){
            echo "<div class=' m-2 alert alert-danger' role='alert'>Azienda eliminata!</div>";
        }
        if ($_REQUEST["confirmer"]=="modifiedAzienda"){
            echo "<div class=' m-2 alert alert-success' role='alert'>Azienda modificata!</div>";
        }
        if ($_REQUEST["confirmer"]=="addedAzienda"){
            echo "<div class=' m-2 alert alert-primary' role='alert'>Azienda aggiunta!</div>";
        }
        if ($_REQUEST["confirmer"]=="addedRel"){
            echo "<div class=' m-2 alert alert-primary' role='alert'>Relatore aggiunto!</div>";
        }
        if ($_REQUEST["confirmer"]=="modifiedRel"){
            echo "<div class=' m-2 alert alert-success' role='alert'>Relatore modificato!</div>";
        }
        if ($_REQUEST["confirmer"]=="delRel"){
            echo "<div class=' m-2 alert alert-danger' role='alert'>Relatore eliminato!</div>";
        }
    ?>
    <div class="container-fluid p-3">
        <div class="row"><h2 class='card-title p-2 text-center p-3'>Azioni Disponibili</h2></div>
        <div class="row justify-content-center text-center">
            <div class="col-md-2 mb-3">
                <div class="card">
                    <div class="card-header text-center bg-primary text-white">
                        <h3 class="mb-0">Aggiungi</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column">
                            <a href="adduser.php" class="btn btn-outline-primary mb-2">Utente</a>
                            <a href="choose.php?who=rel&action=add" class="btn btn-outline-primary mb-2">Relatore</a>
                            <a href="addAzienda.php" class="btn btn-outline-primary mb-2">Azienda</a>
                            <a href="choose.php?who=part&action=add" class="btn btn-outline-primary mb-2">Partecipante</a>
                            <a href="addSpeech.php?action=add" class="btn btn-outline-primary mb-2">Speech</a>
                            <!-- form per istanziare uno speech -->
                            <a href="choose.php?who=programma&action=add" class="btn btn-outline-primary mb-2">Programma</a>
                            <!-- form per istanziare una programma con select dello speech e sala a cui associarlo -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <div class="card">
                    <div class="card-header text-center bg-success text-white">
                        <h3 class="mb-0">Modifica</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column">
                            <a href="choose.php?who=user&action=modify" class="btn btn-outline-success mb-2">Utente</a>
                            <a href="choose.php?who=rel&action=modify" class="btn btn-outline-success mb-2">Relatore</a>
                            <a href="choose.php?who=azienda&action=modify" class="btn btn-outline-success mb-2">Azienda</a>
                            <a href="choose.php?who=part&action=modify" class="btn btn-outline-success mb-2">Partecipante</a>
                            <a href="choose.php?who=speech&action=modify" class="btn btn-outline-success mb-2">Speech</a>
                            <a href="choose.php?who=programma&action=modify" class="btn btn-outline-success mb-2">Programma</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <div class="card">
                    <div class="card-header text-center bg-danger text-white">
                        <h3 class="mb-0">Elimina</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column">
                            <a href="choose.php?who=user&action=delete" class="btn btn-outline-danger mb-2">Utente</a>
                            <a href="choose.php?who=rel&action=delete" class="btn btn-outline-danger mb-2">Relatore</a>
                            <a href="choose.php?who=azienda&action=delete" class="btn btn-outline-danger mb-2">Azienda</a>
                            <a href="choose.php?who=part&action=delete" class="btn btn-outline-danger mb-2">Partecipante</a>
                            <a href="choose.php?who=programma&action=delete" class="btn btn-outline-danger mb-2">Programma</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h2 class='card-title p-2 text-center p-3'>Speech Disponibili</h2>
            </div>
        </div>
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
                                    if($relatore_result->num_rows > 1){
                                        $isplural="i";
                                        $relatori="";
                                        while($rowRelatore = $relatore_result->fetch_assoc()){
                                            $relatori=$relatori.$rowRelatore["NomeRel"]." ".$rowRelatore["CognomeRel"].", ";
                                        }
                                    }else{
                                        $rowRelatore = $relatore_result->fetch_assoc();
                                        $isplural="e";
                                        $relatori=$rowRelatore["NomeRel"]." ".$rowRelatore["CognomeRel"];
                                    }
                                    $htmlmio=<<<XYZ
                                    <div class='col-lg-3 col-md-4 col-sm-6 col-12 mb-4'>
                                        <div class="card h-75">
                                            <h5 class='card-title mb-0 text-center text-white bg-primary p-3'>{$row["Titolo"]}</h5>
                                            <hr class="mb-0 mt-0"></hr>
                                            <div class="card-body overflow-auto border-top">
                                                <p class="card-text"><strong>Relator{$isplural}:</strong> {$relatori}</p>
                                                <p class="card-text"><strong>Descrizione:</strong> {$row["Argomento"]}</p>
                                                <p class="card-text"><strong>Orario:</strong> $Orario</p>
                                                <p class="card-text"><strong>Sala:</strong> {$row["Numero"]}</p>
                                                <p class="card-text"><strong>Posti disponibili:</strong> {$row["PostiRimasti"]}</p>
                                            </div>
                                            <hr class="mb-0 mt-0"></hr>
                                            <div class="row p-2">
                                                <div class="col text-center">
                                                <td><form action='Partecipanti.php' method='POST'><input type='hidden' name='Titolo' value={$row["Titolo"]} /><input type='hidden' name='Programma' value={$row["IDProgramma_fk"]} /><button type='submit' class='btn btn-primary'><i class="fas fa-eye"></i> Visualizza Partecipanti</button></form></td>
                                                </div>
                                                <div class="col">
                                                </div>
                                                <div class="col text-end">
                                                    <form action='EliminaSpeech.php' method='POST'>
                                                        <input type='hidden' name='IDSpeech' value={$row["IDSpeech"]}>
                                                            <button type='submit' onClick="javascript: return confirm('Sicuro di voler eliminare lo Speech?');" title="Elimina Speech" class="btn btn-danger">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                    </form>
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
