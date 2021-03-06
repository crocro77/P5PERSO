<?php

class AdminController extends Controller
{
	public function __construct()
	{
		parent::__construct();	
		if(!isset($_SESSION['username']) OR isset($_SESSION['username']) AND $_SESSION['username'] !== 'ntonyyy') {
			header('Location: '.generateURL('login'));
			exit();
		}
	}
	
	public function executeAdminDashboard()
	{
		$selectedTab = 'dashboard';

		if (isset($_GET['tab'])) {
			$selectedTab = $_GET['tab'];
		}

		$commentManager = new Comment();
        $listOfComments = $commentManager->getAllComments();
		$signaledComments = $commentManager->getSignaledComments();
		$userManager = new Users();
		$userNumber = $userManager->count();
		$chatManager = new Chat();
		$chatMsgNumber = $chatManager->count();

		echo $this->twig->render('admin/admin.twig',
			[
				'chat' => $chatMsgNumber,
				'users' => $userNumber,
				'datasheet' => Datasheet::getListAlpha(),
				'comment' => Comment::getAllComments(),
				'listOfComments' => $listOfComments,
				'selectedTab' => $selectedTab,
				'signaledComments' => $signaledComments, 
				'aboutDescription' => About::getAboutDescription(),
			]);
	}
	
	public function executeCreateSheet()
    {
		if(isset($_POST['title']) && isset($_POST['author']) && isset($_POST['content']) && isset($_POST['developer']) && isset($_POST['publisher']) && isset($_POST['release_date']) && isset($_POST['genre'])){
			$errors = '';
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
			if (empty($errors)) {
				$cover = "";
				$track = "";
				$screenshot = "";
				$sheet = new Datasheet();
				$sheet->setTitle($_POST['title']);
				$sheet->setContent($_POST['content']);
				$sheet->setAuthor($_POST['author']);
				$sheet->setDeveloper($_POST['developer']);
				$sheet->setPublisher($_POST['publisher']);
				$sheet->setReleaseDate($_POST['release_date']);
				$sheet->setGenre($_POST['genre']);
				if (isset($_FILES['file'])) {
					$cover = uploadCover();
					$sheet->setCover($cover);
				}
				if (isset($_FILES['file2'])) {
					$track = uploadTrack();
					$sheet->setTrack($track);
				}
				if (isset($_FILES['file3'])) {
					$screenshot = uploadScreenshot();
					$sheet->setScreenshot($screenshot);
				}
				if ($_POST['trackname']) {
					$sheet->setTrackName($_POST['trackname']);
				}
				$sheet->addSheet($sheet);
				header('Location: '.generateURL('admin?tab=list'));
			} else {
				?>
				<div class="card red">
					<div class="card-content white-text">
						<?php echo $errors."<br/>"; ?>
					</div>
				</div>
				<?php
			}	
		}
		
		echo $this->twig->render('admin/admin.twig', ['selectedTab' => 'write']);
	}

	public function executeUpdateSheet()
	{
		$sheetManager = new Datasheet();
		if(isset($_GET['id'])) {
			$sheet = $sheetManager->getUnique($_GET['id']);
			if($sheet) {
				if(isset($_POST['title']) && isset($_POST['content']) && isset($_POST['author']) && isset($_POST['developer']) && isset($_POST['publisher']) && isset($_POST['release_date']) && isset($_POST['genre']) && isset($_POST['trackname'])) {
					$sheet->setTitle($_POST['title']);
					$sheet->setContent($_POST['content']);
					$sheet->setAuthor($_POST['author']);
					$sheet->setDeveloper($_POST['developer']);
					$sheet->setPublisher($_POST['publisher']);
					$sheet->setReleaseDate($_POST['release_date']);
					$sheet->setGenre($_POST['genre']);
					$sheet->setTrackName($_POST['trackname']);
					if (isset($_FILES['file'])) {
						$cover = uploadCover();
					}
					if (isset($_FILES['file2'])) {
						$track = uploadTrack();
					}
					if (isset($_FILES['file3'])) {
						$screenshot = uploadScreenshot();
					}
					if(!empty($cover)) {
						$sheet->setCover($cover);
					}
					if(!empty($screenshot)) {
						$sheet->setScreenshot($screenshot);
					}
					if(!empty($track)) {
						$sheet->setTrack($track);
					}
					if ($_POST['trackname']) {
						$sheet->setTrackName($_POST['trackname']);
					}
					$sheet->updateSheet();
					header('Location: '.generateURL('admin?tab=list'));
				}

				$selectedTab = 'write';
				$action = 'edit';

				echo $this->twig->render('admin/admin.twig', ['selectedTab' => $selectedTab, 'sheet' => $sheet, 'action' => $action]);
			} else {
				header('Location: '.generateURL('admin?tab=list'));
			}
		}
	}

	public function executeDeleteSheet()
	{
		$sheetManager = new Datasheet();
		$sheetManager->deleteSheet();
		header('Location: '.generateURL('admin?tab=list'));
	}

	public function executeValidateComment()
	{
		if(isset($_GET['commentId'])) {
			$commentManager = new Comment();
			$commentManager->validateComment($_GET['commentId']);
			header('Location: '.generateURL('admin?tab=comments'));
		}
	}

	public function executeDeleteComment()
	{
		if(isset($_GET['commentId'])) {
			$commentManager = new Comment();
			$commentManager->deleteComment($_GET['commentId']);
			header('Location: '.generateURL('admin?tab=comments'));
		}
	}

	public function executeSeenComment()
	{
		if(isset($_GET['commentId'])) {
			$commentManager = new Comment();
			$commentManager->seenComment($_GET['commentId']);
			header('Location: '.generateURL('admin?tab=comments'));
		}
	}
}