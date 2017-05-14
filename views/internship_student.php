
		<div class="row">
			<div class="col-md-12">
				<div class="page-header" id="internship_stage_status">
				 	<h1>Mon stage</h1>
				</div>
			</div>	
			<div class="col-md-12 ">
				<h3>Status de mon stage : <?php echo ucfirst($internship->getStatement()) ?></h3>
			</div>
		</div>
		
		<div class="row">
		<div class="col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading text-center">
			  		<h5><strong>Informations sur l'étudiant</strong></h5>
			  	</div>
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
				<span><?php echo $student->getPhoneNumber() ?></span>
			</p>
			<p>
				<label for="sex">Sexe : </label>
				<span><?php echo $student->getSex() ?></span>
			</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			
			<div class="panel panel-primary">
				<div class="panel-heading text-center">
			  		<h5><strong>Informations sur la société</strong></h5>
			  	</div>
			</div>
			<p>
				<label for="firm_name">Nom : </label>
				<span><?php echo $internship->getFirm()->getName() ?></span>
  				<input type="hidden" name="id_internship" value="<?php echo $internship->getIdInternship() ?>">
			</p>
			<p>
				<label for="firm_abbreviation">Abbréviation : </label>
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
			<div class="panel panel-primary">
				<div class="panel-heading text-center">
			  		<h5><strong>Informations sur le promoteur</strong></h5>
			  	</div>
			</div>
			<p>
				<label for="promoter_surname">Nom : </label>
				<span><?php echo $internship->getPromoter()->getSurname() ?></span>
			</p>
			<p>
				<label for="promoter_firstname">Prénom : </label>
				<span><?php echo $internship->getPromoter()->getFirstname() ?></span>
			</p>
			<p>
				<label for="promoter_mail">Mail : </label>
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
				<label for="promoter_service">Service : </label>
				<span><?php echo $internship->getPromoter()->getService() ?></span>
			</p>
			<p>
				<label for="promoter_job">Travail : </label>
				<span><?php echo $internship->getPromoter()->getJob() ?></span>
			</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading text-center">
			  		<h5><strong>Informations sur la personne de contact</strong></h5>
			  	</div>
			</div>
			<p>
				<label for="contact_surname">Nom : </label>
				<span><?php echo $internship->getContact()->getSurname() ?></span>
			</p>
			<p>
				<label for="contact_firstname">Prénom : </label>
				<span><?php echo $internship->getContact()->getFirstname() ?></span>
			</p>
			<p>
				<label for="contact_mail">Mail : </label>
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
				<label for="contact_service">Service : </label>
				<span><?php echo $internship->getContact()->getService() ?></span>
			</p>
			<p>
				<label for="contact_job">Travail : </label>
				<span><?php echo $internship->getContact()->getJob() ?></span>
			</p>
		</div>
		<div class="col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading text-center">
			  		<h5><strong>Informations sur le stage</strong></h5>
			  	</div>
			</div>
		  	<p>
				<label for="objective">Objectif : </label>
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
			<p>
				<label>Superviseur : </label>
				<span><?php if($internship->getSupervisor() != null){ echo $internship->getSupervisor()->getSurname(); }?></span>
			</p>
		</div>
	</div>

