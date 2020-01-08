<?php
	class Authentication{
		private $conn;
		public $offset = 0;
        
		public function __construct($db){
			$this->conn = $db;
		}

		// Check if email already exist
		public function isEmailExist(){
			$query = "SELECT * FROM user, contacts WHERE user.email=contacts.email OR user.email=?";
            
            $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$check = $this->conn->prepare($query);

			$check->bindParam(1, $this->email);

            $check->execute();
            
            return $check->rowCount();
		}

		// Login to dashboard
		public function login(){
			$query = "SELECT * FROM user WHERE email=? AND password=?";
            
            $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$select = $this->conn->prepare($query);

			$select->bindParam(1, $this->email);
			$select->bindParam(2, $this->password);

            $select->execute();
            
            return $select;
		}
    }
?>