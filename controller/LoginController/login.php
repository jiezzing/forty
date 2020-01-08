<?php
	session_start(); 
    require_once '../../config/connection.php';
    require_once '../../model/auth.php';

    $con = new connection();
	$db = $con->connect();

    $auth = new Authentication($db);

    $auth->email = $_POST['email'];
    $auth->password = md5($_POST['password']);

    $user = $auth->login();

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