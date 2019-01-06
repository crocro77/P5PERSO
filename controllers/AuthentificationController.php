<?php

require_once('includes/template-loader.php');

class AuthentificationController
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
				header("Location:index.php?p=admin");
			}
		}

		return load_template('admin/login.php', array());
	}

	public function executeLogout()
	{
		session_destroy();
		header('Location: index.php');
    }
}