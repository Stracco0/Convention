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
                    $actionwhere="adduser.php";
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
                    if($_REQUEST["action"]=="add"){
                        $who2="lo speech e la sala a cui vuoi associarlo";
                        $queryTab="SELECT Sala.NomeSala AS id, Sala.NomeSala AS nome FROM Sala JOIN PostiRimastiPerFasciaOraria ON Sala.NomeSala = PostiRimastiPerFasciaOraria.NomeSalaView WHERE PostiRimastiPerFasciaOraria.PostiRimasti > 0";
                        if($risultato2=Database::executeQueryNormal($queryTab)){
                        }else{
                            echo "failed";
                            exit;
                        }
                        $queryTab= "SELECT IDSpeech AS id, Titolo AS totnome FROM Speech";
                        if($risultato=Database::executeQueryNormal($queryTab)){
                                
                        }else{
                            echo "failed";
                            exit;
                        }
                        $flagprogramma=true;
                    }
                    else{
                        $who2="il programma";
                        $queryTab= "SELECT Programma.IDProgramma AS id, CONCAT(Programma.FasciaOraria, ' - ', Speech.Titolo) AS totnome, Sala.NomeSala AS sala FROM Programma JOIN Speech ON Programma.IDSpeech_fk = Speech.IDSpeech JOIN Sala ON Programma.NomeSala_fk = Sala.NomeSala";
                        if($risultato=Database::executeQueryNormal($queryTab)){
                                
                        }else{
                            echo "failed";
                            exit;
                        }
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
                        <form action=<?php echo $actionwhere;?> method="post">
                            <div class="form-group">
                            <input type="hidden" name="action2" value=<?php echo $_REQUEST["action"]?> />
                                <?php
                                        if($flagprogramma!=true){
                                            echo '<label for="utente">Seleziona '.$chi.':</label>';
                                            echo '<select class="form-control" id="utente" name="entity" required>';
                                            echo '<option value="">-- Seleziona --</option>';
                                            while($Risposta=mysqli_fetch_array($risultato)){
                                                echo '<option value='.$Risposta["id"].'>'.$Risposta["totnome"].'</option>';
                                            }
                                            echo '</select>';
                                        }else{
                                            echo '<label for="utente">Speech:</label>';
                                            echo '<select class="form-control" id="utente" name="entitySpeech" required>';
                                            echo '<option value="">-- Seleziona --</option>';
                                            while($Risposta1=mysqli_fetch_array($risultato)){
                                                echo '<option value='.$Risposta1["id"].'>'.$Risposta1["totnome"].'</option>';
                                            }
                                            echo '</select>';
                                            echo '<br><label for="utente">Sala:</label>';
                                            echo '<select class="form-control" id="utente" name="entitySala" required>';
                                            echo '<option value="">-- Seleziona --</option>';
                                            while($Risposta2=mysqli_fetch_array($risultato2)){
                                                echo '<option value='.$Risposta2["id"].'>'.$Risposta2["id"].'</option>';
                                            }
                                            echo '</select>';
                                        }
                                    ?>
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