<?php
    include "Database.php";
    include "utilitis.php";
    Controllo_Cookie(false);
    session_start();
    if((Controllo_Utente()) && (isset($_POST['IdPart']))){
        #l'utente ha cliccato ed è autenticato quindi aggiorno tempo sessione
        RefreshTempo();
        if (Database::connect()){
            $queryTab= "DELETE FROM Sceglie WHERE Sceglie.IDProgramma_fk = ? AND Sceglie.IDPart_fk = ?";
            $parametri=["ii",$_POST['QualeSpeech'],$_POST['IdPart']];
            $risultato=Database::executeQuery($queryTab,$parametri,false);
            if (!(isset($_REQUEST["who"]))){
                header("Location: ./index.php");
            }elseif($_REQUEST["who"]=="Admin"){
                header("Location: ./Partecipanti.php?Programma=".$_POST['QualeSpeech']."?ricarica=si");
            }
            Database::disconnect();
        }
    }
    else{
        header("Location: ./destroyer_session.php");
        exit;
    }
?>