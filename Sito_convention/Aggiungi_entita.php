<?php
if(isset($_POST['entity'])) {
    $entity = $_GET['entity'];
    switch($entity) {
        case 'user':
            include 'add_user_form.php';
            break;
        case 'relatore':
            include 'add_relatore_form.php';
            break;
        case 'azienda':
            include 'add_azienda_form.php';
            break;
        case 'partecipante':
            include 'add_partecipante_form.php';
            break;
        case 'speech':
            include 'add_speech_form.php';
            break;
        default:
            echo 'Entità non valida.';
    }
} else {
    echo 'Parametro "entity" mancante.';
}
?>