<?php 
class LoginController{

	public function __construct() {

	}
			
	public function run(){
		$vue = 'home.php';
		$notification = '';
		
		//Get defaults password
		$settings = Db::getInstance()->settings();
		$password_teacher = $settings[1];
		$password_student = $settings[3];

		//Checks if the button was clicked 
		if(isset($_POST['connexion'])){
			//If no email address and no password were insert then returns a notification
			if(empty($_POST['email']) && empty($_POST['password'])) {
				$notification='<div class="alert alert-danger" role="alert">Authentifiez-vous</div>';
			}
			//If no email address was insert then returns a notification
			elseif(empty($_POST['email'])){
				$notification='<div class="alert alert-danger" role="alert">Vous n\'avez pas introduis de mail</div>';
			}
			//If no password was insert then returns a notification
			elseif(empty($_POST['password'])){
				$notification='<div class="alert alert-danger" role="alert">Vous n\'avez pas introduis de mot de passe</div>';
			}
			//If all the inputs have been filled
			else{
				$mail = $_POST['email'];
				$password = $_POST['password'];

				//Checks if the teacher exists
				$id_teacher = Db::getInstance()->getTeacher($mail,$password);
				$id_student = Db::getInstance()->getStudent($mail,$password);
				
				if($id_teacher != 0){
					$user = Db::getInstance()->select_user($id_teacher,'teachers');
					$_SESSION['surname'] = $user->getSurname();
					$_SESSION['firstname'] = $user->getFirstname();
					$_SESSION['id'] = $user->getId();
					//Checks if the teacher is active
					if($user->isActive()){
						//Checks if the teacher is a manager
						if($user->isManager()){
							$_SESSION['job'] = 'manager';
						}
						else{
							$_SESSION['job'] = 'teacher';
						}
						$_SESSION['user'] = serialize($user);
						if($password == $password_teacher){
							$_SESSION['origin_password'] = true;
							header("Location: index.php?action=first_connexion");
							die();
						}
						header("Location: index.php?action=teacher");
						die();
					}
					else{
						$notification='<div class="alert alert-danger" role="alert">Vous n\'êtes plus actif</div>';
					}
				}
				//Checks if the student exists
				elseif($id_student != 0){
					$_SESSION['job'] = 'student';
					$user = Db::getInstance()->select_user($id_student,'students');
					$_SESSION['surname'] = $user->getSurname();
					$_SESSION['firstname'] = $user->getFirstname();
					$_SESSION['internship'] = Db::getInstance()->hasInternship($user->getId());
					$_SESSION['user'] = serialize($user);
					if($password == $password_student){
						$_SESSION['origin_password'] = true;
						header("Location: index.php?action=first_connexion");
						die();

					}
					header("Location: index.php?action=student");
					die();
				}
				else{
					$notification='<div class="alert alert-danger" role="alert">Vos identifiants ne correspondent pas</div>';
				}
			}

		}

		# Un contrôleur se termine en écrivant une vue
		require_once(CHEMIN_VUES . $vue);
	}
} 
?>