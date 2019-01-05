<?php

require_once('includes/template-loader.php');

class UsersController
{
    // La page inscription/connexion de l'espace membres
    public function executeUsersSpace() {
		return load_template('front/users.php', array());
    }
    
    // La page inscription
    public function executeUserRegister() {
        if(isset($_POST['submit'])){
            $pseudo = htmlspecialchars(trim($_POST['pseudo']));
            $email = htmlspecialchars(trim($_POST['email']));
            $pass = sha1(htmlspecialchars(trim($_POST['pass'])));
    
            if(email_taken($email) == 1){
                $error_email = "L'adresse email est déjà utilisée...";
            }else{
                register($pseudo, $email, $pass);
                $_SESSION['chat'] = $pseudo;
                header("Location:index.php?page=chat");
            }
        }
        return load_template('front/register.php', array());
    }

    // La page connexion
    public function executeUserLogin() {
        if(isset($_POST['submit'])){
            $pseudo = htmlspecialchars(trim($_POST['pseudo']));
            $pass = sha1(htmlspecialchars(trim($_POST['pass'])));
    
            if(user_login($email, $pass) == 1){
                $_SESSION['chat'] = $pseudo;
                header("Location:index.php?page=chat");
            }else{
                $error_user_not_found = "L'adresse email ou le mot de passe est incorrect";
            }
    
    
        }
        return load_template('front/userlogin.php', array());
    }
}