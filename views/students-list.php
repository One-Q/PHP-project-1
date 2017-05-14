		<?php if($notification != ''){ ?>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<?php echo $notification ?>
			</div>	
		</div>
		<?php } ?>
		<div class="row">
			<div class="col-md-12">
				<form action="index.php?action=teacher&page=students-list" method="POST" class="form_user" enctype="multipart/form-data">
	 				<h4 class="text-center">Importer des étudiants</h4>
	 				<p>
	 					<label for="csv">Fichier csv : </label>
	 					<input class="form-control" type="file" name="csv-students" id="csv-students" placeholder="Fichier csv">
	  				</p>
					<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
	  				<button type="submit" name="envoyer" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> Envoyer</button>
	 			</form>
	 			<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
				  <!-- Default panel contents -->
				   <div class="panel-heading"><h4>Les étudiants</h4>
					   <nav style="float:right">
							  <ul class="pagination">
								<li><a href="index.php?action=teacher&page=students-list&year=<?php echo $study_year-1; ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
								<li class="active"><a href="#"><?php echo $study_year; ?><span class="sr-only">(current)</span></a></li>
								<li><a href="index.php?action=teacher&page=students-list&year=<?php echo $study_year+1; ?>" aria-label="Next"><span aria-hidden="true">»</span></a></li>
							  </ul>
						</nav>
					</div>
				</div>
				
					<table class="table table-striped">
					  <thead>
						<tr> 
							<th>Matricule</th>
							<th>Nom</th>
							<th>Prénom</th>
							<th>Email</th>
							<th>Téléphone</th>
							<th>Status du stage</th>
						</tr> 
					  </thead>
					  <tbody>
						<?php for ($i=0;$i<count($tablestudents);$i++) { ?>
						<tr <?php switch(dB::getInstance()->getStatusByStudent($tablestudents[$i]->getId())){
							
							case "Supervisé":
							case "Exporté":
								echo 'class="success"';
								break;
							
							case "Soumis et pris":
								echo 'class="active"';
								break;
							
							case "Attribué":
							case "Complété":
								echo 'class="warning"';
								break;
							
							}; ?>>
							<th scope="row"><?php echo $tablestudents[$i]->getId() ?></th>
							<td><?php echo $tablestudents[$i]->getSurname() ?></td>
							<td><?php echo $tablestudents[$i]->getFirstname() ?></td>
							<td><?php echo $tablestudents[$i]->getMail() ?></td>
							<td><?php echo $tablestudents[$i]->getPhoneNumber() ?></td>	
							<td><?php echo dB::getInstance()->getStatusByStudent($tablestudents[$i]->getId()) ?></td>	
						</tr>
						<?php }
						if(count($tablestudents)==0){
							echo '
							<tr></tr>
							<tr>
								<td colspan="6">
									<div class="alert alert-warning" role="alert">Aucun étudiants n\'est enregistrés pour l\'année '.$study_year.'</div>
								</td>
							</tr>';
						}
						?>
					  </tbody>
					</table>
				
			</div>
		</div>