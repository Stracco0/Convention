<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php
        include "Database.php";
        include "utilitis.php";
        Controllo_Cookie();
        session_start();
        Controllo_Utente();
        echo (intval($_COOKIE['Tempo_Sessione']) - time())."<br>";
        if (Database::connect()){
            #Ottengo id del partecipante
            $queryTab= "SELECT NomePart,CognomePart FROM Partecipante WHERE IDPart = ?";
            $parametri=["i",$_SESSION['idUser']];
            if($risultatoUser=Database::executeQuery($queryTab,$parametri,true)){
                if (($risultatoUser->num_rows) == 1){
                    #controllo se l'id dell'utente esiste
                    $Risposta_user=$risultatoUser->fetch_assoc();
                    echo "Benvenuto ".$Risposta_user["NomePart"]." ".$Risposta_user["CognomePart"]."<br>";
                }
                else{
                    echo "Utente non esistente";
                    header("Location: ./destroyer_session.php");
                    exit;
                }
            }
            $queryTab= "SELECT FasciaOraria,Titolo,Argomento,IDSpeech FROM Sceglie,Programma,Speech WHERE Sceglie.IDProgramma_fk = Programma.IDProgramma AND Speech.IDSpeech = Programma.IDSpeech_fk AND Sceglie.IDPart_fk = ?";
            $parametri=["i",$_SESSION['idUser']];
            if($risultatoSpeech=Database::executeQuery($queryTab,$parametri,true)){
                $htmlmio=<<<XYZ
                <div class="row">
                    <div class="col text-end">
                        <form action="AggiungiSpeech.php" method="post">
                            <button class="btn btn-secondary" type="submit">Aggiungi Speech</button>
                        </form>
                    </div>
                </div>
                XYZ;
                echo $htmlmio;
                if (!($risultatoSpeech->num_rows) == 0){
                    #controllo la query ha prodotto dei risultati
                    $htmlmio=<<<XYZ
                    <table class='table'>
                        <thead>
                            <tr>
                                <th>Orario evento</th>
                                <th>Titolo</th>
                                <th>Argomento</th>
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
                            echo "<td><form action='AbbandonaSpeech.php' method='POST'><input type='hidden' name='QualeSpeech' value=".$Risposta_speech["IDSpeech"]." /><button type='submit' class='btn btn-danger'>Abbandona</button></form></td>";
                        echo "<tr>";
                    }
                    $htmlmio =<<<XYZ
                        </tbody>
                    </table>
                    XYZ;
                }
                else{
                    echo "Non sei iscritto a nessuno speech";
                }
            }
        }
        # Controllare se la sessione è attiva, in caso buttarlo fuori
        # mostra i suoi dati e tutti i corsi e i corsi in cui è iscritto, in caso fosse anche relatore
        # far vedere anche i suoi speech
    ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</html>