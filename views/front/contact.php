<br />
<div class="container grey lighten-3 center">
		<div class="class col l4 m6 s12 offset-l4 offset-m3">
            <div class="container">
                <div class="page-header">
                <br />
                    <h2>Formulaire de contact</h2>
                </div>
                <br />
                <form method="POST" action="index.php?p=contact&action=postmessage">
                <div class="row">
                    <div class="input-field col s12">
                        <label for="contactname">Votre nom</label>
                        <input type="text" name="contactname" value="<?php if (isset($_POST['contactname'])) { echo $_POST['contactname']; } ?>" /><br /><br />
                    </div>
                    <div class="input-field col s12">
                        <label for="contactmail">Votre mail</label>
                        <input type="email" name="contactmail" value="<?php if (isset($_POST['contactmail'])) {echo $_POST['contactmail']; } ?>" /><br /><br />
                    </div>
                    <div class="input-field col s12">
                        <label for="contactmessage">Votre message</label>
                        <textarea name="contactmessage" class="materialize-textarea"><?php if (isset($_POST['contactmessage'])) { echo $_POST['contactmessage']; } ?></textarea><br /><br />
                    </div>
                    <div class="center">
                        <input class="btn btn-default btn-sm" type="submit" value="Envoyer votre message" name="mailform"/>
                    </div>
                    </div>
                </form>
                <br />

                <?php
                if (isset($msg)) {
                    echo $msg;
                }
                ?>
            </div>
        </div>
</div>