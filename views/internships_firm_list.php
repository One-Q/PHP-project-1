		<?php
		if($notification != ''){ ?>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<?php echo $notification ?>
			</div>	
		</div>
		<?php } ?>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary">
				  <!-- Default panel contents -->
				   <div class="panel-heading"><h4>Demandes de stagiaires</h4></div>
				</div>
				</div>
			</div>
				
			<?php 
				for($i = 0; $i < count($tableInternships); $i++){
			 ?>
			
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
					  	<div class="panel-heading">
					    	<h3 class="panel-title"><?php echo $tableInternships[$i]->getFirm()->getName() ?></h3>
					  	</div>
					  	<div class="panel-body">
					  		<div class="row">
					  			<div class="col-md-6">
						    		<h5>Nom du promoteur : </h5><p><?php echo $tableInternships[$i]->getPromoter()->getSurname() . " " . $tableInternships[$i]->getPromoter()->getFirstname() ?></p>
						    	</div>
						    	<div class="col-md-6">
						    		<h5>Nom du contact : </h5><p><?php echo $tableInternships[$i]->getContact()->getSurname() . " " . $tableInternships[$i]->getContact()->getFirstname() ?></p>
						    	</div>
					  		</div>
					  		<div class="row">
					  			<div class="col-md-6">
						    		<h5>Objectif : </h5><p><?php echo $tableInternships[$i]->getObjective()?></p>
						    	</div>
					  		</div>
					  		<div class="row">
					  			<div class="col-md-6">
					  				<h5>Numéro de téléphone : </h5><p><?php echo $tableInternships[$i]->getFirm()->getPhoneNumber()?></p>
					  			</div>
					  			<div class="col-md-6">
					  				<h5>Mail du promoteur: </h5><p><?php echo $tableInternships[$i]->getPromoter()->getMail()?></p>
					  			</div>
					  		</div>
					    	<div class="row">
					  			<div class="col-md-6">
						    		<h5>Description du travail : </h5><p><?php echo $tableInternships[$i]->getWorkDescription()?></p>
						    	</div>
						    	<div class="col-md-6">
						    		<h5>Description de l'environnement : </h5><p><?php echo $tableInternships[$i]->getWorkEnvironment()?></p>
						    	</div>
					  		</div>
							
					  		<?php if(isset($_SESSION['job']) && $_SESSION['job']=='manager'){ ?>
								<div class="row">
									<div class="col-md-6">
									<?php $validator1 = Db::getInstance()->getTeacherById($tableInternships[$i]->getValidator1()); ?>
										<h5>Premier validateur : </h5><p><?php if($validator1!=null){ echo $validator1->getFirstname() . " " . $validator1->getSurname(); } ?></p>
									</div>
									<div class="col-md-6">
									<?php $validator2 = Db::getInstance()->getTeacherById($tableInternships[$i]->getValidator2()); ?>
										<h5>Second validateur : </h5><p><?php if($validator2!=null){ echo $validator2->getFirstname() . " " . $validator2->getSurname(); } ?></p>
									</div>
								</div>
								<?php if(($tableInternships[$i]->getValidator1()!=null AND $tableInternships[$i]->getValidator2()!=null) OR $tableInternships[$i]->getValidator1()==$_SESSION['id'] OR $tableInternships[$i]->getValidator2()==$_SESSION['id']){
									
								}
								else
								{
								?>	
								<div class="row">
									<div class="col-md-12">
									<form action="" method="post">
										<input type="hidden" name="internship_validate" value="<?php echo $tableInternships[$i]->getIdInternship(); ?>">
										<button type="submit" name="update" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Je valide cette demande</button>
									</form>
									</div>
								</div>
								<?php } } ?>
					  	</div>
					</div>
				</div>

			</div>

			<?php }
			if(count($tableInternships)==0){
			echo '
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="alert alert-warning" role="alert">Aucune demande de stagiaire pour le moment</div>
				</div>
			</div>';
			}
			?>
					  

