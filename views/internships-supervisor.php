		<?php if($notification != ''){ ?>
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
				   <div class="panel-heading"><h4>Les stages sans superviseur</h4>
					</div>
				</div>
				<p>Sélectionnez les stages que <?php echo $supervisor->getFirstname() . ' ' . $supervisor->getSurname(); ?> doit superviser</p>
				<form action="index.php?action=teacher&page=internships-supervisor&supervisor=<?php echo $_GET['supervisor']; ?>" method="post">
					<table class="table table-striped">
					  <thead>
						<tr> 
							<th></th>
							<th>Nom</th>
							<th>Prénom</th>
							<th>Email</th>
							<th>Entreprise</th>
							<th>Status du stage</th>
						</tr> 
					  </thead>
					  <tbody>
						<?php for ($i=0;$i<count($tableInternships);$i++) { ?>
						<tr>
							<td><input type="checkbox" name="internship[]" value="<?php echo $tableInternships[$i]->getIdInternship() ?>" /></td>
							<td><?php echo $tableInternships[$i]->getStudent()->getSurname() ?></td>
							<td><?php echo $tableInternships[$i]->getStudent()->getFirstname() ?></td>
							<td><?php echo $tableInternships[$i]->getStudent()->getMail() ?></td>
							<td><?php echo $tableInternships[$i]->getFirm()->getname() ?></td>	
							<td><?php echo ucfirst($tableInternships[$i]->getStatement()) ?></td>	
						</tr>
						<?php }
						if(count($tableInternships)==0){
							echo '
							<tr></tr>
							<tr>
								<td colspan="6">
									<div class="alert alert-warning" role="alert">Aucun stage n\'est disponible</div>
								</td>
							</tr>';
						}
						?>
					  </tbody>
					</table>
				<input type="hidden" name="supervisor" value="<?php echo $_GET['supervisor']; ?>" />
				<button type="submit" name="envoyer" class="btn btn-primary">Envoyer</button>
				</form>
			</div>
		</div>