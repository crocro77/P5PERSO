<br />
<div id="register" class="container grey lighten-3 center"> 
    <h2>Page d'inscription</h2>
    <a class="btn btn-default btn-sm" href="index.php">Retour à l'accueil</a>
        <div id="formulaire">
             
            <!-- <p id="retour_inscription"> <>?php echo $_GET['reponse']; ?> </p> -->
             
            <form action="" method="post">
                <label for="pseudo">Pseudo</label><input type="text" name="pseudo" id="pseudo" /><br/>
                <label for="pass">Mot de passe (6 caractères minimum)</label><input type="password" name="pass" id="pass"/><br/>
                <label for="passcheck">Retapez votre mot de passe</label><input type="password" name="passcheck" id="passcheck"/><br/>
                <label for="email">Adresse email</label><input type="text" name="email" id="email"/><br/>
                <input type="submit" class="btn btn-default btn-sm" value="S'inscrire"/>
            </form>
        </div>
</div>