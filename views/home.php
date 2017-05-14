		<?php if($notification != ''){ ?>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<?php echo $notification ?>
			</div>	
		</div>
		<?php } ?>
		<div class="row text-center">
			<div class="col-md-12">
				<img id="ipl_logo" src="<?php echo CHEMIN_VUES ?>images/ipl_logo.png" alt="ipl logo">
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<form action="index.php?action=login" method="POST" class="form_user">
	 				<h3 class="text-center">Connexion</h3>
	 				<p>
	 					<label for="email">Email : </label>
	 					<input class="form-control" type="email" name="email" id="email" placeholder="Email" value="<?php if(!empty($_POST['email'])) echo $_POST['email'] ?>">
	  				</p>
	  				<p>
	 					<label for="password">Mot de passe : </label>
	 					<input class="form-control" type="password" name="password" id="password" placeholder="Mot de passe">
	  				</p>
	  				<button type="submit" name="connexion" class="btn btn-primary"><span class="glyphicon glyphicon-link"></span> Connexion</button>
	 			</form>
	 			<hr>
  				<p class="text-center">
  					<a href="index.php?action=firm">Vous êtes une entreprise ?</a>
  				</p>
			</div>
		</div>