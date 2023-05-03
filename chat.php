<?php
    // démarrer session
    session_start();
    if(!isset($_SESSION['user'])) {
        // si l'user n'est pas connecté, on redirige vers la page de connexion
        header("Location:index.php");    
    }
    $user = $_SESSION['user']; //email de l'utilisateur
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title> <?= $user ?> | Chat</title>
</head>
<body>

    <div class="chat">
        
        <div class="button_email">
            <span><?= $user ?></span>
            <a href="deconnexion.php" class="deconnexion_btn">Deconnexion</a>
        </div>

        <!-- messages -->
        <div class="message_box"> Chargement...</div>
        <!-- fin message -->

        <?php
            // envoie des messages
            if(isset($_POST['send'])) {
                // récupérons le message
                $message = $_POST['message'];
                // connexion à la BDD
                include("connexion_bdd.php");
                // vérifions si le champs n'est pas vide
                if(isset($message) && $message != "") {
                    // insérer le message dans la BDD
                    $req = mysqli_query($con , "INSERT INTO messages VALUES (NULL, '$user', '$message', NOW())");
                    // on actualise la page
                    header('Location:chat.php');
                }
                else {
                    header ('Location:chat.php');
                }
            }
        ?>

        <form action="" class="send_message" method="POST">
            <textarea name="message" cols="30" rows="2" placeholder="Votre message..."></textarea>
            <input type="submit" value="Envoyer" name="send">
        </form>

    </div>

    <script>
        let message_box = document.querySelector('.message_box');
        setInterval(function(){
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200) {
                    message_box.innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "messages.php", true); // récupération de lapage message
            xhttp.send();
            }, 300) // actualiser le chat tous les 500 ms
    </script>

</body>
</html>