<?php 
class ExportPDFController{
	
	public function __construct() {

	}
		
	public function run(){	
	
		if(isset($_GET['year'])){
			$study_year = $_GET['year'];
		}
		else{
			$study_year = date('Y', time());
		}
		
		require ('lib/tcpdf/tcpdf.php');

		#stages exportés
		if(isset($_POST['export_internships'])){
			$tableInternships = Db::getInstance()->export_internships($_POST['study_year']);
			
			if(count($tableInternships)>0){
				// create new PDF document
				$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			}
				
			for ($i=0;$i<count($tableInternships);$i++) {
				
			$student = dB::getInstance()->getStudentById($tableInternships[$i]->getStudent());
			$firm = $tableInternships[$i]->getFirm(); 
			$promotor = $tableInternships[$i]->getPromoter();


			$pdf->AddPage();

			$studentFirstname = $student->getFirstname();
			$studentSurname = $student->getSurname();
			$firmName = $firm->getName();
			$promotorFirstname = $promotor->getFirstname();
			$promotorSurname = $promotor->getSurname();
			
			// create some HTML content
			$html = file_get_contents(CHEMIN_VUES . 'conventionstage.php');
			$html = str_replace("#studentFirstname#",$studentFirstname,$html);
			$html = str_replace("#studentSurname#",$studentSurname,$html);
			$html = str_replace("#firmName#",$firmName,$html);
			$html = str_replace("#promotorFirstname#",$promotorFirstname,$html);
			$html = str_replace("#promotorSurname#",$promotorSurname,$html);
			
			
			// add css
			$html .= '<style>'.file_get_contents(CHEMIN_VUES.'css/styleConvention.css').'</style>';

			// output the HTML content
			$pdf->writeHTML($html, true, 0, true, 0);

			// reset pointer to the last page
			$pdf->lastPage();
				
			}

			if(count($tableInternships)==1){
				$notification = '<div class="alert alert-success text-center" role="alert">'.count($tableInternships).' seul stage a été exporté</div>';	
			}
			else if(count($tableInternships)>1){
				$notification = '<div class="alert alert-success text-center" role="alert">'.count($tableInternships).' stages ont été exportés</div>';	
			}
			else
			{
				$notification = '<div class="alert alert-warning text-center" role="alert">Aucun stage n\'as été exporté !</div>';
			}
			
		}
		
		if(isset($pdf)){
			# Un contrôleur se termine en écrivant une vue qui est ici un PDF !
			//Close and output PDF document
			ob_end_clean();
			file_put_contents('conventions/example_021.pdf', $pdf->output());
				
		}
		else
		{
			$tableInternships=Db::getInstance()->select_internships($study_year);
			require_once(CHEMIN_VUES . 'internships_list.php');
		}
	}
	
}
?>