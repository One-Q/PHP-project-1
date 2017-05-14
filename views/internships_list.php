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
				   <div class="panel-heading"><h4>Les stages</h4>
					   <nav style="float:right">
							  <ul class="pagination">
								<li><a href="index.php?action=teacher&page=internships_list&year=<?php echo $study_year-1; ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
								<li class="active"><a href="#"><?php echo $study_year; ?><span class="sr-only">(current)</span></a></li>
								<li><a href="index.php?action=teacher&page=internships_list&year=<?php echo $study_year+1; ?>" aria-label="Next"><span aria-hidden="true">»</span></a></li>
							  </ul>
						</nav>
						<nav style="float:left">
						
						</nav>
					</div>
				</div>
					<form action="index.php?action=exportPDF" method="post">
						<input type="hidden" name="export_internships" value="">
						<input type="hidden" name="study_year" value="<?php echo $study_year; ?>">
						<button type="submit" name="update" class="btn btn-success"><span class="glyphicon glyphicon-open"></span> Exporter les stages complétés</button>
					</form>
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
						$student = dB::getInstance()->getStudentById($tableInternships[$i]->getStudent());
						$firm = $tableInternships[$i]->getFirm(); ?>
						<tr>
							<td><?php echo $student->getSurname() ?></td>
							<td><?php echo $student->getFirstname() ?></td>
							<td><?php echo $student->getMail() ?></td>
							<td><?php echo $firm->getName() ?></td>
							<td><?php echo ucfirst($tableInternships[$i]->getStatement()) ?></td>	
							<td><a href="index.php?action=teacher&page=internship&id=<?php echo $tableInternships[$i]->getIdInternship() ?>"><span class="glyphicon glyphicon-search"></span></a></td>
						</tr>
						<?php }
						if(count($tableInternships)==0){
							echo '
							<tr></tr>
							<tr>
								<td colspan="6">
									<div class="alert alert-warning" role="alert">Aucun stage n\'est enregistrés pour l\'année '.$study_year.'</div>
								</td>
							</tr>';
						}
						?>
					  </tbody>
					</table>
				
			</div>
		</div>