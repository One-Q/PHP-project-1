<?php 
	class Teacher{
		private $_id;
		private $_surname;
		private $_firstname;
		private $_mail;
		private $_manager;
		private $_active;
		private $_job;

		public function __construct($id,$surname,$firstname,$mail,$manager,$active){
			$this->_id = $id;
			$this->_surname = $surname;
			$this->_firstname = $firstname;
			$this->_mail = $mail;
			$this->_manager = $manager;
			$this->_active = $active;
			$this->_job = 'teachers';
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

		public function isManager(){
			return $this->_manager;
		}

		public function isActive(){
			return $this->_active;
		}

		public function getJob(){
			return $this->_job;
		}
	}
 ?>