<?php
class StudentController{

	public function __construct() {
	
	}
		
	public function run(){
		$notification = '';
		$view = 'internships_firm_list.php';
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
			$view = 'internship_student.php';
			$internship = Db::getInstance()->getInternshipByStudent($id_student);
		}else{
			$tableInternships=Db::getInstance()->select_internships_students();
		}
		

		

		
		$_SESSION['user'] = serialize($user);
		
		# Ecrire ici la vue
		require_once(CHEMIN_VUES . $view);
	}
	

}
?>