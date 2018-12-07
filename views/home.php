<br />
<div id="home" class="container">
	<div id="">
		<div id="slider">
			<img id="sliderImage" src="public/img/GG.jpg" alt="sliderImage">
		</div>
	</div>
	<br />	
	<div class="row">
		<h1 class=" light-blue darken-4" id="site-title">Index des jeux Game Gear</h1>
		<br />
	</div>
	<hr>
	<form class="center" method="get">
		<label>Nombre de fiches par page</label>
			<select name="pp">
				<option value="2">2</option>
				<option value="4">4</option>
				<option value="6">6</option>
				<option value="8">8</option>
				<option value="10">10</option>
			</select>
		<input type="hidden" name="p" value="<?php echo $currentPage ?>" />
		<button class="btn" type="submit">Appliquer</button>
	</form>
	<ul class="pagination center">
	<li class="<?php if($currentPage == '1'){ echo "disabled"; } ?>"><a href="?page=<?php if ($currentPage != '1'){ echo $currentPage-1; } else { echo $currentPage; } ?>">&laquo;</a></li>
	<?php
    for ($i = 1; $i <= $numberOfPages; $i++) {
        if ($i == $currentPage) {
            echo "<li class='page-item'><a class='page-link'>$i</a></li>";
        } else {
            echo '<li class="waves-effect"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
        }
    }
    ?>
	<li class="<?php if($currentPage == '1'){ echo "disabled"; } ?>"><a href="?page=<?php if ($currentPage != '1'){ echo $currentPage+1; } else { echo $currentPage; } ?>">&raquo;</a></li>
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
						<span class="card-title activator grey-text text-darken-4"><i title="Screenshot" class="material-icons right">image</i></span>
						<p><a href="index.php?p=single&amp;id=<?= $sheet->getId(); ?>">Voir la fiche complète</a></p>
					</div>
					<div class="card-reveal">
						<span class="card-title grey-text text-darken-4 center"><?= htmlspecialchars($sheet->getTitle()); ?><i class="material-icons right">close</i></span>
							<img id="card-reveal-screenshot" src="public/img/<?= ($sheet->getScreenshot()); ?>" alt="<?= htmlspecialchars($sheet->getTitle()); ?>"/>
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
</div>