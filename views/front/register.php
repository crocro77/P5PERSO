<br />
<div class="container grey lighten-3">
	<div class="row">
		<div class="class col l4 m6 s12 offset-l4 offset-m3">
            <br />
            <div class="center">
                <a class="btn btn-default btn-sm" href="index.php">Retour à l'accueil</a>
            </div>
			<h2 class="center-align">Inscription</h2>
			<form action="index.php?p=register&action=memberregister" method="post">
				<div class="row">
					<div class="input-field col s12">
						<label for="pseudo">Pseudo</label>
						<input class="form-control" type="text" name="pseudo" id="pseudo"  />
					</div>
                    <div class="input-field col s12">
						<label for="email">Email</label>
						<input class="form-control" type="email" name="email" id="email"  />
					</div>
					<div class="input-field col s12">
						<label for="pass">Mot de passe</label>
						<input class="form-control" type="password" name="pass" id="pass"  />
					</div>
				</div>

				<div class="center">
					<button type="submit" name="submit" class="waves-effect waves-light btn btn-default btn-sm">S'inscrire</button>
				</div>
                <br />
			</form>
		</div>
	</div>
</div>