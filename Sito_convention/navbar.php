<nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top">
    <a class="navbar-brand" href=<?php echo $returnto1;?>>Convention</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb" aria-expanded="true">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div id="navb" class="navbar-collapse collapse hide">
        <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href=<?php echo $returnto2;?>><?php echo $where; ?></a>
        </li>
        </ul>
        <?php
            include_once("dependences.php");
            session_start();
            if(is_NOTAnonymus()){
                Controllo_Utente();
                Controllo_Cookie(false);
                if (Database::connect()){
                    $queryTab= "SELECT Mail FROM User WHERE id_user = ?";
                    $parametri=["i",$_SESSION['idUser']];
                    if($risultatoUser=Database::executeQuery($queryTab,$parametri,true)){
                        if (($risultatoUser->num_rows) == 1){
                            #controllo se l'id dell'utente esiste
                            $Risposta_user=$risultatoUser->fetch_assoc();
                            $nome = strtok($Risposta_user['Mail'], '@');
                            $htmlmio = <<<XYZ
                            <ul class="nav navbar-nav ml-auto dropleft">
                                <div class="dropdown">
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="information.php?nameuser=$nome">Info Account</a>
                                <a class="dropdown-item" href="destroyer_session.php"><span class="fas fa-sign-in-alt"></span> Logout</a>
                                </div>
                            </div>
                                <a type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link" href="#"><span class="fas fa-user"> {$nome} </span></a>
                                </div>
                            </li>
                            </ul>
                            XYZ;
                            echo $htmlmio;
                        }
                        else{
                            header("Location: ./destroyer_session.php?call=controllo utente 2 header");
                            exit;
                        }
                    }
                }
            }
            else{
                $htmlmio = <<<XYZ
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="register.php"><span class="fas fa-user"></span> Registrati</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php"><span class="fas fa-sign-in-alt"></span> Accedi</a>
                    </li>
                </ul>
                XYZ;
                echo $htmlmio;
            }
        ?>
    </div>
</nav>