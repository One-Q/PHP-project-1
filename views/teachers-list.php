		<?php 
		if($notification != ''){ ?>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<?php echo $notification ?>
			</div>	
		</div>
		<?php } ?>
		<div class="row">
			<div class="col-md-12">
				<form action="index.php?action=teacher&page=teachers-list" method="POST" class="form_user" enctype="multipart/form-data">
	 				<h4 class="text-center">Importer des professeurs</h4>
	 				<p>
	 					<label for="csv">Fichier csv : </label>
	 					<input class="form-control" type="file" name="csv-teachers" id="csv-teachers" placeholder="Fichier csv">
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
				   <div class="panel-heading"><h4>Les professeurs</h4></div>
				</div>
				
					<table class="table table-striped">
					  <thead>
						<tr> 
							<th>Nom</th>
							<th>Prénom</th>
							<th>Email</th>
							<th></th>
							<th>Action</th>
							<th></th>
						</tr> 
					  </thead>
					  <tbody>
						<?php for ($i=0;$i<count($tableteachers);$i++) { 
						if($tableteachers[$i]->isActive()){
							echo '<tr class="active">';
						}
						else
						{
							echo '<tr class="danger">';
						}
						?>
							<th scope="row"><?php echo $tableteachers[$i]->getSurname() ?></th>
							<td><?php echo $tableteachers[$i]->getFirstname() ?></td>
							<td><?php echo $tableteachers[$i]->getMail() ?></td>
							<td ><?php if($tableteachers[$i]->isManager()){ ?><span class="label label-success">Responsable</span><?php } ?></td>	
							<td>
								<div class="btn-group">
									<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Action <span class="caret"></span>
									</button>
								<ul class="dropdown-menu">
									<?php if($tableteachers[$i]->isActive()){ ?><li><a href="index.php?action=teacher&page=teachers-list&inactive=<?php echo $tableteachers[$i]->getMail(); ?>"><span class="glyphicon glyphicon-remove"></span>&nbsp; Désactiver</a></li><?php } ?>
									<?php if(!$tableteachers[$i]->isActive()){ ?><li><a href="index.php?action=teacher&page=teachers-list&active=<?php echo $tableteachers[$i]->getMail(); ?>"><span class="glyphicon glyphicon-ok"></span>&nbsp; Activer</a></li><?php } ?>
									<li><a href="index.php?action=teacher&page=internships-supervisor&supervisor=<?php echo $tableteachers[$i]->getId(); ?>"><span class="glyphicon glyphicon-eye-open"></span>&nbsp; Superviser</a></li>
									<li><a href="index.php?action=teacher&page=edit_teacher&edit_id=<?php echo $tableteachers[$i]->getId(); ?>"><span class="glyphicon glyphicon-pencil"></span>&nbsp; Modifier</a></li>
									<li role="separator" class="divider"></li>
									<li><a href="index.php?action=teacher&page=teachers-list&delete=<?php echo $tableteachers[$i]->getMail(); ?>&delete_id=<?php echo $tableteachers[$i]->getId(); ?>"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Supprimer</a></li>
								</ul>
								</div>
							</td>
							<td class="text-center" >
							<?php if(Db::getInstance()->coun_internship_supervisor($tableteachers[$i]->getId())>0){ ?>
								<span class="label label-warning">Superviseur</span>
							<?php } ?>
							</td>
						</tr>
						<?php }
						if(count($tableteachers)==0){
							echo '
							<tr></tr>
							<tr>
								<td colspan="6">
									<div class="alert alert-warning" role="alert">Aucun professeurs n\'est enregistrés</div>
								</td>
							</tr>';
						}
						?>
					  </tbody>
					</table>
				
			</div>
		</div>