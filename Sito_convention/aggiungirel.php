<?php
    include "Database.php";
    include "utilitis.php";
    Controllo_Cookie(false);
    session_start();
    if(Controllo_Utente_admin() && isset($_POST['IdRel'])){
        echo $_POST['QualeSpeech']." ".$_POST['IdRel'];
        #l'utente ha cliccato ed è autenticato quindi aggiorno tempo sessione
        RefreshTempo();
        if (Database::connect()){
            $queryTab= "SELECT IDProgramma_fk, IDRel_fk FROM Relaziona WHERE Relaziona.IDProgramma_fk = ? AND Relaziona.IDRel_fk = ?";
            $parametri=["ii",$_POST['QualeSpeech'],$_POST['IdRel']];
            $risultatoSpeech=Database::executeQuery($queryTab,$parametri,true);
            if(($risultatoSpeech->num_rows == 0)){   //se non è già iscritto
                $queryTab= "INSERT INTO Relaziona (IDProgramma_fk, IDRel_fk) VALUES (?, ?)";
                $parametri=["ii",$_POST['QualeSpeech'],$_POST['IdRel']];
                $risultato=Database::executeQuery($queryTab,$parametri,false);
                header("Location: ./AggiungiPersonal.php?programma=".$_POST['QualeSpeech']."&who=rel");
            }else{ // è già iscritto
                header("Location: ./AggiungiPersonal.php?user=AlreadyExists&programma=".$_POST['QualeSpeech']."&who=rel");
            }
        }
    }
    else{
        header("Location: ./destroyer_session.php");
        exit;
    }
?>
