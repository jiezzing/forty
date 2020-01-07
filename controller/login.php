<?php
	session_start(); 
    require_once '../config/connection.php';
    require_once '../model/get.php';

    $con = new connection();
	$db = $con->connect();

    $get = new Get($db);

    $get->email = $_POST['email'];
    $get->password = md5($_POST['password']);

    $user = $get->login();

    if($row = $user->fetch(PDO::FETCH_ASSOC)){
        $_SESSION['isLoggedIn'] = 1;
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        echo 'success';
    }
    else{
        echo 'failed';
    }
?>