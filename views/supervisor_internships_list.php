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
					<div class="panel-heading">
				   		<h4><?php echo $title ?></h4>
				   	</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped">
				  <thead>
					<tr> 
						<th>Nom</th>
						<th>Prénom</th>
						<th>Email</th>
						<th>Entreprise</th>
						<th>Status du stage</th>
						<th></th>
					</tr> 
				  </thead>
				  <tbody>
					<?php for ($i=0;$i<count($tableInternships);$i++) { 
					$internship = $tableInternships[$i]; ?>
					<tr>
						<td><?php echo $internship->getStudent()->getSurname() ?></td>
						<td><?php echo $internship->getStudent()->getFirstname() ?></td>
						<td><?php echo $internship->getStudent()->getMail() ?></td>
						<td><?php echo $internship->getFirm()->getName() ?></td>
						<td><?php echo ucfirst($tableInternships[$i]->getStatement()) ?></td>
						<td><a href="index.php?action=teacher&page=internship&id=<?php echo $internship->getIdInternship() ?>"><span class="glyphicon glyphicon-search"></span></a></td>	
					</tr>
					<?php }
					if(count($tableInternships)==0){
						echo '
						<tr></tr>
						<tr>
							<td colspan="6">
								<div class="alert alert-warning" role="alert">Aucun stage n\'est enregistrés</div>
							</td>
						</tr>';
					}
					?>
				  </tbody>
				</table>
				
			</div>
		</div>