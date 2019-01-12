<?php

require_once('includes/template-loader.php');

class UsersController
{
    public function executeUsersSpace()
    {
		return load_template('front/users.php', array());
    }
    
    public function executeUserRegister()
    {
        return load_template('front/register.php', array());
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
        }
        header("Location:index.php?page=userlogin");
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
				header("Location:index.php");
			}
		}

		return load_template('front/userlogin.php', array());
	}
}