<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <a href="index.php"><button class='btn btn-primary'>Indietro</button></a>
    
    <?php
            include "Database.php";
            include "utilitis.php";
            Controllo_Cookie(false);
            session_start();
            if(Controllo_Utente()){
                #l'utente ha cliccato ed è autenticato quindi aggiorno tempo sessione
                RefreshTempo();
                if (Database::connect()){
                    #Ottengo lista Speech con un bottone aggiungi
                    $queryTab= "SELECT DISTINCT FasciaOraria,Titolo,Argomento,IDSpeech,NpostiSala,Numero FROM Sceglie,Programma,Speech,Sala,Piano WHERE Sceglie.IDProgramma_fk = Programma.IDProgramma AND Speech.IDSpeech = Programma.IDSpeech_fk AND Programma.NomeSala_fk = Sala.NomeSala AND Sala.Numero_fk = Piano.Numero";
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
                                    echo "<td>" ."?/". $Risposta_speech["NpostiSala"] . "</td>"; #aggiungere vista che permetta di vedere quanti posti rimangono, in caso non ci fosserò più posti diventa grigio
                                    echo "<td><form action='Aggiungi.php' method='POST'><input type='hidden' name='IdPart' value=".$_SESSION['idPart']." /><input type='hidden' name='QualeSpeech' value=".$Risposta_speech["IDSpeech"]." /><button type='submit' class='btn btn-secondary'>Aggiungi</button></form></td>";
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
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</html>
