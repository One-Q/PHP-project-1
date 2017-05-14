<?php 
class LogoutController{

	public function __construct() {
	
	}
			
	public function run(){	
		
			
			if(!isset($_SESSION['job'])){
				header('Location: index.php?action=login');
			}
			else
			{
				$_SESSION = array();
			}
		
		session_destroy();

		header("Location: index.php"); 
		die();
	}
} 
?>