<?php
    function Controllo_Cookie($wait) {
        if(!(isset($_COOKIE["Tempo_Sessione"])) && ($wait==false)){
            header("Location: ./destroyer_session.php");
            exit;
        }
        elseif(!isset($_COOKIE["Tempo_Sessione"]) && ($wait==true)){
            return true;
        }else{
            return false;
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
                    header("Location: ./destroyer_session.php?call=controllo utente ciao");
                    exit;
                }
            }else{
                header("Location: ./destroyer_session.php?call=controllo utente miao");
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
    function is_Anonymus() {
        if(isArel() || isPart()){
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