<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose</title>
    <?php
        include "./Database.php";
        include "./utilitis.php";
        $returnto1="./admin.php";
        $returnto2="./admin.php";
        $where="Admin";
        include_once("./navbar.php");
        Controllo_Cookie(false);
        if(Controllo_Utente() && $_SESSION["mail_user"]=="admin@admin.com" && isset($_REQUEST["who"])){
            RefreshTempo();
        }
    ?>
</head>
<body>
    <?php
        if (Database::connect()){
            switch($_REQUEST["who"]) {
                case 'user':
                    $queryTab= "SELECT Id_user AS id, Mail AS totnome FROM User";
                    if($risultato=Database::executeQueryNormal($queryTab)){
                    $who2="l'utente";
                    }else{
                        echo "failed";
                        exit;
                    }
                    break;
                case 'rel':
                    if ($_REQUEST["action"]=="add"){
                        $who2="l'Utente a cui associarlo";
                        $queryTab= "SELECT Id_user AS id, Mail AS totnome FROM User";
                        if($risultato=Database::executeQueryNormal($queryTab)){   
                        }
                        else{
                            echo "failed";
                            exit;
                        }
                    }
                    else{
                        $who2="il Relatore";
                        $queryTab= "SELECT IDRel AS id, CONCAT(NomeRel, ' ', CognomeRel) AS totnome FROM Relatore";
                        if($risultato=Database::executeQueryNormal($queryTab)){    
                        }else{
                            echo "failed";
                            exit;
                        }
                    }
                    break;
                case 'azienda':
                    $who2="l'Azienda";
                    $queryTab= "SELECT RagioneSocialeAzienda AS id, Nome AS totnome FROM Azienda";
                    if($risultato=Database::executeQueryNormal($queryTab)){
                            
                    }else{
                        echo "failed";
                        exit;
                    }
                    break;
                case ('part'):
                    if ($_REQUEST["action"]=="add"){
                        $who2="l'Utente a cui associarlo";
                        $queryTab= "SELECT Id_user AS id, Mail AS totnome FROM User";
                        if($risultato=Database::executeQueryNormal($queryTab)){   
                        }
                        else{
                            echo "failed";
                            exit;
                        }
                    }
                    else{
                        $who2="il Partecipante";
                        $queryTab= "SELECT IDPart AS id, CONCAT(NomePart, ' ', CognomePart) AS totnome FROM Partecipante";
                        if($risultato=Database::executeQueryNormal($queryTab)){   
                        }
                        else{
                            echo "failed";
                            exit;
                        }
                    }
                    break;
                case 'speech':
                    $who2="lo speech";
                    $queryTab= "SELECT IDSpeech AS id, Titolo AS totnome FROM Speech";
                    if($risultato=Database::executeQueryNormal($queryTab)){
                            
                    }else{
                        echo "failed";
                        exit;
                    }
                    break;
                case 'programma':
                    $who2="il programma";
                    $queryTab= "SELECT Programma.IDProgramma AS id, Speech.Titolo AS totnome FROM Programma JOIN Speech ON Programma.IDSpeech_fk = Speech.IDSpeech";
                    if($risultato=Database::executeQueryNormal($queryTab)){
                            
                    }else{
                        echo "failed";
                        exit;
                    }
                    break;
                default:
                    echo 'Entità non valida.';
            }
            Database::disconnect();
        }
        else{
            echo "Error nella connessione";
        }
    ?>
    <div class="container-fluid p-3">
        <a href="admin.php"><button class='btn btn-primary mb-2'><i class='fas fa-arrow-left'></i></button></a>
    </div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Scegli <?php echo $who2?></h3>
                    </div>
                    <div class="card-body">
                        <?php
                            switch ($_REQUEST["action"]) {
                                case 'delete':
                                    $actionwhere="url";
                                    break;
                                case 'add':
                                    $actionwhere="url";
                                    break;
                                case 'modify':
                                    $actionwhere="url";
                                    break;
                            }
                        ?>
                        <form action=<?php echo $actionwhere;?> method="post">
                            <div class="form-group">
                                <label for="utente">Seleziona <?php echo $chi;?>:</label>
                                <select class="form-control" id="utente" name="entity" required>
                                    <option value="">-- Seleziona --</option>
                                    <?php
                                        while($Risposta=mysqli_fetch_array($risultato)){
                                            echo '<option value='.$Risposta["id"].'>'.$Risposta["totnome"].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <?php
                                if ($_REQUEST["action"]=="delete") {
                                    echo '<button type="submit" onClick="javascript: return confirm(\'Sicuro di volerlo eliminare?\');" class="btn btn-danger btn-block">Elimina</button>';
                                }
                                elseif($_REQUEST["action"]=="modify"){
                                    echo '<button type="submit" class="btn btn-success btn-block">Continua</button>';
                                }
                                else{
                                    echo '<button type="submit" class="btn btn-primary btn-block">Continua</button>';
                                }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>