<?php
	session_start(); 
    require_once '../../config/connection.php';
    require_once '../../model/contacts.php';
    require_once '../../model/auth.php';

    $con = new connection();
	$db = $con->connect();

    $contact = new Contacts($db);
    $auth = new Authentication($db);

    $auth->email = $contact->email = $_POST['email'];
    $contact->user_id = $_SESSION['id'];
    $contact->name = $_POST['name'];
    $contact->company = $_POST['company'];
    $contact->phone = $_POST['phone'];

    $row = $auth->isEmailExist();
    
    if($row > 0){
        echo 'exist';
    }
    else{
        $save = $contact->create();
        if($save){
            echo 'success';
        }
        else{
            echo 'failed';
        }
    }
?>