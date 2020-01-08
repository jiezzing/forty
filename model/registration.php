<?php
	class Registration{
		private $conn;
        
		public function __construct($db){
			$this->conn = $db;
		}


		// Create new user
		public function create(){
			$query = "INSERT INTO user(name, company, email, password, status)  VALUES (?, ?, ?, ?, 'active')";

			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);

			$insert = $this->conn->prepare($query);

			$insert->bindParam(1, $this->name);
			$insert->bindParam(2, $this->company);
			$insert->bindParam(3, $this->email);
			$insert->bindParam(4, $this->password);

            $insert->execute();
            
			return $insert;
		}

		// Used for the current id after registration
		public function id(){
			$query = "SELECT * FROM user";
            
            $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$count = $this->conn->prepare($query);

            $count->execute();
            
            return $count->rowCount();
		}
    }
?>