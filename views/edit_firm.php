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
							<h5><strong>Modifier une entreprise</strong></h5>
						</div>
					</div>
					<p>
						<label>Nom : </label>
						<span><input type="text" class="form-control" name="edit_firm_name" value="<?php echo $firm->getName(); ?>" /></span>
					</p>
					<p>
						<label >Abbréviation : </label>
						<span><input type="text" class="form-control" name="edit_firm_abbreviation" value="<?php echo $firm->getAbbreviation(); ?>" /></span>
					</p>
					<p>
						<label >Rue : </label>
						<span><input type="text" class="form-control" name="edit_firm_street" value="<?php echo $firm->getStreet(); ?>" /></span>
					</p>
					<p>
						<label >N° : </label>
						<span><input type="text" class="form-control" name="edit_firm_number" value="<?php echo $firm->getNumberStreet(); ?>" /></span>
					</p>
					<p>
						<label >Code postal : </label>
						<span><input type="text" class="form-control" name="edit_firm_zipCode" value="<?php echo $firm->getZipCode(); ?>" /></span>
					</p>
					<p>
						<label >Téléphone : </label>
						<span><input type="text" class="form-control" name="edit_firm_phoneNumber" value="<?php echo $firm->getPhoneNumber(); ?>" /></span>
					</p>
					<input type="hidden" name="edit_firm_id" value="<?php echo $firm->getId(); ?>" />
				</div>
			</div>
			<button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Modifier</button>
		</form>