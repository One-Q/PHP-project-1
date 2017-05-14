<?php 
	class Firm{

		private $_id;
		private $_name;
		private $_abbreviation;
		private $_street;
		private $_phone_number;
		private $_number_street;
		private $_zip_code;

		public function __construct($id,$name,$abbreviation,$street,$phone_number='',$number_street,$zip_code){
			$this->_id = $id;
			$this->_name = $name;
			$this->_abbreviation = $abbreviation;
			$this->_street = $street;
			$this->_phone_number = $phone_number;
			$this->_number_street = $number_street;
			$this->_zip_code = $zip_code;
		}

		public function getId(){
			return $this->_id;
		}

		public function getName(){
			return $this->_name;
		}

		public function getAbbreviation(){
			return $this->_abbreviation;
		}

		public function getStreet(){
			return $this->_street;
		}

		public function getPhoneNumber(){
			return $this->_phone_number;
		}

		public function getNumberStreet(){
			return $this->_number_street;
		}

		public function getZipCode(){
			return $this->_zip_code;
		}
	}

 ?>