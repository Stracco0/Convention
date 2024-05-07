<?php
    include "Database.php";
    include "utilitis.php";
    Controllo_Cookie(false);
    session_start();
    if(Controllo_Utente() && isset($_POST['IdPart'])){
        #l'utente ha cliccato ed è autenticato quindi aggiorno tempo sessione
        RefreshTempo();
        if (Database::connect()){
            $queryTab= "SELECT IDProgramma_fk, IDPart_fk FROM Sceglie WHERE Sceglie.IDProgramma_fk = ? AND Sceglie.IDPart_fk = ?";
            $parametri=["ii",$_POST['QualeSpeech'],$_POST['IdPart']];
            $risultatoSpeech=Database::executeQuery($queryTab,$parametri,true);
            if(($risultatoSpeech->num_rows == 0)){   //se non è già iscritto
                $queryTab= "INSERT INTO Sceglie (IDProgramma_fk, IDPart_fk) VALUES (?, ?)";
                $parametri=["ii",$_POST['QualeSpeech'],$_POST['IdPart']];
                $risultato=Database::executeQuery($queryTab,$parametri,false);
                header("Location: ./AggiungiSpeech.php");
            }else{ // è già iscritto
                header("Location: ./AggiungiSpeech.php?user=AlreadyExists");
            }
        }
    }
    else{
        header("Location: ./destroyer_session.php");
        exit;
    }
?>
