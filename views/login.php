		<section id="contenu">
			<h2>Login vers la zone d'administration</h2>
			<p>Bienvenue sur la page de login.</p>
			<div id="notification"><?php echo $notification ?></div>
			<div class="formulaire">
				<form action="index.php?action=login" method="post">
				<p>Login : <input type="text" name="login" /></p>
				<p>Mot de passe : <input type="password" name="password" /></p>
				<p><input type="submit" name="form_contact" value="Connexion"></p>
				</form>
			</div>
		</section>
