<div id="about" class="container grey lighten-3 center">
	<div class="container">
		<div class="page-header">
            <h2>Formulaire de contact !</h2>
        </div>
        <br />
        <form method="POST" action="index.php?p=contact&action=postmessage">
            <input type="text" name="contactname" placeholder="Votre nom" value="<?php if (isset($_POST['contactname'])) { echo $_POST['contactname']; } ?>" /><br /><br />
            <input type="email" name="contactmail" placeholder="Votre email" value="<?php if (isset($_POST['contactmail'])) {echo $_POST['contactmail']; } ?>" /><br /><br />
            <textarea name="contactmessage" placeholder="Votre message"><?php if (isset($_POST['contactmessage'])) { echo $_POST['contactmessage']; } ?></textarea><br /><br />
            <input class="btn btn-default btn-sm" type="submit" value="Envoyer votre message" name="mailform"/>
        </form>

		<?php
        if (isset($msg)) {
            echo $msg;
        }
        ?>
	</div>
</div>