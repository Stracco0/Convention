<?php
include "Database.php";

if(isset($_POST['speechId']) && isset($_POST['participantId'])){
    $speechId = $_POST['speechId'];
    $participantId = $_POST['participantId'];

    // Query to remove participant from speech
    $query = "DELETE FROM Sceglie WHERE IDProgramma_fk = ? AND IDPart_fk = ?";
    $params = ["ii", $speechId, $participantId];
    if(Database::executeQuery($query, $params,false)){
        // Redirect back to admin panel
        header("Location: admin.php");
        exit();
    } else {
        echo "Errore nella rimozione del partecipante.";
    }
} else {
    echo "Parametri mancanti.";
}
?>