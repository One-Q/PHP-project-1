<?php
class FirstConnexionController{

	public function __construct() {
	
	}
		
	public function run(){
		$notification = '';
		$view = 'first_connexion.php';
		//If no one is connected then you are redirected to index.php
		if (empty($_SESSION['job'])) {
			header("Location: index.php"); 
			die(); 
		}		
		//The user is identified
		//The user is :
		$user = unserialize($_SESSION['user']);

		if(isset($_POST['update_password'])){
			//If no password was insert then returns a notification
			if(empty($_POST['new_password'])){
				$notification='<div class="alert alert-danger" role="alert">Vous n\'avez pas introduis de nouveau mot de passe</div>';
			}
			else{
				$password = Db::myCrypt($user->getMail(),$_POST['new_password']);
				Db::getInstance()->update_password($user->getId(),$password,$user->getJob());
				$job = $user->getJob();
				$_SESSION['origin_password'] = false;
				$_SESSION['user'] = serialize($user);
				if($job == 'students'){
					header("Location: index.php?action=student");
					die();
				}else{
					header("Location: index.php?action=teacher");
					die();
				}
			}
		}

		
		
		# Ecrire ici la vue
		require_once(CHEMIN_VUES . $view);
	}
	

}
?>