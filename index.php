<?php
	ob_start();
	session_start();
	$time_start = microtime(true);

	# Global variables
	define('CHEMIN_VUES','views/');
	$date = date("j/m/Y");
	
	# Charge all files of models/
	function chargerClasse($classe) {
		require_once('models/' . $classe . '.class.php');
	}
	spl_autoload_register('chargerClasse'); 

	# Link of the home
	if(!empty($_SESSION['user'])){
		$user = unserialize($_SESSION['user']);
		$job = $user->getJob();
		$_SESSION['user'] = serialize($user);
		if($job == 'students'){
			$_SESSION['home'] = 'index.php?action=student';
		}
		else{
			$_SESSION['home'] = 'index.php?action=teacher';
		}
	}else{
		$_SESSION['home'] = 'index.php';
	}
	
	require_once(CHEMIN_VUES . 'header.php');
	#Test link for the promoter
	$test = Db::myCrypt("Entreprise 3","Abbr 3");

	#Which action ?
	$action = (isset($_GET['action'])) ? htmlentities($_GET['action']) : 'default';
	switch($action) {	
		case 'login':
			require_once('controllers/LoginController.php');	
			$controller = new LoginController();
			break;
		case 'firm':
			require_once('controllers/FirmController.php');	
			$controller = new FirmController();
			break;
		case 'teacher':
			require_once('controllers/TeacherController.php');	
			$controller = new TeacherController();
			break;
		case 'student':
			require_once('controllers/StudentController.php');	
			$controller = new StudentController();
			break;
		case 'submission_internship':
			require_once('controllers/StudentInternshipSubmissionController.php');	
			$controller = new StudentInternshipSubmissionController();
			break;
		case 'first_connexion':
			require_once('controllers/FirstConnexionController.php');	
			$controller = new FirstConnexionController();
			break;	
		case 'logout':
			require_once('controllers/LogoutController.php');	
			$controller = new LogoutController();
			break;
		case 'url_firm':
			require_once('controllers/URLFirmController.php');	
			$controller = new URLFirmController();
			break;
		case 'exportPDF':
			require_once('controllers/ExportPDFController.php');	
			$controller = new ExportPDFController();
			break;
		default: 
			require_once('controllers/HomeController.php');	
			$controller = new HomeController();
			break;
	}
	# Execute the controller
	$controller->run();
	
	$time_end = microtime(true);
	$time = number_format(($time_end - $time_start)*1000,6);
	
	require_once(CHEMIN_VUES . 'footer.php');
	ob_end_flush();
?>