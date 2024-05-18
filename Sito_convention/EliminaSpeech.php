<?php
    include "Database.php";
    include "utilitis.php";
    Controllo_Cookie(false);
    Controllo_Utente_admin();
    session_start();
    if(Controllo_Utente()){
        #l'utente ha cliccato ed è autenticato quindi aggiorno tempo sessione
        RefreshTempo();
        if (isset($_POST['IDSpeech'])) {
            $idSpeech = $_POST['IDSpeech'];
            if (Database::connect()) {
                $query = "DELETE FROM Speech WHERE IDSpeech = ?";
                $parametri = ["i", $idSpeech];
                if (Database::executeQuery($query, $parametri, false)) {
                    echo "Speech eliminato con successo.";
                    header("Location: ./admin.php");
                } else {
                    echo "Errore durante l'eliminazione dello Speech.";
                }
                // Disconnessione dal database
                Database::disconnect();
            } else {
                echo "Connessione al database fallita.";
            }
        } else {
            echo "ID dello Speech non fornito.";
        }
    }
    else{
        header("Location: ./destroyer_session.php");
        exit;
    }
?>