<div class="center about-container grey lighten-3">
	<div class="container">
		<div class="page-header">
			<h3>À propos</h3>
		</div>
		<?php
		// Si l'administrateur n'a pas encore fourni de description, on affiche un message.
        if (empty($aboutDescription)) {
            $message = '<p>Cette page n\'a pas encore été complétée.</p>';
            if (isset($_SESSION['username']) and $_SESSION['username'] == 'ntonyyy') {
                $message .= ' <p><a href="index.php?p=admin&amp;menu=settings">Le faire maintenant.</a></p>';
            }
        echo $message;
        // Sinon, on affiche la description fournie.
        } else {
        echo $aboutDescription;
        }
        ?>
	</div>
</div>