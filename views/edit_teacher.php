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
							<h5><strong>Modifier un professeur</strong></h5>
						</div>
					</div>
					<p>
						<label>Nom : </label>
						<span><input type="text" class="form-control" name="edit_teacher_surname" value="<?php echo $teacher->getSurname(); ?>" /></span>
					</p>
					<p>
						<label >Prénom : </label>
						<span><input type="text" class="form-control" name="edit_teacher_firstname" value="<?php echo $teacher->getFirstname(); ?>" /></span>
					</p>
					<p>
						<label>Mail : </label>
						<span><input type="text" class="form-control" name="edit_teacher_mail" value="<?php echo $teacher->getMail(); ?>" /></span>
					</p>
					<p>
						<label for="student_phone">Manager : </label>
						<select class="form-control" name="edit_teacher_manager">
						  <option value="1" <?php if($teacher->isManager()){ ?> selected <?php } ?>>Oui</option>
						  <option value="0" <?php if(!$teacher->isManager()){ ?> selected <?php } ?>>Non</option>
						</select>
					</p>
					<input type="hidden" name="edit_teacher_id" value="<?php echo $teacher->getId(); ?>" />
				</div>
			</div>
			<button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Modifier</button>
		</form>