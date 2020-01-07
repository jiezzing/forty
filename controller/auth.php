<?php
    session_start();
    if($page == 'index' || $page == 'register'){
        if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == 1){
            header("Location: pages/dashboard.php");
        }
    }
    else if($page == 'register'){
        if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == 1){
            header("Location: ../pages/dashboard.php");
        }
    }
    else{
        if(!isset($_SESSION['isLoggedIn'])){
            header("Location: ../index.php");
        }
    }
?>