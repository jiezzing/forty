<?php
	session_start(); 
    require_once '../../config/connection.php';
    require_once '../../model/auth.php';
    require_once '../../model/registration.php';

    $con = new connection();
	$db = $con->connect();

    $auth = new Authentication($db);
    $register = new Registration($db);

    $register->email = $auth->email = $_POST['email'];
    $register->name = $_POST['name'];
    $register->company = $_POST['company'];
    $register->password = md5($_POST['password']);

    $result = $auth->isEmailExist();
    
    if($result > 0){
        echo 'exist';
    }
    else{
        $store = $register->create();
        
        if($store){
            $_SESSION['isLoggedIn'] = 1;
            $_SESSION['id'] = $register->id();
            $_SESSION['name'] =  $_POST['name'];
            echo 'success';
        }
        else{
            echo 'failed';
        }
    }
?>