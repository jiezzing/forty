<?php
	class Get{
		private $conn;
        
		public function __construct($db){
			$this->conn = $db;
		}

		public function isEmailExist(){
			$query = "SELECT * FROM user WHERE email=?";
            
            $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$check = $this->conn->prepare($query);

			$check->bindParam(1, $this->email);

            $check->execute();
            
            return $check->rowCount();
		}

		public function currentId(){
			$query = "SELECT * FROM user";
            
            $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$count = $this->conn->prepare($query);

            $count->execute();
            
            return $count->rowCount();
		}

		public function login(){
			$query = "SELECT * FROM user WHERE email=? AND password=?";
            
            $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$select = $this->conn->prepare($query);

			$select->bindParam(1, $this->email);
			$select->bindParam(2, $this->password);

            $select->execute();
            
            return $select;
		}

		public function contacts(){
			$query = "SELECT * FROM contacts WHERE user_id=?";
            
            $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$select = $this->conn->prepare($query);

			$select->bindParam(1, $this->user_id);

            $select->execute();
            
            return $select;
		}
    }
?>