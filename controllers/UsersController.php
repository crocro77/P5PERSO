<?php

// require_once('includes/template-loader.php');

class UsersController extends Controller
{
    public function executeUsersSpace()
    {
		if(isset($_SESSION['username'])) {
			header("Location:index.php?p=member&tab=dashboard");
		}

		// return load_template('front/users.php', array());
		echo $this->twig->render('front/users.twig');
    }
    
    public function executeNewUser()
    {
        if(isset($_POST['submit'])) {
            $pseudo = htmlspecialchars(trim($_POST['pseudo']));
            $email = htmlspecialchars(trim($_POST['email']));
            $pass = sha1(htmlspecialchars(trim($_POST['pass'])));
    
            if(Users::email_taken($email) == 1){
                $error_email = "L'adresse email est déjà utilisée...";
            }else{
                Users::register($pseudo, $email, $pass);
			}
			header("Location:index.php?p=connection");
			
        }
		
		// return load_template('front/register.php', array());
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
				header("Location:index.php?p=member&tab=dashboard");
			}
		}

		// return load_template('front/userlogin.php', array());
		echo $this->twig->render('front/userlogin.twig');
	}

	public function executeUserDashboard()
	{
		$selectedTab = 'dashboard';

		if (isset($_GET['tab'])) {
			$selectedTab = $_GET['tab'];
		}

		$sheetManager = new Datasheet();
		$listOfsheets = $sheetManager->getListAlpha();

		// return load_template('user/user.php', array('listOfsheets' => $listOfsheets,'selectedTab' => $selectedTab));
		echo $this->twig->render('user/user.twig', ['datasheet' => Datasheet::getListAlpha(), 'listOfsheets' => $listOfsheets,'selectedTab' => $selectedTab]);
	}

	public function executeMemberCreateSheet()
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
				$sheet = new Datasheet();
				$sheet->setTitle($_POST['title']);
				$sheet->setContent($_POST['content']);
				$sheet->setAuthor($_POST['author']);
				$sheet->setDeveloper($_POST['developer']);
				$sheet->setPublisher($_POST['publisher']);
				$sheet->setReleaseDate($_POST['release_date']);
				$sheet->setGenre($_POST['genre']);
				include 'includes/file-upload.php';
				$sheet->setCover($cover);
				$sheet->setScreenshot($screenshot);
				$sheet->setTrack($track);
				if ($_POST['trackname']) {
					$sheet->setTrackName($_POST['trackname']);
				}
				$sheet->addSheet($sheet);
				header("Location:index.php");
			} else {
				$_SESSION['flash']['error'] = '<ul>' . $errors . '</ul>';
			}	
		}
		
		// return load_template('user/user.php', array('selectedTab' => 'write'));
		echo $this->twig->render('user/usertest.twig');
	}

	public function executeDeleteUser()
	{
		$userManager = new Users();
		$userManager->deleteUser();
		// session_destroy();
		header("Location:index.php?p=user");
	}
}