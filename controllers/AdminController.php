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
					} else {
						?>
						<div class="card red">
							<div class="card-content white-text">
								<?php
									foreach($errors as $error){
										echo $error."<br/>";
									}
								?>
							</div>
						</div>
						<?php
					}
				}
				// upload de la track de la fiche
				if (isset($_FILES['file2'])) {
					$file = $_FILES['file2']['name'];
					$max_size = 200000000;
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
					} else {
						?>
						<div class="card red">
							<div class="card-content white-text">
								<?php
									foreach($errors as $error){
										echo $error."<br/>";
									}
								?>
							</div>
						</div>
						<?php
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
					} else {
						?>
						<div class="card red">
							<div class="card-content white-text">
								<?php
									foreach($errors as $error){
										echo $error."<br/>";
									}
								?>
							</div>
						</div>
						<?php
					}
				}			
				$sheet->setCover($cover);
				$sheet->setScreenshot($screenshot);
				$sheet->setTrack($track);
				if ($_POST['trackname']) {
					$sheet->setTrackName($_POST['trackname']);
				}
				$sheet->addSheet($sheet);
				header('Location: '.generateURL('admin?tab=list'));
			} else {
				?>
				<div class="card red">
					<div class="card-content white-text">
						<?php
							foreach($errors as $error){
								echo $error."<br/>";
							}
						?>
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
					// upload de la cover de la fiche
					if (isset($_FILES['file'])) {
						$file = $_FILES['file']['name'];
						$max_size = 2000000;
						$size = $_FILES['file']['size'];
						$extensions = array('.png', '.jpg', '.jpeg', '.gif', '.PNG', '.JPG', '.JPEG', '.GIF');
						$extension = strrchr($file, '.');
						$errors = '';
						if (!in_array($extension, $extensions)) {
							$errors = "Cette image n'est pas valable";
						}
						if ($size > $max_size) {
							$errors = "Le fichier est trop volumineux";
						}
						if (!isset($error)) {
							$coverKey = md5($_FILES['file']['name']) . time() . $extension;
							move_uploaded_file($_FILES['file']['tmp_name'], 'public/img/' . $coverKey);
							$cover = $coverKey;
						} else {
							?>
							<div class="card red">
								<div class="card-content white-text">
									<?php
										foreach($errors as $error){
											echo $error."<br/>";
										}
									?>
								</div>
							</div>
							<?php
						}
					} 
					// upload de la track de la fiche
					if (isset($_FILES['file2'])) {
						$file = $_FILES['file2']['name'];
						$max_size = 60000000;
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
						} else {
							?>
							<div class="card red">
								<div class="card-content white-text">
									<?php
										foreach($errors as $error){
											echo $error."<br/>";
										}
									?>
								</div>
							</div>
							<?php
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
						} else {
							?>
							<div class="card red">
								<div class="card-content white-text">
									<?php
										foreach($errors as $error){
											echo $error."<br/>";
										}
									?>
								</div>
							</div>
							<?php
						}
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

	// public function executeDeleteAllSheet()
	// {
	// 	$sheetManager = new Datasheet();
	// 	$sheetManager->deleteAll();
	// 	header('Location: '.generateURL('admin?tab=list'));
	// }

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

	// public function executeDeleteAllComments()
	// {
	// 	$commentManager = new Comment();
	// 	$commentManager->deleteAll();
	// 	header('Location: '.generateURL('admin?tab=comments'));
	// }

	public function executeSeenComment()
	{
		if(isset($_GET['commentId'])) {
			$commentManager = new Comment();
			$commentManager->seenComment($_GET['commentId']);
			header('Location: '.generateURL('admin?tab=comments'));
		}
	}

	// public function deleteChatMessages()
	// {
	// 	$chatManager = new Chat();
	// 	$chatManager->deleteAllMessages();
	// 	header('Location: '.generateURL('admin?tab=dashboard'));
	// }
}