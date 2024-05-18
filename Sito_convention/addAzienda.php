<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Azienda</title>
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
                if($_POST["action2"]=="modify" || $_REQUEST["returnto"]=="modify"){
                    $queryTab= "SELECT Nome, IndirizzoAzienda, TelefonoAzienda, RagioneSocialeAzienda FROM Azienda WHERE RagioneSocialeAzienda = ?";
                    $parametri=["s",$_POST["entity"]];
                    if($result2=Database::executeQuery($queryTab,$parametri,true)){
                        $result2=$result2->fetch_assoc();
                        echo '<div class="card">';
                            echo '<div class="card-header text-center">';
                                echo '<h3 class="mb-0">Modifica l\'Azienda</h3>';
                            echo '</div>';
                        echo '<div class="card-body">';
                        if($_REQUEST["message"]=="ModifySuccesfull"){
                            echo "<div class='alert alert-success' role='alert'>Azienda modificata!</div>";
                        }
                        $miohtml=<<<XYZ
                                    <form action="Modifica_entita.php" method="post">
                                        <div class="mb-3">
                                            <label for="nome" class="form-label">Nome</label>
                                            <input type="text" value={$result2["Nome"]} class="form-control" id="nome" name="Nome" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="indirizzo" class="form-label">Indirizzo Azienda</label>
                                            <input type="text" value={$result2["IndirizzoAzienda"]} class="form-control" id="indirizzo" name="Indirizzo" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="telefonoAzienda" class="form-label">Telefono Aziendale</label>
                                            <input type="text" value={$result2["TelefonoAzienda"]} class="form-control" id="telefonoAzienda" name="telefonoAzienda" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="RSA" class="form-label">RagioneSocialeAzienda</label>
                                            <input type="text" value={$result2["RagioneSocialeAzienda"]} class="form-control" id="RSA" name="RSA" required>
                                        </div>
                                        <input type="hidden" name="entity" value="azienda">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success w-100">Modifica Azienda</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        XYZ;
                        echo $miohtml;
                    }
                }else{
                    echo '<div class="card">';
                        echo '<div class="card-header text-center">';
                            echo '<h3 class="mb-0">Aggiungi l\'Azienda</h3>';
                        echo '</div>';
                    echo '<div class="card-body">';
                    if($_REQUEST["message"]=="ModifySuccesfull"){
                        echo "<div class='alert alert-success' role='alert'>Aggiunta Azienda!</div>";
                    }
                    $miohtml=<<<XYZ
                                <form action="Aggiungi_entita.php" method="post">
                                    <div class="mb-3">
                                        <label for="nome" class="form-label">Nome</label>
                                        <input type="text" class="form-control" id="nome" name="Nome" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="indirizzo" class="form-label">Indirizzo Azienda</label>
                                        <input type="text" class="form-control" id="indirizzo" name="Indirizzo" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="telefonoAzienda" class="form-label">Telefono Aziendale</label>
                                        <input type="text" class="form-control" id="telefonoAzienda" name="telefonoAzienda" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="RSA" class="form-label">RagioneSocialeAzienda</label>
                                        <input type="text" class="form-control" id="RSA" name="RSA" required>
                                    </div>
                                    <input type="hidden" name="entity" value="azienda">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary w-100">Aggiungi Azienda</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    XYZ;
                    echo $miohtml;
                }
            ?>
        </div>
    </div>
</body>
</html>
