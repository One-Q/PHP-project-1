		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
				  <!-- Default panel contents -->
				   <div class="panel-heading"><h4>Les promoteurs</h4></div>
				</div>
				
					<table class="table table-striped">
					  <thead>
						<tr> 
							<th>Nom</th>
							<th>Prénom</th>
							<th>Email</th>
							<th>Téléphone</th>
							<th>Entreprise</th>
							<th>Job</th>
							<th>Service</th>
							<th></th>
						</tr> 
					  </thead>
					  <tbody>
						<?php for ($i=0;$i<count($tableprofessionals);$i++) { ?>
						<tr>
							<th scope="row"><?php echo $tableprofessionals[$i]->getSurname() ?></th>
							<td><?php echo $tableprofessionals[$i]->getFirstname() ?></td>
							<td><?php echo $tableprofessionals[$i]->getMail() ?></td>
							<td><?php echo $tableprofessionals[$i]->getPhoneNumber() ?></td>
							<td><?php echo $tableprofessionals[$i]->getFirm() ?></td>	
							<td><?php echo $tableprofessionals[$i]->getJob() ?></td>
							<td><?php echo $tableprofessionals[$i]->getService() ?></td>
							<td><a href="index.php?action=teacher&page=edit_professional&edit_id=<?php echo $tableprofessionals[$i]->getId(); ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
						</tr>
						<?php }
						if(count($tableprofessionals)==0){
							echo '
							<tr></tr>
							<tr>
								<td colspan="6">
									<div class="alert alert-warning" role="alert">Aucun promoteurs d\'enregistrés</div>
								</td>
							</tr>';
						}
						?>
					  </tbody>
					</table>
				
			</div>
		</div>