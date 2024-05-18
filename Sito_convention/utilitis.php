<?php
    function Controllo_Cookie($wait) {
        if(!(isset($_COOKIE["Tempo_Sessione"])) && ($wait==false)){
            header("Location: ./destroyer_session.php?call=timeout");
            exit;
        }
        if(!(isset($_COOKIE["Tempo_Sessione"])) && ($wait==true)){
            return false;
        }else{
            return true;
        }
    };   
    function Controllo_Utente(){
        if (Database::connect()){
            $queryTab= "SELECT Mail FROM User WHERE id_user = ?";
            $parametri=["i",$_SESSION['idUser']];
            if($risultatoUser=Database::executeQuery($queryTab,$parametri,true)){
                if (($risultatoUser->num_rows) == 1){
                    #esiste
                    return true;
                }
                else{
                    header("Location: ./destroyer_session.php?call=noexistsnomore".$_SESSION['idUser']);
                    exit;
                }
            }else{
                header("Location: ./destroyer_session.php?call=error internal");
                exit;
            }
        }
    }
    function Controllo_Utente_admin(){
        if (Database::connect()){
            $queryTab= "SELECT Mail FROM User WHERE id_user = ?";
            $parametri=["i",$_SESSION['idUser']];
            if($risultatoUser=Database::executeQuery($queryTab,$parametri,true)){
                if (($risultatoUser->num_rows) == 1){
                    $risultatoUser=$risultatoUser->fetch_assoc();
                    if($risultatoUser["Mail"]!="admin@admin.com"){
                        header("Location: ./destroyer_session.php?call=noexistsnomore".$_SESSION['idUser']);
                        exit;
                    }else{
                        return true;
                    }
                }
                else{
                    header("Location: ./destroyer_session.php?call=noexistsnomore".$_SESSION['idUser']);
                    exit;
                }
            }else{
                header("Location: ./destroyer_session.php?call=error internal");
                exit;
            }
        }
    }  
    function isArel(){
        if(isset($_SESSION["RelAnche"])){
            return true;
        }else{
            return false;
        }
    }
    function isPart(){
        if(isset($_SESSION["idPart"])){
            return true;
        }else{
            return false;
        }
    }
    function is_NOTAnonymus() {
        if(isset($_SESSION["idUser"])){
            return true;
        }
        else{
            return false;
        }
    };  
    function RefreshTempo(){
        $time = time()+1200;
		$timeMemo = (string)$time;
        setcookie("Tempo_Sessione",$timeMemo,$time); //mezz'ora di tempo
    }
?>