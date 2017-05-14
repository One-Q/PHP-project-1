<?php
class TeacherController{

	public function __construct() {
	
	}
		
	public function run(){
		$notification = '';	
		$title = '';
		# Si un petit fûté écrit ?action=admin sans passer par l'action login
		if($_SESSION['job']=='student' || empty($_SESSION['job'])) {
			header("Location: index.php"); # redirection HTTP vers l'action login
			die(); 
		}

		if(isset($_SESSION['origin_password']) && $_SESSION['origin_password'] == true){
			header("Location: index.php?action=first_connexion");
			die();
		}		
		
		# Si le fichier csv des étudiants à été upload
		if((!empty($_FILES["csv-students"])) && ($_FILES['csv-students']['error'] == 0)) {
			$number_students = Db::getInstance()->verif_csv_student($_FILES['csv-students']['tmp_name']);
			if($number_students!=0){
				$notification = '<div class="alert alert-success text-center" role="alert">'.$number_students.' étudiants on été importés via le fichier '. $_FILES['csv-students']['name'] . '</div>';	
			} else {
				$notification = '<div class="alert alert-danger text-center" role="alert">Aucun étudiants n\'as été importés</div>';	
			}
				
		}
		
		# Si le fichier csv des professeurs à été upload
		if((!empty($_FILES["csv-teachers"])) && ($_FILES['csv-teachers']['error'] == 0)) {
			$number_teachers = Db::getInstance()->verif_csv_teacher($_FILES['csv-teachers']['tmp_name']);
			if($number_teachers!=0){
				$notification = '<div class="alert alert-success text-center" role="alert">'.$number_teachers.' professeurs on été importés via le fichier '. $_FILES['csv-teachers']['name'] . '</div>';	
			} else {
				$notification = '<div class="alert alert-danger text-center" role="alert">Aucun professeurs n\'as été importés</div>';	
			}
				
		}
		
		#Si un professeurs va superviser un stage
		if(isset($_POST['supervisor'])){
			if(empty($_POST['internship'])){
				$notification = '<div class="alert alert-danger text-center" role="alert">Aucun stage n\'as été sélectionné !</div>';
			}
			else
			{
				foreach ($_POST['internship'] as $internship){
					Db::getInstance()->attributeSupervisorInternship($_POST['supervisor'],$internship);
				}
			$notification = '<div class="alert alert-success text-center" role="alert">Liaison effectué avec succès !</div>';	
			}
		}
		
		#valider une demande de stagiaire
		if(isset($_POST['internship_validate'])){
			Db::getInstance()->validateInternship($_POST['internship_validate']);
			if(Db::getInstance()->internshipIsValidate($_POST['internship_validate'])){
				$notification = '<div class="alert alert-success text-center" role="alert">La demande à été validée et est passée dans l\'état "'.ucfirst(Db::getInstance()->getInternshipById($_POST['internship_validate'])->getStatement()).'" !</div>';	
			}
			else
			{
				$notification = '<div class="alert alert-success text-center" role="alert">En attente d\'une seconde validation !</div>';
			}
		}
		
		#Si un professeur est modifié
		if(isset($_POST['edit_teacher_surname']) && isset($_POST['edit_teacher_firstname']) && isset($_POST['edit_teacher_mail'])) {
		
			if(!empty($_POST['edit_teacher_surname']) && !empty($_POST['edit_teacher_firstname']) && !empty($_POST['edit_teacher_mail'])){
				Db::getInstance()->edit_teacher($_POST['edit_teacher_surname'],$_POST['edit_teacher_firstname'],$_POST['edit_teacher_mail'],$_POST['edit_teacher_manager'],$_POST['edit_teacher_id']);
				$notification = '<div class="alert alert-success text-center" role="alert">Professeur modifié !</div>';
			}
			else
			{
				$notification = '<div class="alert alert-danger text-center" role="alert">Vueillez entrer des informations valides !</div>'; 
			}
			   
		}
		
		#Si un promoteur est modifié
		if(isset($_POST['edit_professional_surname']) && isset($_POST['edit_professional_firstname']) && isset($_POST['edit_professional_mail'])) {
		
			if(!empty($_POST['edit_professional_surname']) && !empty($_POST['edit_professional_firstname']) && !empty($_POST['edit_professional_mail'])){
				Db::getInstance()->edit_professional($_POST['edit_professional_surname'],$_POST['edit_professional_firstname'],$_POST['edit_professional_mail'],$_POST['edit_professional_phoneNumber'],$_POST['edit_professional_gsm'],$_POST['edit_professional_job'],$_POST['edit_professional_service'],$_POST['edit_professional_id']);
				$notification = '<div class="alert alert-success text-center" role="alert">Promoteur modifié !</div>';
			}
			else
			{
				$notification = '<div class="alert alert-danger text-center" role="alert">Vueillez entrer des informations valides !</div>'; 
			}
			   
		}
		
		#Si une entreprise est modifiée
		if(isset($_POST['edit_firm_name']) && isset($_POST['edit_firm_street'])) {
		
			if(!empty($_POST['edit_firm_name']) && !empty($_POST['edit_firm_street'])){
				Db::getInstance()->edit_firm($_POST['edit_firm_name'],$_POST['edit_firm_abbreviation'],$_POST['edit_firm_street'],$_POST['edit_firm_number'],$_POST['edit_firm_zipCode'],$_POST['edit_firm_phoneNumber'],$_POST['edit_firm_id']);
				$notification = '<div class="alert alert-success text-center" role="alert">Entreprise modifiée !</div>';
			}
			else
			{
				$notification = '<div class="alert alert-danger text-center" role="alert">Vueillez entrer des informations valides !</div>'; 
			}
			   
		}
		
		#Si les paramètres ont été modifié
		if(isset($_POST['internship_date_begin']) && !empty($_POST['internship_date_begin']) 
		&& isset($_POST['internship_date_end']) && !empty($_POST['internship_date_end']) 
		&& isset($_POST['internship_deadline']) && !empty($_POST['internship_deadline']) 
		&& isset($_POST['password_teacher']) && !empty($_POST['password_teacher']) 
		&& isset($_POST['password_student']) && !empty($_POST['password_student'])){
			   
		   if(preg_match("/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/", $_POST['internship_date_begin']) && preg_match("/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/", $_POST['internship_date_end']) && preg_match("/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/", $_POST['internship_deadline'])){
				  Db::getInstance()->editSettings($_POST['internship_date_begin'],$_POST['internship_date_end'],$_POST['internship_deadline'],$_POST['password_teacher'],$_POST['password_student']);
				  
				  if($_POST['old_password_teacher']!=$_POST['password_teacher']){
					Db::getInstance()->refresh_all_password_teachers($_POST['password_teacher']);
				  }
				  if($_POST['old_password_student']!=$_POST['password_student']){
					Db::getInstance()->refresh_all_password_students($_POST['password_student']);
				  }
				  $notification = '<div class="alert alert-success text-center" role="alert">Paramètres modifiés !</div>';
			  }
			  else
			  {
				 $notification = '<div class="alert alert-danger text-center" role="alert">Vueillez entrer des paramètres valides !</div>'; 
			  }
			   
		}
		

		# Arrivé ici l'authentification est valide... continuons...
		# L'utilisateur authentifié est :
		$teacher = unserialize($_SESSION['user']);
		
		# Variables HTML pour les vues (deux vues possibles dans cette page-ci)
		if(isset($_SESSION['job']) && $_SESSION['job']=='manager'){
			if(isset($_GET['page'])){
				switch($_GET['page']){
					case 'students-list' : 
						$vue = 'students-list.php';
						if(isset($_GET['year'])){
							$study_year = $_GET['year'];
						}
						else{
							$study_year = date('Y', time());
						}
						$tablestudents=Db::getInstance()->select_students($study_year);
						break;
						
					case 'firms-list' : 
						$vue = 'firms-list.php';
						$tablefirms=Db::getInstance()->select_firms();
						break;
						
					case 'professionals-list' : 
						$vue = 'professionals-list.php';
						$tableprofessionals=Db::getInstance()->select_professionals();
						break;
						
					case 'teachers-list' : 
						$vue = 'teachers-list.php';
						if(isset($_GET['inactive'])){
							$inactive = Db::getInstance()->inactive_teacher($_GET['inactive']);
							$notification = '<div class="alert alert-success text-center" role="alert">Ce professeur est maitenant inactif.</div>';	
						}
						
						if(isset($_GET['active'])){
							$active = Db::getInstance()->active_teacher($_GET['active']);
							$notification = '<div class="alert alert-success text-center" role="alert">Ce professeur est maitenant actif.</div>';	
						}
						
						if(isset($_GET['delete']) && isset($_GET['delete_id'])){
							$delete = Db::getInstance()->delete_teacher($_GET['delete'],$_GET['delete_id']);
							$notification = '<div class="alert alert-success text-center" role="alert">Ce professeur est maitenant supprimé.</div>';	
						}
						$tableteachers=Db::getInstance()->select_teachers();
						break;
						
					case 'internships-supervisor' : 
						$vue = 'internships-supervisor.php';
						$tableInternships=Db::getInstance()->select_internships_without_supervisor();
						$supervisor=Db::getInstance()->getTeacherById($_GET['supervisor']);
						break;
						
					case 'internships_firm_list' : 
						$tableInternships=Db::getInstance()->select_internships_firme_manager();
						$vue = 'internships_firm_list.php';
						break;
						
					case 'internships_student_list' : 
						$tableInternships=Db::getInstance()->select_internships_student_manager();
						$vue = 'internships_student_list.php';
						break;	
						
					case 'internships_list' : 
						$vue = 'internships_list.php';
						if(isset($_GET['year'])){
							$study_year = $_GET['year'];
						}
						else{
							$study_year = date('Y', time());
						}
						$tableInternships=Db::getInstance()->select_internships($study_year);
						break;
						
					case 'settings' : 
						$vue = 'settings.php';
						$settings = Db::getInstance()->settings();
						break;
					
					case 'edit_teacher' : 
						$vue = 'edit_teacher.php';
						$teacher=Db::getInstance()->getTeacherById($_GET['edit_id']);
						break;

					case 'edit_professional' : 
						$vue = 'edit_professional.php';
						$professional=Db::getInstance()->getProfessionalById($_GET['edit_id']);
						break;
						
					case 'edit_firm' : 
						$vue = 'edit_firm.php';
						$firm=Db::getInstance()->getFirmById($_GET['edit_id']);
						break;
					
					case 'internship' : 
						$vue = 'internship_details.php';
						$internship=Db::getInstance()->getInternshipById($_GET['id']);
						break;
						
					default :
						$vue = 'manager.php';
						break;
				}
			}
			else
			{
				$vue = 'manager.php';
			}
		}
		elseif($_SESSION['job']=='teacher')
		{
			$vue = 'supervisor.php';
			if(isset($_GET['page'])){
				switch($_GET['page']){
					case 'supervisor_internships_list' : 
						$vue = 'supervisor_internships_list.php';
						$tableInternships = Db::getInstance()->getInternshipBySupervisor($teacher->getId());
						$title = 'Mes stages';
						break;
					case 'complete_internships_list' : 
						$vue = 'supervisor_internships_list.php';
						$tableInternships = Db::getInstance()->getInternshipComplete();
						$title = 'Les stages complétés';
						break;
					case 'internship' : 
						$vue = 'supervisor.php';
						if(!empty($_GET['id'])){
							$internship = Db::getInstance()->getInternshipById($_GET['id']);
							if($internship != null){
								$vue = 'internship_details.php';
							}
						}
						if($_GET['id'] != -1)
						break;
					default : 
						$vue = 'supervisor.php';
						break;
				}
			} 

		}
		
		$_SESSION['user'] = serialize($teacher);
		
		# Ecrire ici la vue
		require_once(CHEMIN_VUES . $vue);
	}
	

}
?>