
<?php

session_start();

// si l'user se connecte
if(isset($_SESSION['user'])) {
    // connexion à la base de donnée
    include "connexion_bdd.php";
    // requete pour afficher les messages
    $req = mysqli_query($con , "SELECT * FROM messages ORDER BY id_m DESC");
    if(mysqli_num_rows($req) == 0) {
        // s'il n'y a pas encore de message
        echo "Messagerie vide";
    }
    else {
        // si oui
        while($row = mysqli_fetch_assoc($req)) {
            // si c'est vous qui l'avait envoyé :
            if($row['email'] == $_SESSION['user']) {
                ?>
                    <div class="message your_message">
                        <span>Vous</span>
                        <p><?= $row['msg'] ?></p>
                        <p class="date"><?= $row['date'] ?></p>
                    </div>
                <?php
            }
            else {
                // si vous n'êtes pas l'auteur du message :
                ?>
                    <div class="message autres_message">
                        <span><?= $row['email'] ?></span>
                        <p><?= $row['msg'] ?></p>
                        <p class="date"><?= $row['date'] ?></p>
                    </div>
                <?php
            }
        }
    }
}

?>












<!-- <div class="message your_message">
                <span>Vous</span>
                <p>Comment ça va ?</p>
                <p class="date">28-04-2023</p>
            </div>
            <div class="message autres_message">
                <span>azerty@gmail.com</span>
                <p>Oui ça va</p>
                <p class="date">28-04-2023</p>
</div> -->