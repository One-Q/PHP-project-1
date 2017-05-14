<?php if($notification != ''){ ?>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<?php echo $notification ?>
			</div>	
		</div>
		<?php } ?>

<form action="index.php?action=firm" method="POST" id="form_firm">
	<div class="page-header">
	  	<h1>Demande de stagiaire</h1>

	</div>
	
	<div class="row">
		<div class="col-md-6">
			<div class="page-header">
			  	<h3>Informations sur la société</h3>
			</div>
			<p>
				<label for="firm_name">Nom  : *</label>
				<input class="form-control" type="text" name="firm_name" id="firm_name" placeholder="Nom" value="<?php echo $internship->getFirm()->getName() ?>">
				<input type="hidden" name="id_internship" value="<?php echo $internship->getIdInternship() ?>">
			</p>
			<p>
				<label for="firm_abbreviation">Abbréviation  : *</label>
				<input class="form-control" type="text" name="firm_abbreviation" id="firm_abbreviation" placeholder="Abbreviation" value="<?php echo $internship->getFirm()->getAbbreviation() ?>">
			</p>
			<p>
				<label for="street">Rue : *</label>
				<input class="form-control" type="text" name="street" id="street" placeholder="Rue" value="<?php echo $internship->getFirm()->getStreet() ?>">
			</p>
			<p>
				<label for="number">Numéro : *</label>
				<input class="form-control" type="number" name="number" id="number" placeholder="Numero" value="<?php echo $internship->getFirm()->getNumberStreet() ?>">
			</p>
			<p>
				<label for="zip_code">Code postal : *</label>
				<input class="form-control" type="number" name="zip_code" id="zip_code" placeholder="Code postal" value="<?php echo $internship->getFirm()->GetZipCode() ?>">
			</p>
			<p>
				<label for="firm_phone">Numéro de téléphone : *</label>
				<input class="form-control" type="text" name="firm_phone" id="firm_phone" placeholder="Numéro de téléphone" value="<?php echo $internship->getFirm()->getPhoneNumber() ?>">
			</p>
		</div>
		<div class="col-md-6">
			<div class="page-header">
			  	<h3>Informations sur le promoteur</h3>
			</div>
			<p>
				<label for="promoter_surname">Nom  : *</label>
				<input class="form-control" type="text" name="promoter_surname" id="promoter_surname" placeholder="Nom" value="<?php echo $internship->getPromoter()->getSurname() ?>">
			</p>
			<p>
				<label for="promoter_firstname">Prénom : *</label>
				<input class="form-control" type="text" name="promoter_firstname" id="promoter_firstname" placeholder="Prénom" value="<?php echo $internship->getPromoter()->getFirstname() ?>">
			</p>
			<p>
				<label for="promoter_mail">Mail : *</label>
				<input class="form-control" type="email" name="promoter_mail" id="promoter_mail" placeholder="Mail" value="<?php echo $internship->getPromoter()->getMail() ?>">
			</p>
			<p>
				<label for="promoter_gsm">Numéro de gsm : </label>
				<input class="form-control" type="text" name="promoter_gsm" id="promoter_gsm" placeholder="Numéro de gsm" value="<?php echo $internship->getPromoter()->getGsm() ?>">
			</p>
			<p>
				<label for="promoter_phone">Numéro de téléphone : </label>
				<input class="form-control" type="text" name="promoter_phone" id="promoter_phone" placeholder="Numéro de téléphone" value="<?php echo $internship->getPromoter()->getPhoneNumber() ?>">
			</p>
			<p>
				<label for="promoter_service">Service : </label>
				<input class="form-control" type="text" name="promoter_service" id="promoter_service" placeholder="Service" value="<?php echo $internship->getPromoter()->getService() ?>">
			</p>
			<p>
				<label for="promoter_job">Travail : </label>
				<input class="form-control" type="text" name="promoter_job" id="promoter_job" placeholder="Travail" value="<?php echo $internship->getPromoter()->getJob() ?>">
			</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="page-header">
			  	<h3>Informations sur la personne contact</h3>
			</div>
			<p>
				<label for="contact_surname">Nom : *</label>
				<input class="form-control" type="text" name="contact_surname" id="contact_surname" placeholder="Nom" value="<?php echo $internship->getContact()->getSurname() ?>">
			</p>
			<p>
				<label for="contact_firstname">Prénom : *</label>
				<input class="form-control" type="text" name="contact_firstname" id="contact_firstname" placeholder="Prénom" value="<?php echo $internship->getContact()->getFirstname() ?>">
			</p>
			<p>
				<label for="contact_mail">Mail : *</label>
				<input class="form-control" type="email" name="contact_mail" id="contact_mail" placeholder="Mail" value="<?php echo $internship->getContact()->getMail() ?>">
			</p>
			<p>
				<label for="contact_gsm">Numéro de gsm : </label>
				<input class="form-control" type="text" name="contact_gsm" id="contact_gsm" placeholder="Numéro de gsm" value="<?php echo $internship->getContact()->getGsm() ?>">
			</p>
			<p>
				<label for="contact_phone">Numéro de téléphone : </label>
				<input class="form-control" type="text" name="contact_phone" id="contact_phone" placeholder="Numéro de téléphone" value="<?php echo $internship->getContact()->getPhoneNumber() ?>">
			</p>
			<p>
				<label for="contact_service">Service : </label>
				<input class="form-control" type="text" name="contact_service" id="contact_service" placeholder="Service" value="<?php echo $internship->getContact()->getService() ?>">
			</p>
			<p>
				<label for="contact_job">Travail : </label>
				<input class="form-control" type="text" name="contact_job" id="contact_job" placeholder="Travail" value="<?php echo $internship->getContact()->getJob() ?>">
			</p>
		</div>
		<div class="col-md-6">
			<div class="page-header">
			  	<h3>Informations sur le stage</h3>
			</div>
		  	
			<p>
				<label for="objective">Objectif du stage : *</label>
				<textarea class="form-control" rows="3" id="objective" name="objective"><?php echo $internship->getObjective() ?></textarea>
			</p>
			<p>
				<label for="work_description">Brève description du travail : *</label>
				<textarea class="form-control" rows="3" id="work_description" name="work_description"><?php echo $internship->getWorkDescription() ?></textarea>
			</p>
			<p>
				<label for="work_environment">Brève description de l'environnement : *</label>
				<textarea class="form-control" rows="3" id="work_environment" name="work_environment"><?php echo $internship->getWorkEnvironment() ?></textarea>
			</p>
			<p>
				<label for="remark">Remarques : *</label>
				<textarea class="form-control" rows="3" id="remark" name="remark"><?php echo $internship->getRemark() ?></textarea>
			</p>
		</div>
	</div>
	<button type="submit" name="submit_firm" class="btn btn-primary">Envoyer</button>
</form>