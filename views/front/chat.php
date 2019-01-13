<div class="container">
    <div class="center"> 
        <h1>Bienvenue sur le Chat</h1>
    </div>
    
    <div class="row" id="chatWindow">
        <?php
        if (empty($listOfChatMessages)) {
            echo '<div class="alert alert-danger">';
            echo '<p>Aucun message n\'a été encore publié pour le moment dans le chat. Patientez un peu ou créez une nouvelle discussion !</p>';
            echo '</div>';
        } else {
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
        <form id="form-chat" action="index.php?p=chat&action=postchatmessage" method="post">
            <p>
            <div class="form-group">
                <label for="pseudo">Pseudo</label>
                <div class="col-sm-offset-1 col-sm-2">
                    <input type="text" name="pseudo" id="pseudo" /><br />
                </div>
            </div>
            <div class="form-group">
                <label for="message" class="col-sm-1 control-label">Message</label><input type="text" name="message" id="message" />
                <div class="col-sm-offset-1 col-sm-2">
                    <input type="submit" class="btn btn-default btn-sm" value="Envoyer" />
                </div>
            </div>
            </p>
        </form>
    </div>
</div>