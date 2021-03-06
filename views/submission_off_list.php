		<?php if($notification != ''){ ?>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<?php echo $notification ?>
			</div>	
		</div>
		<?php } ?>
		
		<form action="index.php?action=submission_internship" method="POST" id="form_firm">
			<div class="page-header">
			  	<h1>Soumission de stage</h1>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="page-header">
					  	<h3>Informations sur l'étudiant</h3>
					</div>
					<p>
						<label>Nom : </label>
						<span><?php echo $student->getSurname() ?></span>
					</p>
					<p>
						<label >Prénom : </label>
						<span><?php echo $student->getFirstname() ?></span>
					</p>
					<p>
						<label>Mail : </label>
						<span><?php echo $student->getMail() ?></span>
					</p>
					<p>
						<label for="student_phone">Numéro : </label>
						<input class="form-control" type="text" name="student_phone" id="student_phone" placeholder="Numéro de téléphone">
					</p>
					<p>
						<label for="sex">Sexe : </label>
						<select class="form-control" name="sex">
							<option value="M">Homme</option>
							<option value="F">Femme</option>
						</select>
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="page-header">
					  	<h3>Informations sur la société</h3>
					</div>
					<p>
						<label for="firm_name">Nom de la société : </label>
						<input class="form-control" type="text" name="firm_name" id="firm_name" placeholder="Nom de la société">
					</p>
					<p>
						<label for="firm_abbreviation">Abbréviation de la société : </label>
						<input class="form-control" type="text" name="firm_abbreviation" id="firm_abbreviation" placeholder="Abbreviation de la société">
					</p>
					<p>
						<label for="street">Rue : </label>
						<input class="form-control" type="text" name="street" id="street" placeholder="Rue">
					</p>
					<p>
						<label for="number">Numéro : </label>
						<input class="form-control" type="number" name="number" id="number" placeholder="Numero">
					</p>
					<p>
						<label for="zip_code">Code postal : </label>
						<input class="form-control" type="number" name="zip_code" id="zip_code" placeholder="Code postal">
					</p>
					<p>
						<label for="firm_phone">Numéro de téléphone : </label>
						<input class="form-control" type="text" name="firm_phone" id="firm_phone" placeholder="Numéro de téléphone">
					</p>
				</div>
				<div class="col-md-6">
					<div class="page-header">
					  	<h3>Informations sur le promoteur</h3>
					</div>
					<p>
						<label for="promoter_surname">Nom du promoteur : </label>
						<input class="form-control" type="text" name="promoter_surname" id="promoter_surname" placeholder="Nom du promoteur">
					</p>
					<p>
						<label for="promoter_firstname">Prénom du promoteur : </label>
						<input class="form-control" type="text" name="promoter_firstname" id="promoter_firstname" placeholder="Prénom du promoteur">
					</p>
					<p>
						<label for="promoter_mail">Mail du promoteur : </label>
						<input class="form-control" type="email" name="promoter_mail" id="promoter_mail" placeholder="Mail du promoteur">
					</p>
					<p>
						<label for="promoter_gsm">Numéro de gsm : </label>
						<input class="form-control" type="text" name="promoter_gsm" id="promoter_gsm" placeholder="Numéro de gsm">
					</p>
					<p>
						<label for="promoter_phone">Numéro de téléphone : </label>
						<input class="form-control" type="text" name="promoter_phone" id="promoter_phone" placeholder="Numéro de téléphone">
					</p>
					<p>
						<label for="promoter_service">Service du promoteur : </label>
						<input class="form-control" type="text" name="promoter_service" id="promoter_service" placeholder="Service du promoter">
					</p>
					<p>
						<label for="promoter_job">Travail du promoteur : </label>
						<input class="form-control" type="text" name="promoter_job" id="promoter_job" placeholder="Travail du promoteur">
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="page-header">
					  	<h3>Informations sur la personne contact</h3>
					</div>
					<p>
						<label for="contact_surname">Nom du contact : </label>
						<input class="form-control" type="text" name="contact_surname" id="contact_surname" placeholder="Nom du contact">
					</p>
					<p>
						<label for="contact_firstname">Prénom du contact : </label>
						<input class="form-control" type="text" name="contact_firstname" id="contact_firstname" placeholder="Prénom du contact">
					</p>
					<p>
						<label for="contact_mail">Mail du contact : </label>
						<input class="form-control" type="email" name="contact_mail" id="contact_mail" placeholder="Mail du contact">
					</p>
					<p>
						<label for="contact_gsm">Numéro de gsm : </label>
						<input class="form-control" type="text" name="contact_gsm" id="contact_gsm" placeholder="Numéro de gsm">
					</p>
					<p>
						<label for="contact_phone">Numéro de téléphone : </label>
						<input class="form-control" type="text" name="contact_phone" id="contact_phone" placeholder="Numéro de téléphone">
					</p>
					<p>
						<label for="contact_service">Service du contact : </label>
						<input class="form-control" type="text" name="contact_service" id="contact_service" placeholder="Service du promoter">
					</p>
					<p>
						<label for="contact_job">Travail du contact : </label>
						<input class="form-control" type="text" name="contact_job" id="contact_job" placeholder="Travail du promoteur">
					</p>
				</div>
				<div class="col-md-6">
					<div class="page-header">
					  	<h3>Informations sur le stage</h3>
					</div>
				  	<p>
						<label for="objective">Objectif du stage : </label>
						<textarea class="form-control" rows="3" id="objective" name="objective"></textarea>
					</p>
					<p>
						<label for="work_description">Brève description du travail : </label>
						<textarea class="form-control" rows="3" id="work_description" name="work_description"></textarea>
					</p>
					<p>
						<label for="work_environment">Brève description de l'environnement : </label>
						<textarea class="form-control" rows="3" id="work_environment" name="work_environment"></textarea>
					</p>
					<p>
						<label for="remark">Remarques : </label>
						<textarea class="form-control" rows="3" id="remark" name="remark"></textarea>
					</p>
				</div>
			</div>
			<button type="submit" name="submission_internship" class="btn btn-primary">Soumettre</button>
		</form>