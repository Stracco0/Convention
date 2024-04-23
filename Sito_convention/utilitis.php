<?php
    function Controllo_Cookie() {
        if(!isset($_COOKIE["Tempo_Sessione"])){
            header("Location: ./destroyer_session.php");
            exit;
        }
    };   
    function Controllo_Utente(){
        if (Database::connect()){
            $queryTab= "SELECT Mail FROM User WHERE id_user = '{$_SESSION['idUser']}'";
            if($risultatoUser=Database::executeQuery($queryTab)){
                if (($risultatoUser->num_rows) == 1){
                    #esiste
                    return true;
                }
                else{
                    header("Location: ./destroyer_session.php");
                    exit;
                }
            }else{
                header("Location: ./destroyer_session.php");
                exit;
            }
        }
    }
    function RefreshTempo(){
        $time = time()+1200;
		$timeMemo = (string)$time;
        setcookie("Tempo_Sessione",$timeMemo,$time); //mezz'ora di tempo
    }
?>