<?php 
	class Internship{

		private $_id_internship;
		private $_firm;
		private $_student;
		private $_supervisor;
		private $_promoter;
		private $_contact;
		private $_validator1;
		private $_validator2;
		private $_statement;
		private $_objective;
		private $_work_description;
		private $_work_environment;
		private $_remark;


		public function __construct($id_internship,$firm,$student = '',$supervisor = '',$promoter,$contact,$validator1 ='',$validator2 = '',$statement,$objective,$work_description,$work_environment,$remark){
			$this->_id_internship = $id_internship;
			$this->_firm = $firm;
			$this->_student = $student;
			$this->_supervisor = $supervisor;
			$this->_promoter = $promoter;
			$this->_contact = $contact;
			$this->_validator1 = $validator1;
			$this->_validator2 = $validator2;
			$this->_statement = $statement;
			$this->_objective = $objective;
			$this->_work_description = $work_description;
			$this->_work_environment = $work_environment;
			$this->_remark = $remark;
		}

		public function getIdInternship(){
			return $this->_id_internship;
		}

		public function getFirm(){
			return $this->_firm;
		}

		public function getStudent(){
			return $this->_student;
		}

		public function getSupervisor(){
			return $this->_supervisor;
		}

		public function getPromoter(){
			return $this->_promoter;
		}

		public function getContact(){
			return $this->_contact;
		}

		public function getValidator1(){
			return $this->_validator1;
		}

		public function getValidator2(){
			return $this->_validator2;
		}

		public function getStatement(){
			return $this->_statement;
		}

		public function getObjective(){
			return $this->_objective;
		}

		public function getWorkDescription(){
			return $this->_work_description;
		}
		public function getWorkEnvironment(){
			return $this->_work_environment;
		}
		public function getRemark(){
			return $this->_remark;
		}
	}

 ?>