<?php
    include "Database.php";
    include "utilitis.php";
    Controllo_Cookie(false);
    session_start();
    if((Controllo_Utente_admin()) && (isset($_POST['IdRel']))){
        #l'utente ha cliccato ed è autenticato quindi aggiorno tempo sessione
        RefreshTempo();
        if (Database::connect()){
            $queryTab= "DELETE FROM Relaziona WHERE Relaziona.IDProgramma_fk = ? AND Relaziona.IDRel_fk = ?";
            $parametri=["ii",$_POST['QualeSpeech'],$_POST['IdRel']];
            $risultato=Database::executeQuery($queryTab,$parametri,false);
            header("Location: ./Partecipanti.php?Programma=".$_POST['QualeSpeech']."?ricarica=si");
            Database::disconnect();
        }
    }
    else{
        header("Location: ./destroyer_session.php");
        exit;
    }
?>