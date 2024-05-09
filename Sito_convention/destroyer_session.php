<?php

    session_start();
    session_destroy();
    header("Location: ./login.php?user=".$_REQUEST["call"]);
?>