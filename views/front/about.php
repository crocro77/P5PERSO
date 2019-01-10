<div id="about" class="center about-container grey lighten-3">
	<div class="container">
		<div class="page-header">
			<h3>À propos</h3>
		</div>
		<?php
        if (empty($aboutDescription)) {
            $message = '<p>Cette page n\'a pas encore été complétée.</p>';
            if (isset($_SESSION['username']) and $_SESSION['username'] == 'ntonyyy') {
                $message .= ' <p><a href="index.php?p=admin&amp;tab=settings">Le faire maintenant.</a></p>';
            }
        echo $message;
        } else {
        echo $aboutDescription;
        }
        ?>
	</div>
</div>