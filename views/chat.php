<div class="container">
    <div class="row" id="chatWindow">

        <?php
        if (empty($listOfChatMessages)) {
            echo '<div class="alert alert-danger">';
            echo '<p>Aucun message n\'a été encore publié pour le moment dans le chat. Patientez un peu ou créez une nouvelle discussion !</p>';
            echo '</div>';
        } else {
            // Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
            foreach ($listOfChatMessages as $chatMessage) { ?>
                <div>
                    <p id="chatLine"><span id="chatPseudo"><?= htmlspecialchars($chatMessage->getPseudo()); ?></span> <span id="chatMessage"><?= htmlspecialchars($chatMessage->getMessage()); ?></p></span>
                </div>
            <?php
            }
        }
        ?>
    </div>

    <div class="row">
        <form action="" method="post">
            <p>
                <label for="pseudo">Pseudo</label><input type="text" name="pseudo" id="pseudo" /><br />
                <label for="message">Message</label><input type="text" name="message" id="message" /><br />

                <input type="submit" class="btn btn-default btn-sm" value="Envoyer" />
            </p>
        </form>
    </div>
</div>