<?php if($notification != ''){ ?>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<?php echo $notification ?>
			</div>	
		</div>
		<?php } ?>

		<form action="" method="POST" class="form_user">
			<div class="row">
				<div class="col-md-12">
					
					<div class="panel panel-primary">
						<div class="panel-heading text-center">
							<h5><strong>Modifier un promoteur</strong></h5>
						</div>
					</div>
					<p>
						<label>Nom : </label>
						<span><input type="text" class="form-control" name="edit_professional_surname" value="<?php echo $professional->getSurname(); ?>" /></span>
					</p>
					<p>
						<label >Prénom : </label>
						<span><input type="text" class="form-control" name="edit_professional_firstname" value="<?php echo $professional->getFirstname(); ?>" /></span>
					</p>
					<p>
						<label>Mail : </label>
						<span><input type="text" class="form-control" name="edit_professional_mail" value="<?php echo $professional->getMail(); ?>" /></span>
					</p>
					<p>
						<label>Numéro de téléphone : </label>
						<span><input type="text" class="form-control" name="edit_professional_phoneNumber" value="<?php echo $professional->getPhoneNumber(); ?>" /></span>
					</p>
					<p>
						<label>GSM : </label>
						<span><input type="text" class="form-control" name="edit_professional_gsm" value="<?php echo $professional->getGsm(); ?>" /></span>
					</p>
					<p>
						<label>Job : </label>
						<span><input type="text" class="form-control" name="edit_professional_job" value="<?php echo $professional->getJob(); ?>" /></span>
					</p>
					<p>
						<label>Service : </label>
						<span><input type="text" class="form-control" name="edit_professional_service" value="<?php echo $professional->getService(); ?>" /></span>
					</p>
					<input type="hidden" name="edit_professional_id" value="<?php echo $professional->getId(); ?>" />
				</div>
			</div>
			<button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Modifier</button>
		</form>