<?php 
	class Professional{

		private $_id;
		private $_surname;
		private $_firstname;
		private $_mail;
		private $_phone_number;
		private $_gsm;
		private $_job;
		private $_service;
		private $_job_internship;
		private $_firm_name;

		public function __construct($id,$surname,$firstname,$mail,$phone_number,$gsm,$job,$service,$job_internship,$firm_name = ''){
			$this->_id = $id;
			$this->_surname = $surname;
			$this->_firstname = $firstname;
			$this->_mail = $mail;
			$this->_phone_number = $phone_number;
			$this->_gsm = $gsm;
			$this->_service = $service;
			$this->_job = $job;
			$this->_job_internship = $job_internship;
			$this->_firm_name = $firm_name;
		}

		public function getId(){
			return $this->_id;
		}

		public function getSurname(){
			return $this->_surname;
		}

		public function getFirstname(){
			return $this->_firstname;
		}

		public function getMail(){
			return $this->_mail;
		}

		public function getPhoneNumber(){
			return $this->_phone_number;
		}

		public function getGsm(){
			return $this->_gsm;
		}

		public function getService(){
			return $this->_service;
		}

		public function getJob(){
			return $this->_job;
		}

		public function getJobInternship(){
			return $this->_job_internship;
		}
		
		public function getFirm(){
			return $this->_firm_name;
		}
	}

 ?>