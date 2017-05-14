		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
				  <!-- Default panel contents -->
				   <div class="panel-heading"><h4>Les entreprises</h4></div>
				</div>
				
					<table class="table table-striped">
					  <thead>
						<tr> 
							<th>Nom</th>
							<th>Abréviation</th>
							<th>Rue</th>
							<th>Code postal</th>
							<th>Téléphone</th>
							<th></th>
						</tr> 
					  </thead>
					  <tbody>
						<?php for ($i=0;$i<count($tablefirms);$i++) { ?>
						<tr>
							<th scope="row"><?php echo $tablefirms[$i]->getName() ?></th>
							<td><?php echo $tablefirms[$i]->getAbbreviation() ?></td>
							<td><?php echo $tablefirms[$i]->getStreet() . " n°" . $tablefirms[$i]->getNumberStreet() ?></td>
							<td><?php echo $tablefirms[$i]->getZipCode() ?></td>
							<td><?php echo $tablefirms[$i]->getPhoneNumber() ?></td>	
							<td><a href="index.php?action=teacher&page=edit_firm&edit_id=<?php echo $tablefirms[$i]->getId(); ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
						</tr>
						<?php }
						if(count($tablefirms)==0){
							echo '
							<tr></tr>
							<tr>
								<td colspan="6">
									<div class="alert alert-warning" role="alert">Aucune entreprise d\'enregistrées</div>
								</td>
							</tr>';
						}
						?>
					  </tbody>
					</table>
				
			</div>
		</div>

