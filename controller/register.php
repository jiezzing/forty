<?php
	session_start(); 
    require_once '../config/connection.php';
    require_once '../model/store.php';
    require_once '../model/get.php';

    $con = new connection();
	$db = $con->connect();

    $insert = new Store($db);
    $get = new Get($db);

    $get->email = $insert->email = $_POST['email'];
    $insert->name = $_POST['name'];
    $insert->company = $_POST['company'];
    $insert->password = md5($_POST['password']);

    $row = $get->isEmailExist();
    
    if($row > 0){
        echo 'exist';
    }
    else{
        $store = $insert->register();
        
        if($store){
            $_SESSION['isLoggedIn'] = 1;
            $_SESSION['id'] = $get->currentId();
            $_SESSION['name'] =  $_POST['name'];
            echo 'success';
        }
        else{
            echo 'failed';
        }
    }
?>