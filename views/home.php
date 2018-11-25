<br />
<div class="container">
	<div id="illustration">
		<img id="landscape" src="public/img/GG.jpg" alt="Sega Game Gear">
	</div>
	<br />	
	<div class="row">
		<h1 id="site-title">Liste des jeux Game Gear</h1>
		<br />
	</div>
	<hr>
	<ul class="pagination center">
	<?php
    for ($i = 1; $i <= $numberOfPages; $i++) {
        if ($i == $currentPage) {
            echo "<li class='page-item'><a class='page-link'>$i</a></li>";
        } else {
            echo '<li class="waves-effect"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
        }
    }
    ?>	
	</ul>
	<hr>
	<div id="anchor" class="row">
		<div class="col-xs-12">
		<?php
        if (empty($listOfSheets)) {
            echo '<div class="alert alert-danger">';
            echo '<p>Aucun chapitre n\'a été publié pour le moment. Patientez un peu, l\'auteur est en plein travail.</p>';
            echo '</div>';
        if (isset($_SESSION['username']) && $_SESSION['username'] == 'j.forteroche') {
            echo '<p><a class="btn btn-default" href="index.php?p=admin&amp;menu=write">Commencez ici</a></p>';
        	}
        } else {
            foreach ($listOfSheets as $sheet) { ?>
			<div class="col l6 m6 s12">
				<div class="card">
					<div class="card-content">
						<h5 class="grey-text text-darken-2"><?= htmlspecialchars($sheet->getTitle()); ?></h5>
						<h6 class="grey-text">Le <?= $sheet->getDate()->format("d/m/Y"); ?> par <?= $sheet->getAuthor(); ?></h6>
					</div>
					<div class="card-image waves-effect waves-block waves-light">
						<a href="index.php?p=single&amp;id=<?= $sheet->getId(); ?>"><img src="public/img/<?= $sheet->getCover(); ?>" alt="<?= htmlspecialchars($sheet->getTitle()); ?>"/></a>
					</div>
					<div class="card-content">
						<span class="card-title activator grey-text text-darken-4"><i class="material-icons right">more_vert</i></span>
						<p><a href="index.php?p=single&amp;id=<?= $sheet->getId(); ?>">Voir la fiche complète</a></p>
					</div>
					<div class="card-reveal">
						<span class="card-title grey-text text-darken-4"><?= htmlspecialchars($sheet->getTitle()); ?><i class="material-icons right">close</i></span>
							<p><?= substr($sheet->getContent(), 0, 400) . '...'; ?></p>
					</div>
				</div>
			</div>
			<?php
		    }
		}
		?>
		</div>
	</div>
	<hr>
	<ul class="pagination center">
	<?php
	for ($i = 1; $i <= $numberOfPages; $i++) {
		if ($i == $currentPage) {
			echo "<li class='page-item'><a class='page-link'>$i</a></li>";
		} else {
			echo '<li class="waves-effect"><a class="page-link" href="?page=' . $i . '#anchor">' . $i . '</a></li>';
		}
	}
	?>
	</ul>
	<hr>
</div>