<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Speech</title>
</head>
<body>
    <?php
        include "./Database.php";
        include "./utilitis.php";
        $returnto1="./admin.php";
        $returnto2="./admin.php";
        $where="Admin";
        include_once("./navbar.php");
        Controllo_Cookie(false);
        Controllo_Utente_admin();
        if(Controllo_Utente() && $_SESSION["mail_user"]=="admin@admin.com"){
            RefreshTempo();
        }
    ?>
    <div class="container-fluid p-3">
        <a href="admin.php"><button class='btn btn-primary mb-2'><i class='fas fa-arrow-left'></i></button></a>
    </div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php
                if (Database::connect()){
                    if($_POST["action2"]=="add"){
                        $idSpeech=$_POST["entitySpeech"];
                        $idSala=$_POST["entitySala"];
                        echo '<div class="card">';
                            echo '<div class="card-header text-center">';
                                echo '<h3 class="mb-0">Aggiungi il programma</h3>';
                            echo '</div>';
                        echo '<div class="card-body">';
                        $miohtml=<<<XYZ
                                <form action="Aggiungi_entita.php" method="post">
                                    <div class="mb-3">
                                        <label for="orar" class="form-label">Fascia oraria</label>
                                        <input type="time" class="form-control" id="orar" name="orar" required>
                                    </div>
                                    <input type="hidden" name="entity" value="programma">
                                    <input type="hidden" name="idSpeech" value={$idSpeech}>
                                    <input type="hidden" name="idSala" value={$idSala}>
                        XYZ;
                        echo $miohtml;
                        echo '<div class="text-center">
                                <button type="submit" class="btn btn-primary w-100">Aggiungi il Programma</button>
                            </div>';
                        echo '</form>
                            </div>
                        </div>';
                    }
                    if($_POST["action2"]=="modify"){
                        $queryTab="SELECT Sala.NomeSala FROM Sala JOIN PostiRimastiPerFasciaOraria ON Sala.NomeSala = PostiRimastiPerFasciaOraria.NomeSalaView WHERE PostiRimastiPerFasciaOraria.PostiRimasti > 0";
                        $risultatoSala=Database::executeQueryNormal($queryTab);
                        $queryTab= "SELECT IDSpeech AS id, Titolo AS totnome FROM Speech";
                        $risultatoSpeech=Database::executeQueryNormal($queryTab);
                        $idProgramma=$_POST["entity"];
                        $queryTab= "SELECT IDProgramma,FasciaOraria,IDSpeech_fk,NomeSala_fk FROM Programma WHERE IDProgramma = ?";
                        $parametri=["i",$_POST["entity"]];
                        if($result2=Database::executeQuery($queryTab,$parametri,true)){
                            $result2=$result2->fetch_assoc();
                            echo '<div class="card">';
                                echo '<div class="card-header text-center">';
                                    echo '<h3 class="mb-0">Modifica il Programma</h3>';
                                echo '</div>';
                            echo '<div class="card-body">';
                            $miohtml=<<<XYZ
                                    <form action="Modifica_entita.php" method="post">
                                        <div class="mb-3">
                                            <label for="nome" class="form-label">FasciaOraria</label>
                                            <input value={$result2["FasciaOraria"]} type="time" class="form-control" id="nome" name="orar" required>
                                        </div>
                                        <input type="hidden" name="entity" value="programma">
                                        <input type="hidden" name="idProgramma" value={$idProgramma}>
                            XYZ;
                            echo $miohtml;
                            echo '<label for="utente">Sala:</label>';
                            echo '<select class="form-control" id="utente" name="entitySala" required>';
                            echo '<option value="">-- Seleziona --</option>';
                            while($risultatoSala=mysqli_fetch_array($risultatoSala)){
                                echo '<option value='.$risultatoSala["NomeSala"].'>'.$risultatoSala["NomeSala"].'</option>';
                            }
                            echo '</select>';
                            echo '<label for="utente">Speech:</label>';
                            echo '<select class="form-control" id="utente" name="entitySpeech" required>';
                            echo '<option value="">-- Seleziona --</option>';
                            while($Risposta1=mysqli_fetch_array($risultato)){
                                echo '<option value='.$Risposta1["id"].'>'.$Risposta1["totnome"].'</option>';
                            }
                            echo '</select>';
                            echo '<div class="text-center">
                                    <button type="submit" class="btn btn-success w-100">Modifica il Programma</button>
                                </div>';
                            echo '</form>
                                </div>
                            </div>';
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
