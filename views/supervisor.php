<?php if(isset($_SESSION['job']) && $_SESSION['job']=='teacher'){ ?>
		<div class="row">
			<div class="col-md-3 menu-boxed">
				<a href="index.php?action=teacher&page=supervisor_internships_list">
					<div class="menu-box turquoise">
						<p><img src="views/images/students.png" class="img-circle" /></p>
						<h3>Mes stages</h3>
					</div>
				</a>
			</div>
			<div class="col-md-3 menu-boxed">
				<a href="index.php?action=teacher&page=complete_internships_list">
					<div class="menu-box green ">
						<p><img src="views/images/internship_form.png" class="img-circle" /></p>
						<h3>Les étudiants en stage complété</h3>
					</div>
				</a>
			</div>
		</div>
		
<?php } ?>