<?php
    // démarrer session
    session_start();
    if(!isset($_SESSION['user'])) {
        // si l'user n'est pas connecté, on redirige vers la page de connexion
        header("Location:index.php");    
    }
    // destruction de toutes les sessions
    session_destroy();
    // redirection vers la page de connexion
    header("Location: index.php");
?>