<?php 
class URLFirmController{

	public function __construct() {
	
	}
			
	public function run(){	
			$notification = '';
			$view = 'url_firm.php';
			$tableFirms = Db::getInstance()->select_firms();
			$id_firm = -1;
			$internship = null;

			if(isset($_GET['url']) && !empty($_GET['url'])){
				for ($i=0; $i < count($tableFirms); $i++) { 
					$crypt = Db::myCrypt($tableFirms[$i]->getName(),$tableFirms[$i]->getAbbreviation());
					if($crypt == $_GET['url']){
						$id_firm = $tableFirms[$i]->getId();
						break;
					}
				}
				if($id_firm != -1){
					$internship = Db::getInstance()->getInternshipByFirm($id_firm);
				}
				if(isset($_POST['submit'])){
					if(empty($_POST['firm_name']) || empty($_POST['firm_abbreviation']) ||empty($_POST['street']) ||empty($_POST['number']) ||empty($_POST['zip_code']) ||empty($_POST['promoter_firstname']) ||empty($_POST['promoter_surname']) ||empty($_POST['promoter_mail']) ||empty($_POST['contact_firstname']) ||empty($_POST['contact_surname']) ||empty($_POST['contact_mail']) ||empty($_POST['objective']) ||empty($_POST['work_environment']) ||empty($_POST['work_description']) || empty($_POST['promoter_gsm']) || empty($_POST['promoter_phone']) || empty($_POST['promoter_service']) || empty($_POST['promoter_job'])  || empty($_POST['contact_gsm']) || empty($_POST['contact_phone']) || empty($_POST['contact_service'])  || empty($_POST['contact_job']) || empty($_POST['remark'])){
					
						$notification = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Veuillez introduire toutes les données manquantes</div>';
					}else{
						Db::getInstance()->modifyProfessional($internship->getPromoter()->getId(),$_POST['promoter_surname'],$_POST['promoter_firstname'],$_POST['promoter_mail'],$_POST['promoter_gsm'],$_POST['promoter_phone'],$_POST['promoter_job'],$_POST['promoter_service']);
						Db::getInstance()->modifyProfessional($internship->getContact()->getId(),$_POST['contact_surname'],$_POST['contact_firstname'],$_POST['contact_mail'],$_POST['contact_gsm'],$_POST['contact_phone'],$_POST['contact_job'],$_POST['contact_service']);
						Db::getInstance()->modifyFirm($internship->getFirm()->getId(),$_POST['firm_name'],$_POST['firm_abbreviation'],$_POST['street'],$_POST['number'],$_POST['zip_code'],$_POST['firm_phone']);
						Db::getInstance()->modifyInternship($internship->getIdInternship(),$_POST['objective'],$_POST['work_description'],$_POST['work_environment'],$_POST['remark']);
						$notification = '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Modifications réussies</div>';
						$internship = Db::getInstance()->getInternshipByFirm($internship->getFirm()->getId());
					}
				}
			} else{
				$view = 'no_url_firm';
			}

			require_once(CHEMIN_VUES . $view);
			
	}
} 
?>