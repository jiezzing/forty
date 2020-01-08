<?php
	class Contacts{
		private $conn;
		public $name;
		public $company;
		public $email;
		public $phone;
		public $offset = 0;
		public $key;
        
		public function __construct($db){
			$this->conn = $db;
		}

		// Get all the specific contacts with total rows for pagination
		public function index(){
			$query = "SELECT (SELECT COUNT(user_id) FROM contacts) AS total, id, name, company, email, phone, status FROM contacts WHERE user_id=? ORDER BY id DESC LIMIT 5 OFFSET ".$this->offset."";
            
            $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$select = $this->conn->prepare($query);

			$select->bindParam(1, $this->user_id);

            $select->execute();
            
            return $select;
		}

		// Add new contact
		public function create(){
			$query = "INSERT INTO contacts(user_id, name, company, email, phone, status)  VALUES (?, ?, ?, ?, ?, 'active')";

			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);

			$insert = $this->conn->prepare($query);

			$insert->bindParam(1, $this->user_id);
			$insert->bindParam(2, $this->name);
			$insert->bindParam(3, $this->company);
			$insert->bindParam(4, $this->email);
			$insert->bindParam(5, $this->phone);

            $insert->execute();
            
			return $insert;
		}

		// Get the contact details of specified contact
		public function show(){
			$query = "SELECT * FROM contacts WHERE id=?";
            
            $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$select = $this->conn->prepare($query);

			$select->bindParam(1, $this->id);

            $select->execute();
            
            return $select;
		}

		// Save changes
		public function update(){
			$query = "UPDATE contacts SET name='".$this->name."', company='".$this->company."', email='".$this->email."', phone='".$this->phone."' WHERE id=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$update = $this->conn->prepare($query);

			$update->bindParam(1, $this->id);
			$update->execute();

			return $update;
		}

		// Delete the selected contact
		public function delete(){
			$query = "DELETE FROM contacts WHERE id=?";

			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);

			$delete = $this->conn->prepare($query);

			$delete->bindParam(1, $this->id);

            $delete->execute();
            
			return $delete;
		}

		// Search specific data
		public function search(){
			$query = "SELECT * FROM contacts WHERE user_id=? AND name LIKE '%".$this->key."%' OR company LIKE '%".$this->key."%' OR email LIKE '%".$this->key."%' OR phone LIKE '%".$this->key."%' ORDER BY id DESC LIMIT 5";
            
            $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$select = $this->conn->prepare($query);

			$select->bindParam(1, $this->user_id);

            $select->execute();
            
            return $select;
		}
    }
?>