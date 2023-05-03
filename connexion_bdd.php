<?php

// connexion à la base de données
$con = mysqli_connect("localhost", "root","", "chat_message");

// gérer les accents et autres caractères
$req = mysqli_query($con , "SET NAMES UTF8");
if(!$con) {
    // si connexion échoué, afficher :
    echo "Connexion échouée";
};
