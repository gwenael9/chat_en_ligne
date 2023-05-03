<?php
    // démarrer la session
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Connexion | Chat</title>
</head>
<body>

    <?php

        if(isset($_POST['button_inscription'])) {
            // si le formulaire est envoyé
            // se connecter à la bdd
            include "connexion_bdd.php";
            // extraire les infos du formulaire
            extract($_POST);
            // vérifions si les champs sont vides
            if(isset($email) && isset($mdp1) && $email != "" && $mdp1 != "" && isset($mdp2) && $mdp2 != "") {
                //  verifions que les mots de passes sont conformes
                if($mdp2 != $mdp1) {
                    $error = "Les mots de passes sont différents !";
                }
                else {
                    // si non, vérifions que l'email existe
                    $req = mysqli_query($con , "SELECT * FROM utilisateurs WHERE email = '$email'");
                    if(mysqli_num_rows($req) == 0){
                        // si ça n'existe pas,
                        $req = mysqli_query($con , "INSERT INTO utilisateurs VALUES (NULL, '$email' , '$mdp1') ");
                        if($req){
                            // si le compte a été créé, créons une variable pour afficher un message dans la page de connexion
                            $_SESSION['message'] = "<p class='message_inscription'>Votre compte a été créé avec succès !</p>";
                            // redirection vers la page de connexion
                            header("Location:index.php");
                        }
                        else {
                            // si non
                            $error = "Inscription échouée !";
                        };
                    }
                    else {
                        $error = "Cet email existe déjà !";
                    }
                }
            }
            else {
                $error = "Veuillez remplir tous les champs !";
            }
        }

    ?>
    
    <form action="" method="POST" class="form_connexion_inscription" >
        <h1>INSCRIPTION</h1>
        <p class="message_error">
            <?php
                // affichons l'erreur
                if(isset($error)) {
                    echo $error;
                };
            ?>
        </p>
        
        <label>Adresse mail</label>
        <input type="email" name="email">
        <label>Mot de passe</label>
        <input type="password" name="mdp1" class="mdp1">
        <label>Confirmez votre mot de passe</label>
        <input type="password" name="mdp2" class="mdp2">
        <input type="submit" value="Inscription" name="button_inscription" >
        <p class="link">Vous avez un compte ? <a href="index.php">Se connecter</a></p>
    </form>


    <script src="script.js"></script>
</body>
</html>