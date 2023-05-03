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
        if(isset($_POST["button_con"])) {
            // si le formulaire est envoyé
            // se connecter à la bdd
            include "connexion_bdd.php";
            // extraire les infos du formulaire
            extract($_POST);
            // vérifions si les champs sont vides
            if(isset($email) && isset($mdp1) && $email != "" && $mdp1 != "") {
                // verifions si les identifiants sont justes
                $req = mysqli_query($con , "SELECT * FROM utilisateurs WHERE email = '$email' AND mdp = '$mdp1'");
                if(mysqli_num_rows($req) > 0) {
                    // si les id sont justes
                    //  création d'une session qui contient l'email
                    $_SESSION['user'] = $email;
                    // redirection vers la page chat
                    header("location:chat.php");
                    // détruire la variable du message d'inscription
                    unset($_SESSION['message']);
                }
                else {
                    // si non
                    $error = "Email ou mot de passe incorrecte(s) !";
                }
            } 
            else {
                // si champs vides
                $error = "Veuillez remplir tous les champs !";
            }
        };

    ?>
    
    <form class="form_connexion_inscription" action="" method="POST">
        <h1>CONNEXION</h1>
        <?php 
            //  affichons le message qui dit qu'un compte a été créé
            if(isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            

        ?>
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
        <input type="password" name="mdp1">
        <input type="submit" value="Connexion" name="button_con">
        <p class="link">Vous n'avez pas de compte ? <a href="inscription.php">Créer un compte</a></p>
    </form>


    
</body>
</html>