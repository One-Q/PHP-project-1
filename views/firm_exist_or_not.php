<?php if($notification != ''){ ?>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<?php echo $notification ?>
			</div>	
		</div>
		<?php } ?>


<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<form action="index.php?action=firm" method="POST" class="form_user">
			<p>
				<input type="radio" name="submission" value="off_list" id="off_list" checked><label for="off_list">Première demande de stage</label>
			</p>
			<p>
				<input type="radio" name="submission" <?php echo $disabled ?> value="on_list" id="on_list"><label for="on_list">Mon entreprise à déjà soumis un stage auparavant</label>
				<select name="select_internship" class="form-control">
					<?php for ($i=0; $i < count($internships_list); $i++) { ?>
					<option value="<?php echo $internships_list[$i]->getId() ?>"><?php echo  $internships_list[$i]->getName()?></option>
					<?php } ?>
				</select>
			</p>
			<button type="submit" name="submit" class="btn btn-primary">Envoyer</button>
		</form>
	</div>
</div>