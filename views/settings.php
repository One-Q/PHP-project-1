		<?php
		if($notification != ''){ ?>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<?php echo $notification ?>
			</div>	
		</div>
		<?php } ?>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
				  <!-- Default panel contents -->
				   <div class="panel-heading"><h4>Paramètres</h4></div>
				</div>
				<p>Les dates doivent être sous la forme dd/mm/yyyy</p>
			</div>
		</div>
			<div class="row">
			<form action="" method="post">
				<div class="col-md-4">
					<p>
						<label for="intership_date_begin">Début des stages : </label>
						<input class="form-control" type="text" name="internship_date_begin" id="intership_date_begin" placeholder="Date du début des stages" value="<?php echo $settings[5]; ?>" >
					</p>
				</div>
				<div class="col-md-4">
					<p>
						<label for="intership_date_end">Fin des stages : </label>
						<input class="form-control" type="text" name="internship_date_end" id="intership_date_end" placeholder="Date de fin des stages" value="<?php echo $settings[7]; ?>">
					</p>
				</div>
				<div class="col-md-4">
					<p>
						<label for="internship_deadline">Date butoire : </label>
						<input class="form-control" type="text" name="internship_deadline" id="internship_deadline" placeholder="Date butoire" value="<?php echo $settings[9]; ?>">
					</p>
				</div>
				<div class="col-md-4">
					<p>
						<label for="password_teacher">Mot de passe par défaut des professeur : </label>
						<input class="form-control" type="text" name="password_teacher" id="password_teacher" placeholder="Mot de passe par défaut des professeur" value="<?php echo $settings[1]; ?>">
						<input type="hidden" name="old_password_teacher" value="<?php echo $settings[1]; ?>">
					</p>
				</div>
				<div class="col-md-4">
					<p>
						<label for="password_student">Mot de passe par défaut des étudiants : </label>
						<input class="form-control" type="text" name="password_student" id="password_student" placeholder="Mot de passe par défaut des étudiants" value="<?php echo $settings[3]; ?>">
						<input type="hidden" name="old_password_student" value="<?php echo $settings[3]; ?>">
					</p>
				</div>
				<div class="col-md-12">
					<button type="submit" name="update" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Modifier</button>
				</div>
			</form>
			</div>

