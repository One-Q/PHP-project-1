<?php 
	class Student{

		private $_id;
		private $_surname;
		private $_firstname;
		private $_mail;
		private $_phone_number;
		private $_sex;
		private $_study_year;
		private $_job;

		public function __construct($id,$surname,$firstname,$mail,$phone_number='',$sex='',$study_year=''){
			$this->_id = $id;
			$this->_surname = $surname;
			$this->_firstname = $firstname;
			$this->_mail = $mail;
			$this->_phone_number = $phone_number;
			$this->_sex = $sex;
			$this->_study_year = $study_year;
			$this->_job = 'students';
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

		public function getSex(){
			return $this->_sex;
		}

		public function getStudyYear(){
			return $this->_study_year;
		}

		public function getJob(){
			return $this->_job;
		}

		public function setSex($sex){
			$this->_sex = $sex;
		}

		public function setPhoneNumber($phone_number){
			$this->_phone_number = $phone_number;
		}
	}

 ?>