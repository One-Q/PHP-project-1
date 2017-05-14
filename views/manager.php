<?php if(isset($_SESSION['job']) && $_SESSION['job']=='manager'){ ?>
		<div class="row">
			<div class="col-md-3 menu-boxed">
				<a href="index.php?action=teacher&page=students-list">
					<div class="menu-box turquoise">
						<p><img src="views/images/students.png" class="img-circle" /></p>
						<h3>Les étudiants</h3>
					</div>
				</a>
			</div>
			<div class="col-md-3 menu-boxed">
				<a href="index.php?action=teacher&page=internships_firm_list">
					<div class="menu-box green ">
						<p><img src="views/images/internship_form.png" class="img-circle" /></p>
						<h3>Demandes de stagiaires</h3>
					</div>
				</a>
			</div>
			<div class="col-md-3 menu-boxed">
				<a href="index.php?action=teacher&page=internships_student_list">
					<div class="menu-box orange ">
						<p><img src="views/images/soumission.png" class="img-circle" /></p>
						<h3>Soumissions de stages</h3>
					</div>
				</a>
			</div>
			<div class="col-md-3 menu-boxed">
				<a href="index.php?action=teacher&page=internships_list">
					<div class="menu-box belize">
						<p><img src="views/images/internship.png" class="img-circle" /></p>
						<h3>Les stages</h3>
					</div>
				</a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 menu-boxed">
				<a href="index.php?action=teacher&page=firms-list">
					<div class="menu-box pomegranate ">
						<p><img src="views/images/company.png" class="img-circle" /></p>
						<h3>Les sociétés</h3>
					</div>
				</a>
			</div>
			<div class="col-md-3 menu-boxed">
				<a href="index.php?action=teacher&page=professionals-list">
					<div class="menu-box silver ">
						<p><img src="views/images/promotor2.png" class="img-circle" /></p>
						<h3>Les promoteurs</h3>
					</div>
				</a>
			</div>
			<div class="col-md-3 menu-boxed">
				<a href="index.php?action=teacher&page=teachers-list">
					<div class="menu-box wisteria ">
						<p><img src="views/images/teacher.png" class="img-circle" /></p>
						<h3>Les professeurs</h3>
					</div>
				</a>
			</div>
			<div class="col-md-3 menu-boxed">
				<a href="index.php?action=teacher&page=settings">
					<div class="menu-box midnightblue ">
						<p><img src="views/images/setting.png" class="img-circle" /></p>
						<h3>Paramètres</h3>
					</div>
				</a>
			</div>
		</div>
<?php } ?>