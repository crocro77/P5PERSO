<?php

require_once('includes/template-loader.php');

class UsersController
{
    // La page inscription/connexion de l'espace membres
    public function executeUsersSpace()
    {
		return load_template('front/users.php', array());
    }
    
    // La page inscription
    public function executeUserRegister()
    {
        return load_template('front/register.php', array());
    }

    public function executeAddUser()
    {
        if(isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['pass'])) {
        // if(isset($_POST['submit'])){
            $pseudo = htmlspecialchars(trim($_POST['pseudo']));
            $email = htmlspecialchars(trim($_POST['email']));
            $pass = sha1(htmlspecialchars(trim($_POST['pass'])));
    
            if(Users::email_taken($email) == 1){
                $error_email = "L'adresse email est déjà utilisée...";
            }else{
                Users::register($pseudo, $email, $pass);
            }
        }
        $_SESSION['chat'] = $pseudo;
        header("Location:index.php?page=chat");
    }

    // La page connexion
    public function executeUserLogin()
    {
        return load_template('front/userlogin.php', array());
    }

    public function executeUserAccess()
    {
        if(isset($_POST['pseudo']) && isset($_POST['pass'])){
            $pseudo = htmlspecialchars(trim($_POST['pseudo']));
            $pass = sha1(htmlspecialchars(trim($_POST['pass'])));
    
            if(Users::user_login($pseudo, $pass) == 1){
                $_SESSION['chat'] = $pseudo;
                header("Location:index.php?page=chat");
            }else{
                $error_user_not_found = "L'adresse email ou le mot de passe est incorrect";
            }    
        }
    }
}