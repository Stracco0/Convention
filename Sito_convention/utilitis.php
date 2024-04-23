<?php
    function Controllo_Cookie() {
        if(!isset($_COOKIE["Tempo_Sessione"])){
            header("Location: ./destroyer_session.php");
            exit;
        }
    };   
?>