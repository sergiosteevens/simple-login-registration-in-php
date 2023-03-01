<?php
    session_start();
    //para eliminar la session
    session_unset();

    session_destroy();

    header('location: index.php');
?>