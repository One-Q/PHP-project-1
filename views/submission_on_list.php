<?php if($notification != ''){ ?>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<?php echo $notification ?>
			</div>	
		</div>
		<?php } ?>

<form action="index.php?action=submission_internship" method="POST" id="form_firm">
	<div class="page-header">
	  	<h1>Soumettre un stage de la liste</h1>
	</div>
	<div class="row">
		<div class="col-md-12">
			<p>Veuillez compléter les informations ci-dessous</p>
		</div>
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
				<span><?php echo $internship->getFirm()->getName() ?></span>
  				<input type="hidden" name="id_internship" value="<?php echo $internship->getIdInternship() ?>">
			</p>
			<p>
				<label for="firm_abbreviation">Abbréviation de la société : </label>
				<span><?php echo $internship->getFirm()->getAbbreviation() ?></span>
			</p>
			<p>
				<label for="street">Rue : </label>
				<span><?php echo $internship->getFirm()->getStreet() ?></span>
			</p>
			<p>
				<label for="number">Numéro : </label>
				<span><?php echo $internship->getFirm()->getNumberStreet() ?></span>
			</p>
			<p>
				<label for="zip_code">Code postal : </label>
				<span><?php echo $internship->getFirm()->getZipCode() ?></span>
			</p>
			<p>
				<label for="firm_phone">Numéro de téléphone : </label>
				<span><?php echo $internship->getFirm()->getPhoneNumber() ?></span>
			</p>
		</div>
		<div class="col-md-6">
			<div class="page-header">
			  	<h3>Informations sur le promoteur</h3>
			</div>
			<p>
				<label for="promoter_surname">Nom du promoteur : </label>
				<span><?php echo $internship->getPromoter()->getSurname() ?></span>
			</p>
			<p>
				<label for="promoter_firstname">Prénom du promoteur : </label>
				<span><?php echo $internship->getPromoter()->getFirstname() ?></span>
			</p>
			<p>
				<label for="promoter_mail">Mail du promoteur : </label>
				<span><?php echo $internship->getPromoter()->getMail() ?></span>
			</p>
			<p>
				<label for="promoter_gsm">Numéro de gsm : </label>
				<span><?php echo $internship->getPromoter()->getGsm() ?></span>
			</p>
			<p>
				<label for="promoter_phone">Numéro de téléphone : </label>
				<span><?php echo $internship->getPromoter()->getPhoneNumber() ?></span>
			</p>
			<p>
				<label for="promoter_service">Service du promoteur : </label>
				<span><?php echo $internship->getPromoter()->getService() ?></span>
			</p>
			<p>
				<label for="promoter_job">Travail du promoteur : </label>
				<span><?php echo $internship->getPromoter()->getJob() ?></span>
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
				<span><?php echo $internship->getContact()->getSurname() ?></span>
			</p>
			<p>
				<label for="contact_firstname">Prénom du contact : </label>
				<span><?php echo $internship->getContact()->getFirstname() ?></span>
			</p>
			<p>
				<label for="contact_mail">Mail du contact : </label>
				<span><?php echo $internship->getContact()->getMail() ?></span>
			</p>
			<p>
				<label for="contact_gsm">Numéro de gsm : </label>
				<span><?php echo $internship->getContact()->getGsm() ?></span>
			</p>
			<p>
				<label for="contact_phone">Numéro de téléphone : </label>
				<span><?php echo $internship->getContact()->getPhoneNumber() ?></span>
			</p>
			<p>
				<label for="contact_service">Service du contact : </label>
				<span><?php echo $internship->getContact()->getService() ?></span>
			</p>
			<p>
				<label for="contact_job">Travail du contact : </label>
				<span><?php echo $internship->getContact()->getJob() ?></span>
			</p>
		</div>
		<div class="col-md-6">
			<div class="page-header">
			  	<h3>Informations sur le stage</h3>
			</div>
		  	<p>
				<label for="objective">Objectif du stage : </label>
				<span><?php echo $internship->getObjective() ?></span>
			</p>
			<p>
				<label for="work_description">Brève description du travail : </label>
				<span><?php echo $internship->getWorkDescription() ?></span>
			</p>
			<p>
				<label for="work_environment">Brève description de l'environnement : </label>
				<span><?php echo $internship->getWorkEnvironment() ?></span>
			</p>
			<p>
				<label for="remark">Remarques : </label>
				<span><?php echo $internship->getRemark() ?></span>
			</p>
		</div>
	</div>
	<button type="submit" name="accept_internship" class="btn btn-primary">Accepter</button>
</form>