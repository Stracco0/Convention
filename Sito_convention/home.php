<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include "utilitis.php";
        Controllo_Cookie();
        session_start();
        echo (intval($_COOKIE['Tempo_Sessione']) - time());
        # Controllare se la sessione è attiva, in caso buttarlo fuori
        # mostra i suoi dati e tutti i corsi e i corsi in cui è iscritto, in caso fosse anche relatore
        # far vedere anche i suoi speech
    ?>
</body>
</html>