<?php

class UsersController extends Controller
{
    public function executeUsersSpace()
    {
		if(isset($_SESSION['username'])) {
			header('Location: '.generateURL('member?tab=dashboard'));
		}

		if(isset($_SESSION['username']) AND $_SESSION['username'] == 'ntonyyy') {
			header('Location: '.generateURL('admin?tab=dashboard'));
		}

		echo $this->twig->render('front/users.twig');
    }
    
    public function executeNewUser()
    {
        if(isset($_POST['submit'])) {
            $pseudo = htmlspecialchars(trim($_POST['pseudo']));
            $email = htmlspecialchars(trim($_POST['email']));
            $pass = sha1(htmlspecialchars(trim($_POST['pass'])));
			$error_email = '';
            if(Users::email_taken($email) == 0){
				Users::register($pseudo, $email, $pass);
				?>
				<div class="card green">
					<div class="card-content white-text">
						<?php
							echo "Inscription confirmée ! Bienvenue ! <a class='btn btn-default btn-sm' href='connection'>Connectez-vous</a> pour continuer.";
						?>
					</div>
				</div>
				<?php
            } else {
				$error_email = "L'adresse email est déjà utilisée...";
				?>
				<div class="card red">
					<div class="card-content white-text">
						<?php
							echo $error_email."<br/>";
						?>
					</div>
				</div>
				<?php
			}
        }
		echo $this->twig->render('front/register.twig');
    }

    public function executeUserLogin()
	{
		if(isset($_POST['submit'])){
            $pseudo = htmlspecialchars(trim($_POST['pseudo']));
            $pass = sha1(htmlspecialchars(trim($_POST['pass'])));

			$errors = [];

			if(empty($pseudo) || empty($pass)){
				$errors['empty'] = "Tous les champs n'ont pas été remplis !";
			} elseif (Users::user_login($pseudo, $pass) == 0){
				$errors['exist']  = "Ce membre n'existe pas ou le mot de passe est erronné !";
			}

			if(!empty($errors)){
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
			} else {
				$_SESSION['username'] = $pseudo;
				header('Location: '.generateURL('member?tab=dashboard'));
			}
		}
		echo $this->twig->render('front/userlogin.twig');
	}

	public function executeUserDashboard()
	{
		if(!isset($_SESSION['username'])) {
			header('Location: '.generateURL('user'));
			exit();
		}

		$selectedTab = 'dashboard';

		if (isset($_GET['tab'])) {
			$selectedTab = $_GET['tab'];
		}

		echo $this->twig->render('user/user.twig',
			[
				'datasheet' => Datasheet::getListAlpha(), 
				'selectedTab' => $selectedTab
			]);	
	}

	public function executeMemberCreateSheet()
    {
		if(!isset($_SESSION['username'])) {
			header('Location: '.generateURL('user'));
			exit();
		}
		
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
				header('Location: '.generateURL('home'));
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
		
		echo $this->twig->render('user/user.twig', ['selectedTab' => 'memberwrite']);
	}
}