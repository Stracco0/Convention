<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php
    include "Database.php";
    include "utilitis.php";
    include_once("dependences.php");
    $where="Admin";
    include_once("navbar.php");
    ?>
    <div class="container-fluid p-3">
    <a href='admin.php'><button class='btn btn-primary mb-2'><i class='fas fa-arrow-left'></i></button></a>
        <?php
        if (Database::connect()){
            if(Controllo_Cookie(true) && Controllo_Utente() && isset($_REQUEST["Programma"])){
                RefreshTempo();
                $queryTab= "SELECT Speech.Titolo AS TitoloSpeech FROM Programma JOIN Speech ON Programma.IDSpeech_fk = Speech.IDSpeech WHERE Programma.IDProgramma = ?";
                $parametri=["i",$_REQUEST["Programma"]];
                if($risultatoTitolo=Database::executeQuery($queryTab,$parametri,true)){
                    if (!($risultatoTitolo->num_rows) == 0){
                        $Risposta_speech2=$risultatoTitolo->fetch_assoc();
                        $htmlmio=<<<XYZ
                            <div class="row">
                                <div class="col">
                                    <h2 class='card-title p-2 text-center p-3'>{$Risposta_speech2["TitoloSpeech"]}</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <h5 class='card-title p-2 text-center p-3'>Partecipanti</h5>
                                </div>
                            </div>
                            <div class="col text-end mb-3 pr-0">
                                <form action="AggiungiPersonal.php" method="post">
                                    <button class="btn btn-secondary" type="submit"><i class="fas fa-plus"></i> Aggiungi Partecipanti</button>
                                </form>
                            </div>
                        XYZ;
                        echo $htmlmio;
                    }
                }

                $queryTab= "SELECT IDPart, NomePart, CognomePart, TipologiaPart, Mail, IDSpeech_fk FROM Programma JOIN Sceglie ON Programma.IDProgramma = Sceglie.IDProgramma_fk LEFT JOIN Partecipante ON Sceglie.IDPart_fk = Partecipante.IDPart LEFT JOIN User ON Partecipante.IDPart = User.IDPart_fk WHERE Programma.IDProgramma = ?";
                $parametri=["i",$_REQUEST["Programma"]];
                if($risultatoSpeech=Database::executeQuery($queryTab,$parametri,true)){
                    if (!($risultatoSpeech->num_rows) == 0){
                        #controllo la query ha prodotto dei risultati
                        $htmlmio=<<<XYZ
                        <div class="card">
                            <table class='table mb-0'>
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nome</th>
                                        <th>Cognome</th>
                                        <th>Email</th>
                                        <th>Tipologia</th>
                                        <th>Azioni</th>
                                    </tr>
                                </thead>
                                <tbody> 
                        XYZ;
                        echo $htmlmio;
                        while($Risposta_speech=mysqli_fetch_array($risultatoSpeech)) {
                            if ($Risposta_speech["Mail"]==""){
                                $maill="Non disponibile";
                            }
                            else{
                                $maill=$Risposta_speech["Mail"];
                            }
                            echo "<tr>";
                                echo "<td>" . $Risposta_speech["NomePart"] . "</td>";
                                echo "<td>" . $Risposta_speech["CognomePart"] . "</td>";
                                echo "<td>" . $maill . "</td>";
                                echo "<td>" . $Risposta_speech["TipologiaPart"] . "</td>";
                                echo "<td><form action='Abbandona.php?who=Admin' method='POST'><input type='hidden' name='IdPart' value=".$Risposta_speech['IDPart']." /><input type='hidden' name='QualeSpeech' value=".$Risposta_speech["IDSpeech_fk"]." /><button onClick=\"javascript: return confirm('Sicuro?');\" type='submit' class='btn btn-danger' title='Elimina Partecipante dallo Speech'><i class='fas fa-trash-alt'></i></button></form></td>";
                            echo "<tr>";
                        } 
                        $htmlmio =<<<XYZ
                                </tbody>
                            </div>
                        </table>
                        </div>
                        XYZ;
                        echo $htmlmio;
                    }
                    else{
                        echo "Non c'è nessun partecipante";
                    }
                }
            }




            if(Controllo_Cookie(true) && Controllo_Utente() && isset($_REQUEST["Programma"])){
                RefreshTempo();
                
                $Risposta_speech2=$risultatoTitolo->fetch_assoc();
                $htmlmio=<<<XYZ
                    <div class="row mt-5">
                        <div class="col">
                            <h5 class='card-title p-2 text-center p-3'>Relatori</h5>
                        </div>
                    </div>
                    <div class="col text-end mb-3 pr-0">
                        <form action="AggiungiPersonal.php" method="post">
                            <button class="btn btn-secondary" type="submit"><i class="fas fa-plus"></i> Aggiungi Relatori</button>
                        </form>
                    </div>
                XYZ;
                echo $htmlmio;

                $queryTab= "SELECT Relaziona.IDRel_fk,NomeRel,CognomeRel,RSAzienda_fk,Mail,IDSpeech_fk FROM Programma JOIN Relaziona ON Programma.IDProgramma = Relaziona.IDProgramma_fk LEFT JOIN Relatore ON Relaziona.IDRel_fk = Relatore.IDRel LEFT JOIN User ON Relatore.IDRel = User.IDRel_fk WHERE Programma.IDProgramma = ?";
                $parametri=["i",$_REQUEST["Programma"]];
                if($risultatoSpeech=Database::executeQuery($queryTab,$parametri,true)){
                    if (!($risultatoSpeech->num_rows) == 0){
                        #controllo la query ha prodotto dei risultati
                        $htmlmio=<<<XYZ
                        <div class="card">
                            <table class='table mb-0'>
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nome</th>
                                        <th>Cognome</th>
                                        <th>Email</th>
                                        <th>Azienda</th>
                                        <th>Azioni</th>
                                    </tr>
                                </thead>
                                <tbody> 
                        XYZ;
                        echo $htmlmio;
                        while($Risposta_speech=mysqli_fetch_array($risultatoSpeech)) {
                            if ($Risposta_speech["Mail"]==""){
                                $maill="Non disponibile";
                            }
                            else{
                                $maill=$Risposta_speech["Mail"];
                            }
                            echo "<tr>";
                                echo "<td>" . $Risposta_speech["NomeRel"] . "</td>";
                                echo "<td>" . $Risposta_speech["CognomeRel"] . "</td>";
                                echo "<td>" . $maill . "</td>";
                                echo "<td>" . $Risposta_speech["RSAzienda_fk"] . "</td>";
                                echo "<td><form action='killRel.php' method='POST'><input type='hidden' name='IdPart' value=".$Risposta_speech['IDRel_fk']." /><input type='hidden' name='QualeSpeech' value=".$Risposta_speech["IDSpeech_fk"]." /><button onClick=\"javascript: return confirm('Sicuro?');\" type='submit' class='btn btn-danger' title='Elimina Relatore dallo Speech'><i class='fas fa-trash-alt'></i></button></form></td>";
                            echo "<tr>";
                        } 
                        $htmlmio =<<<XYZ
                                </tbody>
                            </div>
                        </table>
                        XYZ;
                        echo $htmlmio;
                    }
                    else{
                        echo "Non c'è nessun relatore";
                    }
                }
            }
            
        }
        ?>
    </div>
</body>
</html>