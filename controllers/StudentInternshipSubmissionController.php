<?php
class StudentInternshipSubmissionController{

	public function __construct() {
	
	}
		
	public function run(){
		$notification = '';
		$disabled = '';
		$view = 'internships_list.php';
		# Si un petit fûté écrit ?action=admin sans passer par l'action login
		if($_SESSION['job']!='student' || empty($_SESSION['job'])) {
			header("Location: index.php"); # redirection HTTP vers l'action login
			die(); 
		}

		if(isset($_SESSION['origin_password']) && $_SESSION['origin_password'] == true){
			header("Location: index.php?action=first_connexion");
			die();
		}	
		

		# Arrivé ici l'authentification est valide... continuons...
		# L'utilisateur authentifié est :
		$user = unserialize($_SESSION['user']);
		$student = $user;


		# Variables HTML pour les vues (deux vues possibles dans cette page-ci)
		$id_student = $student->getId();
		$id_internship = Db::getInstance()->hasInternship($id_student);
		$_SESSION['internship'] = $id_internship;
		if($id_internship != -1){
			header("Location: index.php?action=student"); # redirection HTTP vers l'action login
			die();
		}else{
			$internships_list=Db::getInstance()->select_internships_students();
			if(count($internships_list) == 0){
				$disabled = 'disabled';
			}
			$view = 'submission_internship.php';
		}


		if(isset($_POST['submit'])){
			if($_POST['submission'] == 'off_list'){
				$view = 'submission_off_list.php';
			}else{
				$view = 'submission_on_list.php';
				$id_internship = $_POST['select_internship'];
				$internship = Db::getInstance()->getInternshipById($id_internship);
			}
		}

		$change = false;
		if(isset($_POST['accept_internship'])){
			if(!empty($_POST['student_phone'])){
				$view = 'internship_student.php';
				$id_internship = $_POST['id_internship'];
				Db::getInstance()->completeStudent($id_student,$_POST['student_phone'],$_POST['sex']);
				$student->setSex($_POST['sex']);
				$student->setPhoneNumber($_POST['student_phone']);
				Db::getInstance()->attributeStudentInternship($id_student, $id_internship);
				$_SESSION['internship'] = $id_internship;
				$change = true;
			}else{
				$notification = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Vous n\'avez pas donné votre numéro de téléphone</div>';
			}
		}

		if(isset($_POST['submission_internship'])){
			if(empty($_POST['firm_name']) || empty($_POST['firm_abbreviation']) ||empty($_POST['street']) ||empty($_POST['number']) ||empty($_POST['zip_code']) ||empty($_POST['promoter_firstname']) ||empty($_POST['promoter_surname']) ||empty($_POST['promoter_mail']) ||empty($_POST['contact_firstname']) ||empty($_POST['contact_surname']) ||empty($_POST['contact_mail']) ||empty($_POST['objective']) ||empty($_POST['work_environment']) ||empty($_POST['work_description'])){
				$notification = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Veuillez introduire les données siuvies d\'une astérisque</div>';
			}
			else{
				Db::getInstance()->completeStudent($id_student,$_POST['student_phone'],$_POST['sex']);
				$student->setSex($_POST['sex']);
				$student->setPhoneNumber($_POST['student_phone']);

				Db::getInstance()->add_firm($_POST['firm_name'],$_POST['firm_abbreviation'],$_POST['street'],$_POST['number'],$_POST['zip_code'],$_POST['firm_phone']);
				Db::getInstance()->add_contact($_POST['contact_surname'],$_POST['contact_firstname'],$_POST['contact_mail'],$_POST['contact_gsm'],$_POST['contact_phone'],$_POST['contact_job'],$_POST['contact_service']);
				Db::getInstance()->add_promoter($_POST['promoter_surname'],$_POST['promoter_firstname'],$_POST['promoter_mail'],$_POST['promoter_gsm'],$_POST['promoter_phone'],$_POST['promoter_job'],$_POST['promoter_service']);
				
				$id_firm = Db::getInstance()->getFirm($_POST['firm_name']);
				var_dump($id_firm);
				$id_promoter = Db::getInstance()->getPromoter($_POST['promoter_mail']);
				$id_contact = Db::getInstance()->getContact($_POST['contact_mail']);
				Db::getInstance()->add_internship_student($id_firm,$id_student,$id_promoter,$id_contact,$_POST['objective'],$_POST['work_description'],$_POST['work_environment'],$_POST['remark']);
				$internship = Db::getInstance()->getInternshipByStudent($id_student);
				$_SESSION['internship'] = $internship->getIdInternship();
				$change = true;
			}
		}
		
		$_SESSION['user'] = serialize($student);

		if($change){
			header('Location: index.php?action=student');
			die;
		}
		
		# Ecrire ici la vue
		require_once(CHEMIN_VUES . $view);
	}
	

}
?>