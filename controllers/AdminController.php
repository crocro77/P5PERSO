<?php

require_once('includes/template-loader.php');

class AdminController
{
    public function executeLogin()
	{
		if (isset($_POST['username']) && $_POST['username'] == 'ntonyyy' && isset($_POST['password']) && $_POST['password'] == 'admin') {
			$_SESSION['username'] = $_POST['username'];
			header('Location: index.php?p=admin');
		}
		return load_template('admin/login.php', array());
    }
    
    public function executeAdminPanel()
	{

		$selectedTab = 'dashboard';

		$sheet = null;

		// onglet de l'espace admin
		if (isset($_GET['tab'])) {
			$selectedTab = $_GET['tab'];
		}

		// ajout et maj d'un contenu dans la bdd //
		$errors = '';
		if (!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['content']) && !empty($_POST['developer']) && !empty($_POST['publisher']) && !empty($_POST['release_date']) && !empty($_POST['genre']) && !empty($_POST['trackname'])) {
			$title = $_POST['title'];
			$author = $_POST['author'];
			$content = $_POST['content'];
			$developer = $_POST['developer'];
			$publisher = $_POST['publisher'];
			$release_date = $_POST['release_date'];
			$genre = $_POST['genre'];
			$cover = "";
			$track = "";
			$screenshot = "";
			$trackname = $_POST['trackname'];

			$id = (!empty($_POST['id']) ? $_POST['id'] : null);

			// upload de la cover de la fiche
			if (isset($_FILES['file'])) {
				$file = $_FILES['file']['name'];
				$max_size = 2000000;
				$size = $_FILES['file']['size'];
				$extensions = array('.png', '.jpg', '.jpeg', '.gif', '.PNG', '.JPG', '.JPEG', '.GIF');
				$extension = strrchr($file, '.');

				if (!in_array($extension, $extensions)) {
					$error = "Cette image n'est pas valable";
				}

				if ($size > $max_size) {
					$error = "Le fichier est trop volumineux";
				}

				if (!isset($error)) {
					$coverKey = md5($_FILES['file']['name']) . time() . $extension;
					move_uploaded_file($_FILES['file']['tmp_name'], 'public/img/' . $coverKey);
					$cover = $coverKey;
				}
			}

			// upload de la track de la fiche
			if (isset($_FILES['file2'])) {
				$file = $_FILES['file2']['name'];
				$max_size = 2000000;
				$size = $_FILES['file2']['size'];
				$extensions = array('.mp3', '.MP3');
				$extension = strrchr($file, '.');

				if (!in_array($extension, $extensions)) {
					$error = "Cette musique n'est pas valable";
				}

				if ($size > $max_size) {
					$error = "Le fichier est trop volumineux";
				}

				if (!isset($error)) {
					$trackKey = md5($_FILES['file2']['name']) . time() . $extension;
					move_uploaded_file($_FILES['file2']['tmp_name'], 'public/mp3/' . $trackKey);
					$track = $trackKey;
				}
			}

			// upload du screenshot de la fiche
			if (isset($_FILES['file3'])) {
				$file = $_FILES['file3']['name'];
				$max_size = 2000000;
				$size = $_FILES['file3']['size'];
				$extensions = array('.png', '.jpg', '.jpeg', '.gif', '.PNG', '.JPG', '.JPEG', '.GIF');
				$extension = strrchr($file, '.');

				if (!in_array($extension, $extensions)) {
					$error = "Cette image n'est pas valable";
				}

				if ($size > $max_size) {
					$error = "Le fichier est trop volumineux";
				}

				if (!isset($error)) {
					$screenshotKey = md5($_FILES['file3']['name']) . time() . $extension;
					move_uploaded_file($_FILES['file3']['tmp_name'], 'public/img/' . $screenshotKey);
					$screenshot = $screenshotKey;
				}
			}			

			if (isset($_POST['id'])) {
				$sheet = new Datasheet();
				$sheet->updateSheet($title, $author, $content, $developer, $publisher, $release_date, $genre, $trackname, $id);
				if ($cover) {
					$sheet->updateCover($cover, $id);
					header("Location:index.php");
				}
				if ($screenshot) {
					$sheet->updateScreenshot($screenshot, $id);
					header("Location:index.php");
				}
				if ($track) {
					$sheet->updateTrack($track, $id);
					header("Location:index.php");
				}
				if ($trackname) {
					$sheet->updateTrackName($trackname, $id);
					header("Location:index.php");
				} else {
					header("Location:index.php");
				}
			} else {
				$sheet = new Datasheet();
				$sheet->setTitle($title);
				$sheet->setContent($content);
				$sheet->setAuthor($author);
				$sheet->setDeveloper($developer);
				$sheet->setPublisher($publisher);
				$sheet->setReleaseDate($release_date);
				$sheet->setGenre($genre);
				if ($cover) {
					$sheet->setCover($cover);
				}
				if ($track) {
					$sheet->setTrack($track);
				}
				if ($screenshot) {
					$sheet->setScreenshot($screenshot);
				}
				if ($trackname) {
					$sheet->setTrackName($trackname);
				}
				$sheet->addSheet($sheet);
				header("Location:index.php");
			}
		} elseif (!empty($_POST)) {
			if (empty($_POST['title'])) {
				$errors .= '<li>Le titre est obligatoire.</li>';
			}
			if (empty($_POST['author'])) {
				$errors .= '<li>L\'auteur est obligatoire.</li>';
			}
			if (empty($_POST['content'])) {
				$errors .= '<li>Le contenu est obligatoire.</li>';
			}
			if (empty($_POST['developer'])) {
				$errors .= '<li>Le développeur est obligatoire.</li>';
			}
			if (empty($_POST['publisher'])) {
				$errors .= '<li>L\'éditeur est obligatoire.</li>';
			}
			if (empty($_POST['release_date'])) {
				$errors .= '<li>L\'année de sortie est obligatoire.</li>';
			}
			if (empty($_POST['genre'])) {
				$errors .= '<li>Le genre est obligatoire.</li>';
			}
			if (empty($_POST['trackname'])) {
				$errors .= '<li>Le nom de la track est obligatoire.</li>';
			}

			$_SESSION['flash']['error'] = '<ul>' . $errors . '</ul>';
		}

		// suppression et edition des contenus //
		$sheetManager = new Datasheet();
		if (isset($_GET['action'])) {
			if ($_GET['action'] == 'delete') {
				$sheetManager->deleteSheet();
				header("Location:index.php?p=admin&tab=list");
			} elseif ($_GET['action'] == 'edit') {
				$sheet = $sheetManager->getUnique($_GET['id']);
			}
		}

		// gestionnaire des commentaires
		$commentManager = new Comment();
		if (isset($_GET['action'])) {
			if ($_GET['action'] == 'validateComment') {
				$commentManager->validateComment($_GET['commentId']);
			} elseif ($_GET['action'] == 'deleteComment') {
				$commentManager->deleteComment($_GET['commentId']);
			} elseif ($_GET['action'] == 'seenComment') {
				$commentManager->seenComment($_GET['commentId']);
			}
		}

		$listOfsheets = $sheetManager->getList();
		$listOfComments = $commentManager->getAllComments();
		$signaledComments = $commentManager->getSignaledComments();

		return load_template('admin/admin.php', array('listOfsheets' => $listOfsheets, 'selectedTab' => $selectedTab, 'sheet' => $sheet, 'signaledComments' => $signaledComments, 'listOfComments' => $listOfComments));
	}
	
}