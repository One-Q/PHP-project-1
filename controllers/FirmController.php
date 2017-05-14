<?php 
class FirmController{

	public function __construct() {
	
	}
			
	public function run(){	
			$notification = '';
			$disabled = '';
			$view = 'firm_exist_or_not.php';
			$internships_list = Db::getInstance()->select_internships_firm();

			#Check if at least an internship exist
			if(count($internships_list) == 0){
				$disabled = 'disabled';
			}


			if(isset($_POST['submit'])){
				#If the student submit an internship
				if($_POST['submission'] == 'off_list'){
					$view = 'firm_off_list.php';
				#if the student found an internship in the list
				}else{
					$view = 'firm_on_list.php';
					$id_firm = $_POST['select_internship'];
					$internship = Db::getInstance()->getInternshipByFirm($id_firm);
				}
			}

			
			if(isset($_POST['submit_firm'])){
				if(empty($_POST['firm_name']) || empty($_POST['firm_abbreviation']) ||empty($_POST['street']) ||empty($_POST['number']) ||empty($_POST['zip_code']) ||empty($_POST['promoter_firstname']) ||empty($_POST['promoter_surname']) ||empty($_POST['promoter_mail']) ||empty($_POST['contact_firstname']) ||empty($_POST['contact_surname']) ||empty($_POST['contact_mail']) ||empty($_POST['objective']) ||empty($_POST['work_environment']) ||empty($_POST['work_description'])){
					
					$notification = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Veuillez introduire les données siuvies d\'une astérisque</div>';
				}
				else{
					$id_firm = Db::getInstance()->getFirm($_POST['firm_name']);
					if($id_firm != -1){
						Db::getInstance()->modifyFirm($id_firm,$_POST['firm_name'],$_POST['firm_abbreviation'],$_POST['street'],$_POST['number'],$_POST['zip_code'],$_POST['firm_phone']);
					}else{
						Db::getInstance()->add_firm($_POST['firm_name'],$_POST['firm_abbreviation'],$_POST['street'],$_POST['number'],$_POST['zip_code'],$_POST['firm_phone']);
					}
					Db::getInstance()->add_contact($_POST['contact_surname'],$_POST['contact_firstname'],$_POST['contact_mail'],$_POST['contact_gsm'],$_POST['contact_phone'],$_POST['contact_job'],$_POST['contact_service']);
					Db::getInstance()->add_promoter($_POST['promoter_surname'],$_POST['promoter_firstname'],$_POST['promoter_mail'],$_POST['promoter_gsm'],$_POST['promoter_phone'],$_POST['promoter_job'],$_POST['promoter_service']);
					
					$id_firm = Db::getInstance()->getFirm($_POST['firm_name']);
					$id_promoter = Db::getInstance()->getPromoter($_POST['promoter_mail']);
					$id_contact = Db::getInstance()->getContact($_POST['contact_mail']);
					
					Db::getInstance()->add_internship_firm($id_firm,$id_promoter,$id_contact,$_POST['objective'],$_POST['work_description'],$_POST['work_environment'],$_POST['remark']);

					$view = 'home.php';
					$notification = '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Envoi réussi</div>';
				}
			}
		
			require_once(CHEMIN_VUES . $view);
			
	}
} 
?>