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
        include_once("navbar.php");
    ?>
    
    <div class="container-fluid p-3">
        <?php
            //fare in modo di creare versione incognita con tutti gli speech
            if(is_NOTAnonymus()){
                Controllo_Utente();
                echo (intval($_COOKIE['Tempo_Sessione']) - time())."<br>";
                if (Database::connect()){
                    if(isPart()){
                        $queryTab= "SELECT FasciaOraria,Titolo,Argomento,IDSpeech,NpostiSala,Numero,PostiRimasti FROM Sceglie,Programma,Speech,Sala,Piano,PostiRimastiPerFasciaOraria WHERE Sceglie.IDProgramma_fk = Programma.IDProgramma AND Speech.IDSpeech = Programma.IDSpeech_fk AND Programma.NomeSala_fk = Sala.NomeSala AND Sala.Numero_fk = Piano.Numero AND Sala.NomeSala = PostiRimastiPerFasciaOraria.NomeSalaView AND Sceglie.IDPart_fk = ?";
                        $parametri=["i",$_SESSION['idPart']];
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
                                            <th>Piano</th>
                                            <th>Posti Rimasti</th>
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
                                        echo "<td>" . $Risposta_speech["PostiRimasti"] . "</td>";
                                        echo "<td><form action='Abbandona.php' method='POST'><input type='hidden' name='IdPart' value=".$_SESSION['idPart']." /><input type='hidden' name='QualeSpeech' value=".$Risposta_speech["IDSpeech"]." /><button type='submit' class='btn btn-danger'>Abbandona</button></form></td>";
                                    echo "<tr>";
                                }
                                $htmlmio =<<<XYZ
                                    </tbody>
                                </table>
                                XYZ;
                            }
                            else{
                                echo "Non partecipi a nessun speech";
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
                                    </tr>
                                </thead>
                                <tbody> 
                            XYZ;
                            echo $htmlmio;
                            while($Risposta_speech=mysqli_fetch_array($risultatoSpeech)) {
                                $postiRimasti=$Risposta_speech["NpostiSala"]-$Risposta_speech["PostiRimasti"];
                                echo "<tr>";
                                    echo "<td>" . $Risposta_speech["FasciaOraria"] . "</td>";
                                    echo "<td>" . $Risposta_speech["Titolo"] . "</td>";
                                    echo "<td>" . $Risposta_speech["Argomento"] . "</td>";
                                    echo "<td>" . $Risposta_speech["Numero"] . "</td>";
                                    echo "<td>" .$Risposta_speech["PostiRimasti"]. "</td>"; #aggiungere vista che permetta di vedere quanti posti rimangono, in caso non ci fosserò più posti diventa grigio
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
        ?>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</html>
