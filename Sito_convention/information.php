<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_REQUEST["nameuser"];?></title>
</head>
<body>
    <?php
        include "Database.php";
        include "utilitis.php";
        Controllo_Cookie(false);
        session_start();
        $where="Info Account";
        if ($_SESSION["mail_user"]=="admin@admin.com"){
            $returnto1="admin.php";
        }
        else{
            $returnto1="index.php";
        }
        $returnto2="information.php?nameuser=".$_REQUEST["nameuser"];
        include_once("navbar.php");
    ?>
    <div class="container-fluid p-3">
        <?php
            echo "<a href=".$returnto1."><button class='btn btn-primary mb-2'><i class='fas fa-arrow-left'></i></button></a>";
        ?>
    </div>
    <div class="container mt-5">
            <?php
                if(Controllo_Utente()){
                    #l'utente ha cliccato ed è autenticato quindi aggiorno tempo sessione
                    RefreshTempo();
                    if (Database::connect()){
                        #Ottengo lista Speech con un bottone aggiungi
                        $queryTab="SELECT User.Id_user, User.Mail, User.Password_user, Partecipante.NomePart, Partecipante.CognomePart, Partecipante.TipologiaPart, Relatore.NomeRel, Relatore.CognomeRel, CASE WHEN User.IDPart_fk IS NOT NULL AND User.IDRel_fk IS NOT NULL THEN 'Partecipante e Relatore' WHEN User.IDPart_fk IS NOT NULL THEN 'Partecipante' WHEN User.IDRel_fk IS NOT NULL THEN 'Relatore' ELSE 'Nessuna Tipologia' END AS Tipologia, Partecipante.IDPart, Relatore.IDRel FROM User LEFT JOIN Partecipante ON User.IDPart_fk = Partecipante.IDPart LEFT JOIN Relatore ON User.IDRel_fk = Relatore.IDRel WHERE User.Id_user = ?";
                        $parametri=["i",$_SESSION['idUser']];
                        if($result=Database::executeQuery($queryTab,$parametri,true)){
                            $result=$result->fetch_assoc();
                            $htmlmio=<<<XYZ
                            <div class="row mb-4">
                                <div class="col"></div>
                                <div class="col-6">
                                    <div class="card h-100">
                                        <div class="card-header bg-primary text-white">
                                            <h5 class="card-title mb-0">Informazioni Utente</h5>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text"><strong>Email:</strong> {$result["Mail"]}</p>
                                            <p class="card-text"><strong>Tipologia:</strong> {$result["Tipologia"]}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col"></div>
                            </div>
                            <div class="row justify-content-center">
                            XYZ;
                            echo $htmlmio;
                            if(!(is_null($result["IDPart"]))){
                                $htmlmio=<<<XYZ
                                <div class="col-6 mb-4">
                                    <div class="card h-100">
                                        <div class="card-header bg-success text-white">
                                            <h5 class="card-title mb-0">Informazioni Partecipante</h5>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text"><strong>Nome:</strong> {$result["NomePart"]}</p>
                                            <p class="card-text"><strong>Cognome:</strong> {$result["CognomePart"]}</p>
                                            <p class="card-text"><strong>Tipologia:</strong> {$result["TipologiaPart"]}</p>
                                        </div>
                                    </div>
                                </div>
                                XYZ;
                                echo $htmlmio;
                            }
                            if(!(is_null($result["IDRel"]))){
                                $htmlmio=<<<XYZ
                                <div class="col-6 mb-4">
                                    <div class="card h-100">
                                        <div class="card-header bg-info text-white">
                                            <h5 class="card-title mb-0">Informazioni Relatore</h5>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text"><strong>Nome:</strong> {$result["NomeRel"]}</p>
                                            <p class="card-text"><strong>Cognome:</strong> {$result["CognomeRel"]}</p>
                                        </div>
                                    </div>
                                </div>
                                XYZ;
                                echo $htmlmio;
                            }
                            echo "</div>";
                        }
                    }
                }
            ?>
    </div>
</body>
</html>