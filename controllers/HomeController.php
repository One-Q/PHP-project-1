<?php 
class HomeController{
	
	public function __construct() {
	
	}
			
	public function run(){	
		$notification = '';
		$view = 'home.php';

		if(!empty($_SESSION['user'])){
			$user = unserialize($_SESSION['user']);
			$job = $user->getJob();
			$_SESSION['user'] = serialize($user);
			if($job == 'student'){
				header("Location: index.php?action=student");
				die();
			}
			else{
				header("Location: index.php?action=teacher");
				die();
			}
		}
		
		
		# Un contrôleur se termine en écrivant une vue
		require_once(CHEMIN_VUES . 'home.php');
	}
	
}
?>