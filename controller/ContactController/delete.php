<?php
	session_start(); 
    require_once '../../config/connection.php';
    require_once '../../model/contacts.php';

    $con = new connection();
	$db = $con->connect();

    $contact = new Contacts($db);

    $contact->id = $_POST['data'];

    $result = $contact->delete();
        
    if($result){
        echo 'success';
    }
    else{
        echo 'failed';
    }
?>