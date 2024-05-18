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
                     if (Database::connect()){
                        $queryTab= "SELECT RagioneSocialeAzienda AS id, Nome AS totnome FROM Azienda";
                        if($result=Database::executeQueryNormal($queryTab)){
                            if($_POST["action2"]=="add"){
                                $iduser=$_POST["entity"];
                                echo '<div class="card">';
                                    echo '<div class="card-header text-center">';
                                        echo '<h3 class="mb-0">Aggiungi il relatore</h3>';
                                    echo '</div>';
                                echo '<div class="card-body">';
                                $miohtml=<<<XYZ
                                        <form action="Aggiungi_entita.php" method="post">
                                            <div class="mb-3">
                                                <label for="nome" class="form-label">Nome</label>
                                                <input type="text" class="form-control" id="nome" name="nomeRel" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="cognome" class="form-label">Cognome</label>
                                                <input type="text" class="form-control" id="cognome" name="cognomeRel" required>
                                            </div>
                                            <input type="hidden" name="entity" value="relatore">
                                            <input type="hidden" name="idUser" value={$iduser}>
                                XYZ;
                                echo $miohtml;
                                echo '<label for="azienda">Seleziona l\'azienda:</label>';
                                            echo '<select class="form-control mb-3" id="azienda" name="idAzienda" required>';
                                            echo '<option value="">-- Seleziona --</option>';
                                            while($Risposta=mysqli_fetch_array($result)){
                                                echo '<option value='.$Risposta["id"].'>'.$Risposta["totnome"].'</option>';
                                            }
                                            echo '</select>';
                                echo '<div class="text-center">
                                        <button type="submit" class="btn btn-primary w-100">Aggiungi il Relatore</button>
                                    </div>';
                                echo '</form>
                                    </div>
                                </div>';
                            }
                            if($_POST["action2"]=="modify"){
                                $idRel=$_POST["entity"];
                                $queryTab= "SELECT Relatore.NomeRel AS nome, Relatore.CognomeRel AS cognome, Azienda.RagioneSocialeAzienda AS ragione_sociale FROM Relatore JOIN Azienda ON Relatore.RSAzienda_fk = Azienda.RagioneSocialeAzienda WHERE Relatore.IDRel = ?";
                                $parametri=["s",$_POST["entity"]];
                                if($result2=Database::executeQuery($queryTab,$parametri,true)){
                                    $result2=$result2->fetch_assoc();
                                    echo '<div class="card">';
                                        echo '<div class="card-header text-center">';
                                            echo '<h3 class="mb-0">Modifica il relatore</h3>';
                                        echo '</div>';
                                    echo '<div class="card-body">';
                                    $miohtml=<<<XYZ
                                            <form action="Modifica_entita.php" method="post">
                                                <div class="mb-3">
                                                    <label for="nome" class="form-label">Nome</label>
                                                    <input value={$result2["nome"]} type="text" class="form-control" id="nome" name="nomeRel" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="cognome" class="form-label">Cognome</label>
                                                    <input value={$result2["cognome"]} type="text" class="form-control" id="cognome" name="cognomeRel" required>
                                                </div>
                                                <input type="hidden" name="entity" value="relatore">
                                                <input type="hidden" name="idRel" value={$idRel}>
                                    XYZ;
                                    echo $miohtml;
                                    echo '<label for="azienda">Seleziona l\'azienda:</label>';
                                                echo '<select value=.'.$result2["ragione_sociale"].' class="form-control mb-3" id="azienda" name="idAzienda" required>';
                                                echo '<option value="">-- Seleziona --</option>';
                                                while($Risposta=mysqli_fetch_array($result)){
                                                    if($Risposta["id"]==$result2["ragione_sociale"]){
                                                        echo '<option selected value='.$Risposta["id"].'>'.$Risposta["totnome"].'</option>';
                                                    }
                                                    else{echo '<option value='.$Risposta["id"].'>'.$Risposta["totnome"].'</option>';}
                                                }
                                                echo '</select>';
                                    echo '<div class="text-center">
                                            <button type="submit" class="btn btn-success w-100">Modifica il Relatore</button>
                                        </div>';
                                    echo '</form>
                                        </div>
                                    </div>';
                                }
                            }
                        }
                     }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
