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
		if (!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['content'])) {
			$title = $_POST['title'];
			$author = $_POST['author'];
			$content = $_POST['content'];
			$cover = "";

			$id = (!empty($_POST['id']) ? $_POST['id'] : null);

			// upload de l'image de chapitre
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
					$key = md5($_FILES['file']['name']) . time() . $extension;
					move_uploaded_file($_FILES['file']['tmp_name'], 'public/img/' . $key);
					$cover = $key;
				}
			}

			if (isset($_POST['id'])) {
				$sheet = new Datasheet();
				$sheet->update($title, $author, $content, $id);
				if ($cover) {
					$cover->updateImage($cover, $id);
					header("Location:index.php");
				} else {
					header("Location:index.php");
				}
			} else {
				$sheet = new Datasheet();
				$sheet->setTitle($title);
				$sheet->setContent($content);
				$sheet->setAuthor($author);
				if ($cover) {
					$cover->setCover($cover);
				}
				$sheet->add($sheet);
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