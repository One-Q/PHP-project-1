<?php 
class Db{
		
	private static $instance = null;
	private $_db;
	# Cette classe va contenir toutes les
	# méthodes pour faire des requêtes
	# sur la base de données
	# $_db représente l’objet « connexion
	# à la base de données »
			
	# Connexion à la base de données
	# par instanciation de la classe PDO

	# $this->_db = new PDO('mysql:host=localhost;dbname=internship_application','root','root');

	# Le serveur MySQL : ici localhost
	# Le nom de la base de données : ici internship_application
	# Le nom d’utilisateur : ici root
	# Le mot de passe : ici root
		
		
	private function __construct(){
		#We did this because we worked on a Mac and a Windows, the password isn't the same
		try{
			$this->_db = new PDO('mysql:host=localhost;dbname=internship_application;charset=UTF8','root','root');
			$this->_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$this->_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
			}
		catch (PDOException $e) {
				try{
				$this->_db = new PDO('mysql:host=localhost;dbname=internship_application;charset=UTF8','root','');
				$this->_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$this->_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
				}
				catch (PDOException $e) {
					die('Erreur de connexion à la base de données : '. $e->getMessage()); 
				}
			}				
	}

	public static function getInstance() {
		
		if (is_null(self::$instance)) {
			self::$instance = new Db();
		}
		
		return self::$instance; 	
	}
	
	#Check if the $data in the $field from the $table exists
	public function exist($table, $field, $data){
		$query = 'SELECT * FROM '.$table.' WHERE '.$field.'="'.$data.'"';
		$result = $this->_db->query($query);
		
		if($result->rowcount()==0){
			return false;
		}
		return true;
		
	}
	

	public function inactive_all_teachers(){
		
		//deactivates all teacher
		$query = 'UPDATE teachers SET active=false';
		$qp = $this->_db->prepare($query);
		$qp->execute();
		
	}
	
	public function active_teacher($mail){
		
		//actives the teacher
		$query = 'UPDATE teachers SET active=true WHERE mail="'.$mail.'"';
		$qp = $this->_db->prepare($query);
		$qp->execute();
		
	}
	
	public function inactive_teacher($mail){
		
		//deactivates the teacher
		$query = 'UPDATE teachers SET active=false WHERE mail="'.$mail.'"';
		$qp = $this->_db->prepare($query);
		$qp->execute();
		
	}
	
	public function delete_teacher($mail,$id){
		
		//update the supervisor to the internship
		$query = 'UPDATE internships SET id_supervisor=null WHERE id_supervisor="'.$id.'"';
		$qp = $this->_db->prepare($query);
		$qp->execute();
		
		//delete the teacher
		$query = 'DELETE FROM teachers WHERE mail="'.$mail.'"';
		$qp = $this->_db->prepare($query);
		$qp->execute();
		
	}
	
	#Add a teacher in the database
	public function add_teacher($mail,$name,$firstname,$manager){
		
		$settings = $this->settings();
		$password = $settings[1];
		
		$mail = htmlspecialchars($mail);
		$name = htmlspecialchars($name);
		$firstname = htmlspecialchars($firstname);
		
		if($manager=="true"){ 
			$manager = 1; 
		}
		
		$query = 'INSERT INTO teachers (id_teacher, mail, surname, firstname, manager, active, password) VALUES("",:mail,:surname,:firstname,:manager,1,:password)';
		$qp = $this->_db->prepare($query);
		$qp->bindValue(':mail',$mail);
		$qp->bindValue(':surname',$name);
		$qp->bindValue(':firstname',$firstname);
		$qp->bindValue(':manager',$manager);
		$password = self::myCrypt($mail,$password);
		$qp->bindValue(':password', $password);
		$qp->execute();
		
	}
	
	#Count the number of internship the supervisor has
	public function coun_internship_supervisor($id){
		$query = 'SELECT * from internships WHERE id_supervisor='.$this->_db->quote($id);
		$result = $this->_db->query($query); 
		return $result->rowcount();
	}
	
	public function verif_csv_teacher($getfile){
		// Put all teachers to inactive
		$this->inactive_all_teachers();
		
		// Number of teachers
		$i = 0;
		
		// Open CSV file
		$file = fopen($getfile,"r");

		// Number of line
		$num = 0;
		//feof() test the end of the file
		while(!feof($file))
		 {
				  // Read line
				  // fget('Le fichier', '0 default', 'le séparateur')
				  $data = fgetcsv($file,0, ";");
				  
			if($num>0 && $data!=null){  
				  // Per line, we create data
				  $mail = $data[0];
				  $name = $data[1];
				  $firstname = $data[2];
				  $manager = $data[3];
				  
				  // if the teacher exist in the database
				  if($this->exist("teachers", "mail", $mail)){  
					// We active teacher
					$this->active_teacher($mail);
				  }
				  else{
					// We add teacher
					$this->add_teacher($mail,$name,$firstname,$manager);
					$i++;
				  }
			 }
			 $num++;
		 }

		// On ferme le fichier
		fclose($file);
		
		return $i;
	}

	#If the mail and password are corresponding, then it returns the id
	public function getTeacher($mail, $password){
		$password = self::myCrypt($mail,$password);
		$query = 'SELECT * from teachers WHERE mail='.$this->_db->quote($mail).' AND password='.$this->_db->quote($password);
		$result = $this->_db->query($query); 
		$id = 0; # Renvoyer 0 si l'utilisateur n'est pas valide
		if ($result->rowcount()!=0) {
			$row = $result->fetch(PDO::FETCH_ASSOC);
			$id = $row['id_teacher'];
		}
		return $id;
		
	}

	public function verif_csv_student($getfile){	

		// Number of students
		$i = 0;
		
		// Open CSV file
		$file = fopen($getfile,"r");

		//feof() test the end of the file
		while(!feof($file))
		 {
				  // Read line
				  // fget('Le fichier', '0 default', 'le séparateur')
				  $data = fgetcsv($file,0, ";");
				  
			if($data!=null){  
				  // Per line, we create data
				 $id = $data[0];
				 $name = $data[1];
				 $firstname = $data[2];
				 $mail = $data[3];
				  
				  // Get the current year
				  $this_year = date('Y', time());
				  
				  // If the student exist
				  if($this->exist("students", "id_student", $id)){  
					// We update the student
					$query = 'UPDATE students SET study_year='.$this_year.' WHERE id_student='.$id;
					$qp = $this->_db->prepare($query);
					$qp->execute();
					$i++;
				  }
				  else{
					// add student
					$this->add_student($id,$mail,$name,$firstname,$this_year);
					$i++;
				  }
				  
			 }
		 }

		// On ferme le fichier
		fclose($file);
		
		// Return 
		return $i;
	}
	
	#Add a student in the database
	public function add_student($id,$mail,$name,$firstname,$study_year){
		
		$settings = $this->settings();
		$password = $settings[3];
		
		$mail = htmlspecialchars($mail);
		$name = htmlspecialchars($name);
		
		$query = 'INSERT INTO students (id_student, surname, firstname, mail, password, study_year) VALUES(:id,:surname,:firstname,:mail,:password,:study_year)';
		$qp = $this->_db->prepare($query);
		$qp->bindValue(':mail',$mail);
		$qp->bindValue(':surname',$name);
		$qp->bindValue(':firstname',$firstname);
		$qp->bindValue(':id',$id);
		$password = self::myCrypt($mail,$password);
		$qp->bindValue(':password', $password);
		$qp->bindValue(':study_year', $study_year);
		$qp->execute();
		
	}

	#Update the $id_student
	public function completeStudent($id_student,$phone_number,$sex){
		$query = 'UPDATE students SET phone_number='. $this->_db->quote($phone_number) .', sex='. $this->_db->quote($sex) .' WHERE id_student = '.$id_student;
		$qp = $this->_db->prepare($query);
		$qp->execute();	
	}

	#Returns the id of the internship if $id_student has an internship
	public function hasInternship($id_student){
		$query = 'SELECT * from internships WHERE id_student='.$this->_db->quote($id_student);
		$result = $this->_db->query($query); 
		$id = -1; 
		if ($result->rowcount()!=0) {
			$row = $result->fetch(PDO::FETCH_ASSOC);
			$id = $row['id_student'];
		}
		return $id;
	}
	
	#If the mail and password are corresponding, then it returns the id
	public function getStudent($mail, $password){
		$password = self::myCrypt($mail,$password);
		$query = 'SELECT * from students WHERE mail='.$this->_db->quote($mail).' AND password='.$this->_db->quote($password);
		$result = $this->_db->query($query); 
		$id = 0; # Renvoyer 0 si l'utilisateur n'est pas valide
		if ($result->rowcount()!=0) {
			$row = $result->fetch(PDO::FETCH_ASSOC);
			$id = $row['id_student'];
		}
		return $id;
		
	}
	
	#Return the statement of the $student_id corresponding
	public function getStatusByStudent($student_id){
		
		$query = 'SELECT statement FROM internships WHERE id_student='.$student_id;
		$result = $this->_db->query($query); 

		if ($result->rowcount()==0) {
			return "Sans stage";
		}
		$row = $result->fetch(PDO::FETCH_ASSOC);
		return ucfirst($row['statement']);
		
	}
	
	#Returns all the student of the $study_year	
	public function select_students($study_year){
		
		$query = 'SELECT id_student,surname,firstname,mail, phone_number FROM students WHERE study_year = '.$study_year.' order by surname';
		$result = $this->_db->query($query);
		
		
		if($result->rowcount()!=0){
			$tablestudents = array();
			
			while($row = $result->fetch()){

				$tablestudents[] = new Student($row->id_student,$row->surname,$row->firstname,$row->mail,$row->phone_number);
			}
			
			return $tablestudents;
		}
		
	}

	#Returns all the firms
	public function select_firms(){
		
		$query = 'SELECT id_firm,name,abbreviation,street,phone_number,number_street,zip_code FROM firms order by name';
		$result = $this->_db->query($query);
		
		if($result->rowcount()!=0){
			$tablefirms = array();
			
			while($row = $result->fetch()){

				$tablefirms[] = new Firm($row->id_firm,$row->name,$row->abbreviation,$row->street,$row->phone_number,$row->number_street,$row->zip_code);
			}
			
			return $tablefirms;
		}
		
	}

	#Return the firm by the id
	public function getFirmById($id){
		$query = 'SELECT * from firms WHERE id_firm='.$this->_db->quote($id);
		$result = $this->_db->query($query); 
		$firm = null; 
		if ($result->rowcount()!=0) {
			$row = $result->fetch(PDO::FETCH_ASSOC);
			$firm = new Firm($row['id_firm'],$row['name'],$row['abbreviation'],$row['street'],$row['phone_number'],$row['number_street'],$row['zip_code']);
		}
		return $firm;
	}

	#Return the professional(Promoter/Contact) by the id
	public function getProfessionalById($id){
		$query = 'SELECT * from professionals WHERE id_professional='.$this->_db->quote($id);
		$result = $this->_db->query($query); 
		$professional = null; 
		if ($result->rowcount()!=0) {
			$row = $result->fetch(PDO::FETCH_ASSOC);
			$professional = new Professional($row['id_professional'],$row['surname'],$row['firstname'],$row['mail'],$row['phone_number'],$row['gsm'],$row['job'],$row['service'],$row['job_internship']);
		}
		return $professional;

	}

	#Return the student by the id
	public function getStudentById($id){
		$query = 'SELECT * from students WHERE id_student='.$this->_db->quote($id);
		$result = $this->_db->query($query); 
		$student = null; 
		if ($result->rowcount()!=0) {
			$row = $result->fetch(PDO::FETCH_ASSOC);
			$student = new Student($row['id_student'],$row['surname'],$row['firstname'],$row['mail'],$row['phone_number'],$row['sex'],$row['study_year']);
		}
		return $student;
	}

	#Return the teacher by the id
	public function getTeacherById($id){
		$query = 'SELECT * from teachers WHERE id_teacher='.$this->_db->quote($id);
		$result = $this->_db->query($query); 
		$teacher = null; 
		if ($result->rowcount()!=0) {
			$row = $result->fetch(PDO::FETCH_ASSOC);
			$teacher = new Teacher($row['id_teacher'],$row['surname'],$row['firstname'],$row['mail'],$row['manager'],$row['active']);
		}
		return $teacher;
	}

	#Validate the internship
	public function validateInternship($id_internship){
		
		$query = 'UPDATE internships SET validator1='.$_SESSION['id'].' WHERE validator1 is NULL AND id_internship = '.$id_internship;
		$qp = $this->_db->prepare($query);
		$qp->execute();

		$query = 'UPDATE internships SET validator2='.$_SESSION['id'].' WHERE validator2 is NULL AND validator1 != '.$_SESSION['id'].' AND id_internship = '.$id_internship;
		$qp = $this->_db->prepare($query);
		$qp->execute();		
		
	}
	
	#Check if the internship is validate
	public function internshipIsValidate($id_internship){
		$internship = $this->getInternshipById($id_internship);
		
		if($internship->getValidator1() != null && $internship->getValidator2() != null){
			
			if($internship->getStatement() == "soumis"){
				$query = 'UPDATE internships SET statement="libre" WHERE id_internship = '.$id_internship;
			}
			elseif($internship->getStatement() == "soumis et pris"){
				$query = 'UPDATE internships SET statement="attribué" WHERE id_internship = '.$id_internship;	
			}
			$qp = $this->_db->prepare($query);
			$qp->execute();
			
			return true;
		}
		return false;
	}

	#Return all the internships where the statement is Free
	public function select_internships_students(){
		
		$query = "SELECT * FROM internships WHERE statement = 'libre'";
		$result = $this->_db->query($query);
		
		if($result->rowcount()!=0){
			$tableInternships = array();
			
			while($row = $result->fetch()){
				$firm = $this->getFirmById($row->id_firm);
				$promoter = $this->getProfessionalById($row->id_promoter);
				$contact = $this->getProfessionalById($row->id_contact);
				$tableInternships[] = new Internship($row->id_internship,$firm,$row->id_student,$row->id_supervisor,$promoter,$contact,$row->validator1,$row->validator2,$row->statement,$row->objective,$row->work_description,$row->work_environment,$row->remark);
			}
			return $tableInternships;
		}
		
	}

	#Return all the internships where the statement is Completed
	public function getInternshipComplete(){
		
		$query = "SELECT * FROM internships WHERE statement = 'complété'";
		$result = $this->_db->query($query);
		
		if($result->rowcount()!=0){
			$tableInternships = array();
			
			while($row = $result->fetch()){
				$firm = $this->getFirmById($row->id_firm);
				$student = $this->getStudentById($row->id_student);
				$promoter = $this->getProfessionalById($row->id_promoter);
				$contact = $this->getProfessionalById($row->id_contact);
				$tableInternships[] = new Internship($row->id_internship,$firm,$student,$row->id_supervisor,$promoter,$contact,$row->validator1,$row->validator2,$row->statement,$row->objective,$row->work_description,$row->work_environment,$row->remark);
			}
			return $tableInternships;
		}
		
	}

	#Return all the firms OR the internship by a firm
	public function select_internships_firm($id_firm=''){
		if(empty($id_firm)){
			$query = "SELECT * FROM firms";
		}else{
			$query = "SELECT * FROM internships WHERE id_firm = ".$id_firm;
		}
		$result = $this->_db->query($query);

		$tableInternships = array();
		if($result->rowcount()!=0 && !empty($id_firm)){
			$row = $result->fetch(PDO::FETCH_ASSOC);
			$firm = $this->getFirmById($row['id_firm']);
			$promoter = $this->getProfessionalById($row['id_promoter']);
			$contact = $this->getProfessionalById($row['id_contact']);
			$internship = new Internship($row['id_internship'],$firm,$row['id_student'],$row['id_supervisor'],$promoter,$contact,$row['validator1'],$row['validator2'],$row['statement'],$row['objective'],$row['work_description'],$row['work_environment'],$row['remark']);
			return $internship;
		}elseif($result->rowcount()!=0){
			
				while($row = $result->fetch()){
					$tableInternships[] =  new Firm($row->id_firm,$row->name,$row->abbreviation,$row->street,$row->phone_number,$row->number_street,$row->zip_code);
				}
			
		}

		return $tableInternships;
		
	}
	
	#Return all the internships by the $study_year
	public function select_internships($study_year){
		
		$query = "SELECT * FROM internships";
		$result = $this->_db->query($query);
		
		if($result->rowcount()!=0){
			$tableInternships = array();
			
			while($row = $result->fetch()){
				$student = $this->getStudentById($row->id_student);
				
				if($student!=null && $student->getStudyYear() == $study_year){
					
					$firm = $this->getFirmById($row->id_firm);
					$promoter = $this->getProfessionalById($row->id_promoter);
					$contact = $this->getProfessionalById($row->id_contact);
					$tableInternships[] = new Internship($row->id_internship,$firm,$row->id_student,$row->id_supervisor,$promoter,$contact,$row->validator1,$row->validator2,$row->statement,$row->objective,$row->work_description,$row->work_environment,$row->remark);
				}
			}
			return $tableInternships;
		}
		
	}
	
	#Returns all the internships where statement is submitted
	public function select_internships_firme_manager(){
		
		$query = "SELECT * FROM internships WHERE statement = 'soumis'";
		$result = $this->_db->query($query);
		
		if($result->rowcount()!=0){
			$tableInternships = array();
			
			while($row = $result->fetch()){
				$firm = $this->getFirmById($row->id_firm);
				$promoter = $this->getProfessionalById($row->id_promoter);
				$contact = $this->getProfessionalById($row->id_contact);
				$tableInternships[] = new Internship($row->id_internship,$firm,$row->id_student,$row->id_supervisor,$promoter,$contact,$row->validator1,$row->validator2,$row->statement,$row->objective,$row->work_description,$row->work_environment,$row->remark);
			}
			return $tableInternships;
		}
		
	}
	
	#Returns all the internships where statement is submitted and taken
	public function select_internships_student_manager(){
		
		$query = "SELECT * FROM internships WHERE statement = 'soumis et pris'";
		$result = $this->_db->query($query);

		if($result->rowcount()!=0){
			$tableInternships = array();
			
			while($row = $result->fetch()){
				$firm = $this->getFirmById($row->id_firm);
				$promoter = $this->getProfessionalById($row->id_promoter);
				$contact = $this->getProfessionalById($row->id_contact);
				$tableInternships[] = new Internship($row->id_internship,$firm,$row->id_student,$row->id_supervisor,$promoter,$contact,$row->validator1,$row->validator2,$row->statement,$row->objective,$row->work_description,$row->work_environment,$row->remark);
			}
			return $tableInternships;
		}
		
	}
	
	#Return all the internships where there is no supervisor and the statement is exported
	public function select_internships_without_supervisor(){
		
		$query = "SELECT * FROM internships WHERE id_supervisor IS NULL AND statement = 'exporté'";
		$result = $this->_db->query($query);

		if($result->rowcount()!=0){
			$tableInternships = array();
			
			while($row = $result->fetch()){
				$firm = $this->getFirmById($row->id_firm);
				$student = $this->getStudentById($row->id_student);
				$promoter = $this->getProfessionalById($row->id_promoter);
				$contact = $this->getProfessionalById($row->id_contact);
				$tableInternships[] = new Internship($row->id_internship,$firm,$student,$row->id_supervisor,$promoter,$contact,$row->validator1,$row->validator2,$row->statement,$row->objective,$row->work_description,$row->work_environment,$row->remark);
			}
			return $tableInternships;
		}
		
	}

	#Return the internship by the id
	public function getInternshipById($id_internship){
		$query = "SELECT * FROM internships WHERE id_internship = " .$id_internship;
		$result = $this->_db->query($query);

		$internship = null;
		
		if ($result->rowcount()!=0) {
			$row = $result->fetch(PDO::FETCH_ASSOC);
			$student = $this->getStudentById($row['id_student']);
			$firm = $this->getFirmById($row['id_firm']);
			$promoter = $this->getProfessionalById($row['id_promoter']);
			$contact = $this->getProfessionalById($row['id_contact']);
			$internship = new Internship($row['id_internship'],$firm,$student,$row['id_supervisor'],$promoter,$contact,$row['validator1'],$row['validator2'],$row['statement'],$row['objective'],$row['work_description'],$row['work_environment'],$row['remark']);
		}

		return $internship;

	}

	#return the internship by the id of the firm
	public function getInternshipByFirm($id_firm){
		$query = "SELECT * FROM internships WHERE id_firm = " .$id_firm;
		$result = $this->_db->query($query);

		if ($result->rowcount()!=0) {
			$row = $result->fetch(PDO::FETCH_ASSOC);
			$student = $this->getStudentById($row['id_student']);
			$firm = $this->getFirmById($row['id_firm']);
			$promoter = $this->getProfessionalById($row['id_promoter']);
			$contact = $this->getProfessionalById($row['id_contact']);
			$internship = new Internship($row['id_internship'],$firm,$student,$row['id_supervisor'],$promoter,$contact,$row['validator1'],$row['validator2'],$row['statement'],$row['objective'],$row['work_description'],$row['work_environment'],$row['remark']);
		}

		return $internship;

	}

	#Return all the internships by the supervisor
	public function getInternshipBySupervisor($id_supervisor){
		$query = "SELECT * FROM internships WHERE id_supervisor = " .$id_supervisor;
		$result = $this->_db->query($query);

		if($result->rowcount()!=0){
			$tableInternships = array();
			
			while($row = $result->fetch()){
				$firm = $this->getFirmById($row->id_firm);
				$student = $this->getStudentById($row->id_student);
				$promoter = $this->getProfessionalById($row->id_promoter);
				$contact = $this->getProfessionalById($row->id_contact);
				$tableInternships[] = new Internship($row->id_internship,$firm,$student,$row->id_supervisor,$promoter,$contact,$row->validator1,$row->validator2,$row->statement,$row->objective,$row->work_description,$row->work_environment,$row->remark);
			}
			return $tableInternships;
		}


	}

	#Return the internship by the student
	public function getInternshipByStudent($id_student){
		$query = "SELECT * FROM internships WHERE id_student = " .$id_student;
		$result = $this->_db->query($query);
		
		# La méthode query est à privilégier
		# $result est un objet de la classe
		# PDOStatement
		
		if ($result->rowcount()!=0) {
			$row = $result->fetch(PDO::FETCH_ASSOC);
			$firm = $this->getFirmById($row['id_firm']);
			$promoter = $this->getProfessionalById($row['id_promoter']);
			$contact = $this->getProfessionalById($row['id_contact']);
			$validator1 = $this->getTeacherById($row['validator1']);
			$validator2 = $this->getTeacherById($row['validator2']);;
			$supervisor = $this->getTeacherById($row['id_supervisor']);;
			$internship = new Internship($row['id_internship'],$firm,$row['id_student'],$supervisor,$promoter,$contact,$validator1,$validator2,$row['statement'],$row['objective'],$row['work_description'],$row['work_environment'],$row['remark']);
		}

		return $internship;

	}

	#Attribute the supervisor to the internship
	public function attributeSupervisorInternship($id_supervisor,$id_internship){
		$query = 'UPDATE internships SET id_supervisor='. $id_supervisor .', statement="supervisé" WHERE id_internship = '.$id_internship;
		$qp = $this->_db->prepare($query);
		$qp->execute();
	}

	#Attribute the student to the internship
	public function attributeStudentInternship($id_student,$id_internship){
		$query = 'UPDATE internships SET id_student='. $id_student .', statement = "attribué" WHERE id_internship = '.$id_internship;
		$qp = $this->_db->prepare($query);
		$qp->execute();
	}

	#Return all the professionals(Promoters AND Contact)
	public function select_professionals(){
		
		$query = 'SELECT * FROM professionals order by surname';
		$result = $this->_db->query($query);

		if($result->rowcount()!=0){
			$tableprofesionnals = array();
			
			while($row = $result->fetch()){
				$id_firm = $this->getIdFirmByIdProfessional($row->id_professional);
				$firm_name = $this->getNameFirmById($id_firm);
				$tableprofesionnals[] = new Professional($row->id_professional,$row->surname,$row->firstname,$row->mail,$row->phone_number,$row->gsm,$row->job,$row->service,$row->job_internship,$firm_name);
			}
			
			return $tableprofesionnals;
		}
		
	}

	#Return all the teachers
	public function select_teachers(){
		
		$query = 'SELECT * FROM teachers order by surname';
		$result = $this->_db->query($query);
		
		# La méthode query est à privilégier
		# $result est un objet de la classe
		# PDOStatement
		
		if($result->rowcount()!=0){
			$tableteachers = array();
			
			while($row = $result->fetch()){

				$tableteachers[] = new Teacher($row->id_teacher,$row->surname,$row->firstname,$row->mail,$row->manager,$row->active);
			}
			
			return $tableteachers;
		}
		
	}

	#Return the id of the promoter by the mail
	public function getPromoter($mail){
		$mail = htmlspecialchars($mail);
		$query = "SELECT * from professionals WHERE mail=".$this->_db->quote($mail)."AND job_internship = 'P'";
		$result = $this->_db->query($query); 
		$id = 0; 
		if ($result->rowcount()!=0) {
			$row = $result->fetch(PDO::FETCH_ASSOC);
			$id = $row['id_professional'];
		}
		return $id;
	}

	#Return the id of the contact by the mail
	public function getContact($mail){
		$mail = htmlspecialchars($mail);
		$query = 'SELECT * from professionals WHERE mail='.$this->_db->quote($mail)."AND job_internship = 'C'";
		$result = $this->_db->query($query); 
		$id = 0; 
		if ($result->rowcount()!=0) {
			$row = $result->fetch(PDO::FETCH_ASSOC);
			$id = $row['id_professional'];
		}
		return $id;
	}

	#Return a user in the $table by the $id
	public function select_user($id, $table) {
		if($table == 'teachers'){
			$id_table = 'id_teacher';
		}
		elseif($table == 'students')
		{
			$id_table = 'id_student';
		}
		# Définition du query
		$query = 'SELECT * FROM ' . $table . ' WHERE '. $id_table .' = '.$id;
		# Exécution du query
		$result = $this->_db->query($query); 
		$user = null;
		if ($result->rowcount()!=0) {
			$row = $result->fetch();
			if($table == 'teachers'){
				$user = new Teacher($row->id_teacher,$row->surname,$row->firstname,$row->mail,$row->manager,$row->active);
			}
			elseif($table == 'students'){
		    	$user = new Student($row->id_student,$row->surname,$row->firstname,$row->mail,$row->phone_number,$row->sex,$row->study_year);
			}
		}

		return $user;
	}

	#Update the password in the $table for the $id
	public function update_password($id,$password,$table){
		$id_table = '';
		if($table == 'teachers'){
			$id_table = 'id_teacher';
		}
		elseif($table == 'students')
		{
			$id_table = 'id_student';
		}
		$query = 'UPDATE '. $table .' SET password="' . $password . '" WHERE '. $id_table .' ='.$id;
		$qp = $this->_db->prepare($query);
		$qp->execute();
	}

	#Return the firm by the name
	public function getFirm($name){
		$name = htmlspecialchars($name);
		$query = 'SELECT * from firms WHERE name='.$this->_db->quote($name);
		$result = $this->_db->query($query); 
		$id = -1; 
		if ($result->rowcount()!=0) {
			$row = $result->fetch(PDO::FETCH_ASSOC);
			$id = $row['id_firm'];
		}
		return $id;
	}

	#Return the firm by the id
	public function getNameFirmById($id_firm){
		$query = "SELECT * from firms WHERE id_firm = $id_firm";
		$result = $this->_db->query($query); 
		$name = ""; 
		if ($result->rowcount()!=0) {
			$row = $result->fetch(PDO::FETCH_ASSOC);
			$name = $row['name'];
		}
		return $name;
	}

	#Return the firm by the id of a professional(Promoter OR Contact)
	public function getIdFirmByIdProfessional($id_professional){
		$query = "SELECT * from internships WHERE id_promoter=$id_professional OR id_contact=$id_professional";
		$result = $this->_db->query($query); 
		$id = 0; 
		if ($result->rowcount()!=0) {
			$row = $result->fetch(PDO::FETCH_ASSOC);
			$id = $row['id_firm'];
		}
		return $id;
	}

	#Add a firm
	public function add_firm($name,$abbreviation,$street,$number_street,$zip_code,$phone_number){
		$name = htmlspecialchars($name);
		$abbreviation = htmlspecialchars($abbreviation);
		$street = htmlspecialchars($street);
		$number_street = htmlspecialchars($number_street);
		$zip_code = htmlspecialchars($zip_code);
		
		
		$query = 'INSERT INTO firms (id_firm,name, abbreviation, street, number_street, zip_code, phone_number) VALUES("",:name,:abbreviation,:street,:number_street,:zip_code,:phone_number)';
		$qp = $this->_db->prepare($query);
		$qp->bindValue(':name',$name);
		$qp->bindValue(':abbreviation',$abbreviation);
		$qp->bindValue(':street',$street);
		$qp->bindValue(':number_street',$number_street);
		$qp->bindValue(':zip_code', $zip_code);
		$qp->bindValue(':phone_number', $phone_number);
		$qp->execute();
	}

	#Update a firm
	public function modifyFirm($id_firm,$name,$abbreviation,$street,$number_street,$zip_code,$phone_number){
		$name = htmlspecialchars($name);
		$abbreviation = htmlspecialchars($abbreviation);
		$street = htmlspecialchars($street);
		$number_street = htmlspecialchars($number_street);
		$zip_code = htmlspecialchars($zip_code);
		
		
		$query = 'UPDATE firms SET name="'.$name.'", abbreviation="'.$abbreviation.'", street="'.$street.'", number_street="'.$number_street.'", zip_code="'.$zip_code.'", phone_number="'.$phone_number.'" WHERE id_firm = '.$id_firm;
		$qp = $this->_db->prepare($query);
		$qp->execute();
	}

	#Add a contact
	public function add_contact($surname,$firstname,$mail,$gsm,$phone_number,$job,$service){
		$surname = htmlspecialchars($surname);
		$firstname = htmlspecialchars($firstname);
		$mail = htmlspecialchars($mail);
		$service = htmlspecialchars($service);
		$job = htmlspecialchars($job);

		$query = 'INSERT INTO professionals (surname,firstname,mail,phone_number,gsm,job,service,job_internship) VALUES(:surname,:firstname,:mail,:phone_number,:gsm,:job,:service,:job_internship)';
		$qp = $this->_db->prepare($query);
		$qp->bindValue(':surname',$surname);
		$qp->bindValue(':firstname',$firstname);
		$qp->bindValue(':mail',$mail);
		$qp->bindValue(':phone_number',$phone_number);
		$qp->bindValue(':gsm',$gsm);
		$qp->bindValue(':job',$job);
		$qp->bindValue(':service',$service);
		$qp->bindValue(':job_internship','C');
		$qp->execute();
	}

	#Update a professional(Promoter OR Contact)
	public function modifyProfessional($id_prof,$surname,$firstname,$mail,$gsm,$phone_number,$job,$service){
		$surname = htmlspecialchars($surname);
		$firstname = htmlspecialchars($firstname);
		$mail = htmlspecialchars($mail);
		$service = htmlspecialchars($service);
		$job = htmlspecialchars($job);

		$query = 'UPDATE professionals SET surname="'.$surname.'", firstname="'.$firstname.'", mail="'.$mail.'", gsm="'.$gsm.'", phone_number="'.$phone_number.'", job="'.$job.'", service="'.$service.'" WHERE id_professional = '.$id_prof;
		$qp = $this->_db->prepare($query);
		$qp->execute();
	}

	#Add a promoter
	public function add_promoter($surname,$firstname,$mail,$gsm,$phone_number,$job,$service){
		$surname = htmlspecialchars($surname);
		$firstname = htmlspecialchars($firstname);
		$mail = htmlspecialchars($mail);
		$service = htmlspecialchars($service);
		$job = htmlspecialchars($job);

		$query = 'INSERT INTO professionals (surname,firstname,mail,phone_number,gsm,job,service,job_internship) VALUES(:surname,:firstname,:mail,:phone_number,:gsm,:job,:service,:job_internship)';
		$qp = $this->_db->prepare($query);
		$qp->bindValue(':surname',$surname);
		$qp->bindValue(':firstname',$firstname);
		$qp->bindValue(':mail',$mail);
		$qp->bindValue(':phone_number',$phone_number);
		$qp->bindValue(':gsm',$gsm);
		$qp->bindValue(':job',$job);
		$qp->bindValue(':service',$service);
		$qp->bindValue(':job_internship','P');
		$qp->execute();
	}

	#Add an internship by firm
	public function add_internship_firm($id_firm,$id_promoter,$id_contact,$objective,$work_description,$work_environment,$remark){
		$objective = htmlspecialchars($objective);
		$work_description = htmlspecialchars($work_description);
		$work_environment = htmlspecialchars($work_environment);
		$remark = htmlspecialchars($remark);

		$query = 'INSERT INTO internships (id_firm,id_promoter,id_contact,statement,objective,work_description,work_environment,remark) VALUES(:id_firm,:id_promoter,:id_contact,:statement,:objective,:work_description,:work_environment,:remark)';
		$qp = $this->_db->prepare($query);
		$qp->bindValue(':id_firm',$id_firm);
		$qp->bindValue(':id_promoter',$id_promoter);
		$qp->bindValue(':id_contact',$id_contact);
		$qp->bindValue(':statement','soumis');
		$qp->bindValue(':objective',$objective);
		$qp->bindValue(':work_description',$work_description);
		$qp->bindValue(':work_environment',$work_environment);
		$qp->bindValue(':remark',$remark);
		$qp->execute();
	}

	#Update an internship
	public function modifyInternship($id_internship,$objective,$work_description,$work_environment,$remark){
		$objective = htmlspecialchars($objective);
		$work_description = htmlspecialchars($work_description);
		$work_environment = htmlspecialchars($work_environment);
		$remark = htmlspecialchars($remark);

		$query = 'UPDATE internships SET objective="'.$objective.'", work_description="'.$work_description.'", work_environment="'.$work_environment.'", remark="'.$remark.'", statement="complété" WHERE id_internship = '.$id_internship;
		$qp = $this->_db->prepare($query);
		$qp->execute();
	}

	#Add an internship by student
	public function add_internship_student($id_firm,$id_student,$id_promoter,$id_contact,$objective,$work_description,$work_environment,$remark){
		$objective = htmlspecialchars($objective);
		$work_description = htmlspecialchars($work_description);
		$work_environment = htmlspecialchars($work_environment);
		$remark = htmlspecialchars($remark);

		$query = 'INSERT INTO internships (id_firm,id_student,id_promoter,id_contact,statement,objective,work_description,work_environment,remark) VALUES(:id_firm,:id_student,:id_promoter,:id_contact,:statement,:objective,:work_description,:work_environment,:remark)';
		$qp = $this->_db->prepare($query);
		$qp->bindValue(':id_firm',$id_firm);
		$qp->bindValue(':id_student',$id_student);
		$qp->bindValue(':id_promoter',$id_promoter);
		$qp->bindValue(':id_contact',$id_contact);
		$qp->bindValue(':statement','soumis et pris');
		$qp->bindValue(':objective',$objective);
		$qp->bindValue(':work_description',$work_description);
		$qp->bindValue(':work_environment',$work_environment);
		$qp->bindValue(':remark',$remark);
		$qp->execute();
	}

	#Crypt a password with a mail
	public static function myCrypt($mail,$password){
		$salt = sha1(strrev($mail).$password); # SALT personnalisé
		$salt = substr($salt, 0, 22); # Trunc du SALT à 22 caractères utiles pour la technique BLOWFISH
		return crypt($password,'$2y$10$'.$salt.'$');
	}
	
	#Return all the settings in config.properties
	public function settings(){
		$myfile = fopen("models/config.properties.txt", "r") or die("Unable to open file!");
		$settings = array();
		while(!feof($myfile)) {
		  $settings[] = substr(fgets($myfile), 0, -1);
		}
		fclose($myfile);
		return $settings;
	}
	
	#Update the settings
	public function editSettings($intership_date_begin,$intership_date_end,$intership_deadline,$password_teacher,$password_student){
		$file = "models/config.properties.txt";
		$myfile = fopen($file, "r") or die("Unable to open file!");
		ftruncate($myfile,0);
		$content = 
		"Teacher Password\n".$password_teacher."\nStudents Password\n".$password_student."\nInternship date begining\n".$intership_date_begin."\nInternship date end\n".$intership_date_end."\nDeadline\n".$intership_deadline."\n";
		
		file_put_contents($file, $content);
	}
	
	#Reset all the passwords for students
	public function refresh_all_password_students($new_password){
		$query = 'SELECT mail FROM students';
		$result = $this->_db->query($query);
		
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$password = self::myCrypt($row['mail'],$new_password);
			$query = 'UPDATE students SET password="'.$password.'" WHERE mail = "'.$row['mail'].'"';
			$qp = $this->_db->prepare($query);
			$qp->execute();
				
		}
	}
	
	#Reset all the passwords for teachers
	public function refresh_all_password_teachers($new_password){
		$query = 'SELECT mail FROM teachers';
		$result = $this->_db->query($query);
		
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$password = self::myCrypt($row['mail'],$new_password);
			$query = 'UPDATE teachers SET password="'.$password.'" WHERE mail = "'.$row['mail'].'"';
			$qp = $this->_db->prepare($query);
			$qp->execute();
				
		}
	}
	
	#Update a teahcer
	public function edit_teacher($edit_teacher_surname,$edit_teacher_firstname,$edit_teacher_mail,$edit_teacher_manager,$edit_teacher_id){
			
			$query = 'UPDATE teachers SET mail="'.$edit_teacher_mail.'",surname="'.$edit_teacher_surname.'",firstname="'.$edit_teacher_firstname.'",manager='.$edit_teacher_manager.' WHERE id_teacher = '.$edit_teacher_id.'';
			$qp = $this->_db->prepare($query);
			$qp->execute();
	}
	
	#Update a professional
	public function edit_professional($edit_professional_surname,$edit_professional_firstname,$edit_professional_mail,$edit_professional_phoneNumber,$edit_professional_gsm,$edit_professional_job,$edit_professional_service,$edit_professional_id){
			
			$query = 'UPDATE professionals SET mail="'.$edit_professional_mail.'",surname="'.$edit_professional_surname.'",firstname="'.$edit_professional_firstname.'",phone_number="'.$edit_professional_phoneNumber.'",gsm="'.$edit_professional_gsm.'",job="'.$edit_professional_job.'",service="'.$edit_professional_service.'" WHERE id_professional = '.$edit_professional_id.'';
			$qp = $this->_db->prepare($query);
			$qp->execute();
	}
	
	#Update a firm
	public function edit_firm($edit_firm_name,$edit_firm_abbreviation,$edit_firm_street,$edit_firm_number,$edit_firm_zipCode,$edit_firm_phoneNumber,$edit_firm_id){
			
			$query = 'UPDATE firms SET name="'.$edit_firm_name.'",abbreviation="'.$edit_firm_abbreviation.'",street="'.$edit_firm_street.'",number_street="'.$edit_firm_number.'",zip_code="'.$edit_firm_zipCode.'",phone_number="'.$edit_firm_phoneNumber.'" WHERE id_firm = '.$edit_firm_id.'';
			$qp = $this->_db->prepare($query);
			$qp->execute();
	}
	
	#Export
	public function export_internships($study_year){
		$query = 'SELECT * FROM internships WHERE statement="complété"';
		$result = $this->_db->query($query);

		if($result->rowcount()!=0){
			$tableInternships = array();
			
			while($row = $result->fetch()){
				$student = $this->getStudentById($row->id_student);
				
				if($student!=null && $student->getStudyYear() == $study_year){
					
					$query = 'UPDATE internships SET statement="exporté" WHERE id_internship = "'.$row->id_internship.'"';
					$qp = $this->_db->prepare($query);
					$qp->execute();
			
					$firm = $this->getFirmById($row->id_firm);
					$promoter = $this->getProfessionalById($row->id_promoter);
					$contact = $this->getProfessionalById($row->id_contact);
					$tableInternships[] = new Internship($row->id_internship,$firm,$row->id_student,$row->id_supervisor,$promoter,$contact,$row->validator1,$row->validator2,$row->statement,$row->objective,$row->work_description,$row->work_environment,$row->remark);
				}
			}
			return $tableInternships;
		}
		return null;
	}

}
?>