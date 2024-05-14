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
    <a href='admin.php'><button class='btn btn-primary mb-2'>Indietro</button></a>
    <div class="row">
        <div class="col">
            <h5 class='card-title p-2 text-center p-3'>titolo x</h5>
        </div>
    </div>
        <?php
        if (Database::connect()){
            if(Controllo_Cookie(true) && Controllo_Utente() && isset($_REQUEST["Programma"])){
                RefreshTempo();
                $queryTab= "SELECT IDPart, NomePart, CognomePart, TipologiaPart, Mail, IDSpeech_fk FROM Programma JOIN Sceglie ON Programma.IDProgramma = Sceglie.IDProgramma_fk LEFT JOIN Partecipante ON Sceglie.IDPart_fk = Partecipante.IDPart LEFT JOIN User ON Partecipante.IDPart = User.IDPart_fk WHERE Programma.IDProgramma = ?";
                $parametri=["i",$_REQUEST["Programma"]];
                if($risultatoSpeech=Database::executeQuery($queryTab,$parametri,true)){
                    if (!($risultatoSpeech->num_rows) == 0){
                        #controllo la query ha prodotto dei risultati
                        $htmlmio=<<<XYZ
                        <table class='table'>
                            <thead>
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
                                echo "<td><form action='Abbandona.php?who=Admin' method='POST'><input type='hidden' name='IdPart' value=".$Risposta_speech['IDPart']." /><input type='hidden' name='QualeSpeech' value=".$Risposta_speech["IDSpeech_fk"]." /><button type='submit' class='btn btn-danger'>Elimina</button></form></td>";
                            echo "<tr>";
                        } 
                        $htmlmio =<<<XYZ
                            </tbody>
                        </table>
                        XYZ;
                        echo $htmlmio;
                    }
                    else{
                        echo "Non c'è nessun partecipante";
                    }
                }
            }
        }
        ?>
    </div>
</body>
</html>