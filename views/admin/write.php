<div id="write" class="grey lighten-3">
<?php 
// Si l'on édite un chapitre
if(isset($action) && $action == 'edit')  {
	echo '<h5>Mettre à jour la fiche</h5>';
}

// Si l'on n'est pas en train d'éditer un chapitre. 
if(!isset($action)) {
	echo '<p>Vous pouvez rédiger dès à présent une nouvelle fiche.</p>';
}

if(isset($_SESSION['flash'])) {
	include('includes/flash-msg.php');
}

?>

<?php
$repopulateTitle = '';
$repopulateContent = '';
$repopulateDeveloper = '';
$repopulatePublisher = '';
$repopulateReleaseDate = '';
$repopulateGenre = '';
$repopulateTrackname = '';
if(isset($_POST['title']) || isset($_POST['content']) || isset($_POST['developer']) || isset($_POST['publisher']) || isset($_POST['release_date']) || isset($_POST['genre']) || isset($_POST['trackname']))
{
	$repopulateTitle = $_POST['title'];
	$repopulateContent = $_POST['content'];
	$repopulateDeveloper = $_POST['developer'];
	$repopulatePublisher = $_POST['publisher'];
	$repopulateReleaseDate = $_POST['release_date'];
	$repopulateGenre = $_POST['genre'];
	$repopulateGenre = $_POST['trackname'];
}
?>

<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="title">Titre </label>
		<input type="text" name="title" class="form-control" value="<?php if(isset($action) && $action == 'edit') echo $sheet->getTitle(); else echo $repopulateTitle ?>">
	</div>
	<div class="form-group">
		<label for="author">Auteur </label>
		<input type="text" name="author" class="form-control" value="<?php if(isset($_GET['action']) && $_GET['action'] == 'edit') echo $sheet->getAuthor(); else echo "ntonyyy" ?>" />
	</div>
	<div class="form-group">
		<label for="developer">Développeur </label>
		<input type="text" name="developer" class="form-control" value="<?php if(isset($action) && $action == 'edit') echo $sheet->getDeveloper(); else echo $repopulateDeveloper ?>" />
	</div>
	<div class="form-group">
		<label for="publisher">Editeur </label>
		<input type="text" name="publisher" class="form-control" value="<?php if(isset($action) && $action == 'edit') echo $sheet->getPublisher(); else echo $repopulatePublisher ?>" />
	</div>
	<div class="form-group">
		<label for="release_date">Année de sortie </label>
		<input type="number" min="1990" max="1997" name="release_date" class="form-control" value="<?php if(isset($action) && $action == 'edit') echo $sheet->getReleaseDate(); else echo $repopulateReleaseDate ?>" />
	</div>
	<div class="form-group">
		<label for="genre">Genre </label>
		<input type="text" name="genre" class="form-control" value="<?php if(isset($action) && $action == 'edit') echo $sheet->getGenre(); else echo $repopulateGenre ?>" />
	</div>
	<div class="form-group">
		<label for="content">Contenu </label>
		<textarea name="content" class="form-control"><?php if(isset($action) && $action == 'edit') echo $sheet->getContent(); else echo $repopulateContent ?></textarea>
	</div>
	<br />
	<img id="output_cover_image" width="25%" height="25%"/>
	<div class="col s12">
        <div class="btn btn-black waves-effect waves-light input-field file-field col s3">
			<input type="file" name="file" onchange="preview_cover_image(event)">
    		<input type="submit" value="Cover de la fiche" name="submit">
        </div>
	</div>
	
	<img id="output_screenshot_image" width="25%" height="25%"/>
	<div class="col s12">
        <div class="btn btn-black waves-effect waves-light input-field file-field col s3">
			<input type="file" name="file3" onchange="preview_screenshot_image(event)">
    		<input type="submit" value="Screenshot de la fiche" name="submit">
        </div>
    </div>

	<div class="col s12">
        <div class="btn btn-black waves-effect waves-light input-field file-field col s3">
			<input type="file" name="file2">
    		<input type="submit" value="Track bonus de l'OST" name="submit">
        </div>
    </div>
	<div class="form-group">
		<label for="trackname">Nom de la track</label>
		<input type="text" name="trackname" class="form-control" value="<?php if(isset($action) && $action == 'edit') echo $sheet->getTrackName(); else echo $repopulateTrackname ?>" />
	</div>
	<br />
	<?php
	if(isset($action) && $action == 'edit') {
		?>
		<input type="hidden" name="id" value="<?= $sheet->getId(); ?>" />
		<button type="submit" class="btn btn-warning">Mettre à jour</button>
		<?php
	}
	else {
		?>
		<button type="submit" class="btn btn-publish">Publier</button>
		<?php
	}
	?>
</form>
</div>

<script src="//cloud.tinymce.com/stable/tinymce.min.js?apiKey=c851wd1npuo4c59ed6f7fp6doripcdhfdi1ltt9hpr29wt3x"></script>
<script type="text/javascript" src="public/js/tinymce.js"></script>
<script type="text/javascript" src="public/js/preview_image.js"></script>
