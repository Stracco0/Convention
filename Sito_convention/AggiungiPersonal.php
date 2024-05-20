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
            $returnto1="Partecipanti.php?Programma=".$_REQUEST["programma"];
            $returnto2="AggiungiPersonal.php";
            include_once("navbar.php");
    ?>
    <div class="container-fluid p-3">
        <?php
                echo "<a href=Partecipanti.php?Programma=".$_REQUEST["programma"]."><button class='btn  btn-primary mb-2'><i class='fas fa-arrow-left'></i></button></a>";
                if(Controllo_Utente_admin()){
                    if ($_REQUEST["who"]=="part"){
                        #l'utente ha cliccato ed è autenticato quindi aggiorno tempo sessione
                        RefreshTempo();
                        if (Database::connect()){
                            #Ottengo lista Speech con un bottone aggiungi
                            $queryTab= "SELECT * FROM Partecipante";
                            if($risultatoSpeech=Database::executeQueryNormal($queryTab)){
                                if (!($risultatoSpeech->num_rows) == 0){
                                    #controllo la query ha prodotto dei risultati
                                    $htmlmio=<<<XYZ
                                    <div class="row">
                                        <div class="col">
                                            <h2 class='card-title p-2 text-center p-3'>Partecipanti Disponibili</h2>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <table class='table mb-0'>
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Nome</th>
                                                    <th>Cognome</th>
                                                    <th>Tipologia</th>
                                                    <th>Azioni</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                    XYZ;
                                    echo $htmlmio;
                                    while($Risposta_speech=mysqli_fetch_array($risultatoSpeech)) {
                                        echo "<tr>";
                                            echo "<td>" . $Risposta_speech["NomePart"] . "</td>";
                                            echo "<td>" . $Risposta_speech["CognomePart"] . "</td>";
                                            echo "<td>" . $Risposta_speech["TipologiaPart"] . "</td>";
                                            echo "<td><form action='Aggiungi.php?who=admin' method='POST'><input type='hidden' name='IdPart' value=".$Risposta_speech['IDPart']." /><input type='hidden' name='QualeSpeech' value=".$_REQUEST["programma"]." /><button title='Iscrivi' type='submit' class='btn btn-secondary'><i class='fas fa-plus'></i></button></form></td>";
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
                    }elseif ($_REQUEST["who"]=="rel") {
                        #l'utente ha cliccato ed è autenticato quindi aggiorno tempo sessione
                        RefreshTempo();
                        if (Database::connect()){
                            #Ottengo lista Speech con un bottone aggiungi
                            $queryTab= "SELECT * FROM Relatore";
                            if($risultatoSpeech=Database::executeQueryNormal($queryTab)){
                                if (!($risultatoSpeech->num_rows) == 0){
                                    #controllo la query ha prodotto dei risultati
                                    $htmlmio=<<<XYZ
                                    <div class="row">
                                        <div class="col">
                                            <h2 class='card-title p-2 text-center p-3'>Relatori Disponibili</h2>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <table class='table mb-0'>
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Nome</th>
                                                    <th>Cognome</th>
                                                    <th>Azienda</th>
                                                    <th>Azioni</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                    XYZ;
                                    echo $htmlmio;
                                    while($Risposta_speech=mysqli_fetch_array($risultatoSpeech)) {
                                        echo "<tr>";
                                            echo "<td>" . $Risposta_speech["NomeRel"] . "</td>";
                                            echo "<td>" . $Risposta_speech["CognomeRel"] . "</td>";
                                            echo "<td>" . $Risposta_speech["RSAzienda_fk"] . "</td>";
                                            echo "<td><form action='aggiungirel.php' method='POST'><input type='hidden' name='IdRel' value=".$Risposta_speech['IDRel']." /><input type='hidden' name='QualeSpeech' value=".$_REQUEST["programma"]." /><button title='Iscrivi' type='submit' class='btn btn-secondary'><i class='fas fa-plus'></i></button></form></td>";
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
                }
                else{
                    Database::disconnect();
                    header("Location: ./destroyer_session.php");
                    exit;
                }
                if($_REQUEST["user"]=="AlreadyExists"){
                    alert("è già iscritto a questo evento");          
                }
                function alert($msg) {
                    echo "<script type='text/javascript'>alert('$msg');</script>";
                }
        ?>
    </div>
</body>
</html>
