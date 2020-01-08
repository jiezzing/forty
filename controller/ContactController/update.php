<?php
	session_start(); 
    require_once '../../config/connection.php';
    require_once '../../model/contacts.php';

    $con = new connection();
	$db = $con->connect();

    $contact = new Contacts($db);

    $contact->id = $_POST['id'];
    $contact->email = $_POST['email'];
    $contact->name = $_POST['name'];
    $contact->company = $_POST['company'];
    $contact->phone = $_POST['phone'];

    $save = $contact->update();
    
    if($save){
        echo 'success';
    }
    else{
        echo 'failed';
    }
?>