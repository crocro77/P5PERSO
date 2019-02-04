<?php

class AuthentificationController extends Controller
{
	public function executeLogin()
	{
		if(isset($_POST['submit'])){
			$username = htmlspecialchars(trim($_POST['username']));
			$password = htmlspecialchars(trim($_POST['password']));

			$errors = [];

			if(empty($username) || empty($password)){
				$errors['empty'] = "Tous les champs n'ont pas été remplis!";
			} elseif (Admin::isAdmin($username,$password) == 0){
				$errors['exist']  = "Cet administrateur n'existe pas!";
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
				$_SESSION['username'] = $username;
				header("Location:admin");
			}
		}

		echo $this->twig->render('admin/login.twig');
	}

	public function executeLogout()
	{
		session_destroy();
		header('Location: home');
    }
}