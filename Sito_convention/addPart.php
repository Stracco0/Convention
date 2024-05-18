<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utente</title>
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
                     if($_POST["action2"]=="add"){
                        $miohtml=<<<XYZ
                        <div class="container mt-5">
                            <div class="row justify-content-center">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header text-center ">
                                            <h3 class="mb-0">Aggiungi Speech</h3>
                                        </div>
                                        <div class="card-body">
                                            <form action="Aggiungi_entita.php" method="post">
                                                <div class="mb-3">
                                                    <label for="Nome" class="form-label">Nome</label>
                                                    <input type="text" class="form-control" id="Nome" name="nome" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="Cognome" class="form-label">Cognome</label>
                                                    <input type="text" class="form-control" id="Cognome" name="cognome" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="Cognome" class="form-label">Tipologia</label>
                                                    <input type="text" class="form-control" id="Cognome" name="tipo" required>
                                                </div>
                                                <input type="hidden" name="entity" value="partecipante">
                                                <input type="hidden" name="idUser" value={$_POST["entity"]}>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary w-100">Aggiungi Partecipante</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        XYZ;
                        echo $miohtml;
                     }else{
                        if (Database::connect()){
                            $queryTab="SELECT NomePart,CognomePart,TipologiaPart FROM Partecipante WHERE IDPart = ?";
                            $parametri=["i",$_POST["entity"]];
                            if($result2=Database::executeQuery($queryTab,$parametri,true)){
                                $result2=$result2->fetch_assoc();
                                $miohtml=<<<XYZ
                                <div class="container mt-5">
                                    <div class="row justify-content-center">
                                        <div class="col">
                                            <div class="card">
                                                <div class="card-header text-center ">
                                                    <h3 class="mb-0">Modifica Speech</h3>
                                                </div>
                                                <div class="card-body">
                                                    <form action="Modifica_entita.php" method="post">
                                                        <div class="mb-3">
                                                            <label for="Nome" class="form-label">Nome</label>
                                                            <input value={$result2["NomePart"]} type="text" class="form-control" id="Nome" name="nome" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="Cognome" class="form-label">Cognome</label>
                                                            <input value={$result2["CognomePart"]}  type="text" class="form-control" id="Cognome" name="cognome" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="Cognome" class="form-label">Tipologia</label>
                                                            <input value={$result2["TipologiaPart"]}  type="text" class="form-control" id="Cognome" name="tipo" required>
                                                        </div>
                                                        <input type="hidden" name="entity" value="partecipante">
                                                        <input type="hidden" name="idPart" value={$_POST["entity"]}>
                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-success w-100">Modifica Partecipante</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                XYZ;
                                echo $miohtml;
                            }
                        }
                     }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
