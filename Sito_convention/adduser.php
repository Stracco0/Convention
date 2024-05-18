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
                            if($_POST["action2"]=="modify" || $_REQUEST["returnto"]=="modify"){
                                if (Database::connect()){
                                    $queryTab= "SELECT Mail FROM User WHERE Id_user = ?";
                                    if (isset($_REQUEST["returnto"])){
                                        $parametri=["i",$_REQUEST["idUser"]];
                                        $iduser=$_REQUEST["idUser"];
                                    }
                                    else{
                                        $parametri=["i",$_POST["entity"]];
                                        $iduser=$_POST["entity"];
                                    }
                                    if($result=Database::executeQuery($queryTab,$parametri,true)){
                                        $result=$result->fetch_assoc();
                                        echo '<div class="card">';
                                            echo '<div class="card-header text-center">';
                                                echo '<h3 class="mb-0">Modifica l\'Utente</h3>';
                                            echo '</div>';
                                        echo '<div class="card-body">';
                                        if($_REQUEST["message"]=="ModifySuccesfull"){
                                            echo "<div class='alert alert-success' role='alert'>Email modificata!</div>";
                                        }
                                        $miohtml=<<<XYZ
                                                <form action="Modifica_entita.php" method="post">
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" value={$result["Mail"]} class="form-control" id="email" name="email_user" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="password" class="form-label">Nuova Password</label>
                                                        <input type="password" class="form-control" id="password" name="psw_user" required>
                                                    </div>
                                                    <input type="hidden" name="entity" value="user">
                                                    <input type="hidden" name="idUser" value={$iduser}>
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-success w-100">Modifica Utente</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        XYZ;
                                        echo $miohtml;
                                    }
                                }
                            }else{
                                echo '<div class="card">';
                                    echo '<div class="card-header text-center ">';
                                        echo '<h3 class="mb-0">Aggiungi l\'Utente</h3>';
                                    echo '</div>';
                                echo '<div class="card-body">';
                                if($_REQUEST["message"]=="AlreadyExists"){
                                    echo "<div class='alert alert-danger' role='alert'>Email già registrata!</div>";
                                }
                                if($_REQUEST["message"]=="Succesfull"){
                                    echo "<div class='alert alert-primary' role='alert'>User Aggiunto!</div>";
                                }
                                $miohtml=<<<XYZ
                                        <form action="Aggiungi_entita.php" method="post">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" value="" class="form-control" id="email" name="email_user" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="password" name="psw_user" required>
                                            </div>
                                            <input type="hidden" name="entity" value="user">
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary w-100">Aggiungi Utente</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                XYZ;
                                echo $miohtml;
                            }
                        ?>
            </div>
        </div>
    </div>
</body>
</html>
