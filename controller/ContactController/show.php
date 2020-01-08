<?php
	session_start(); 
    require_once '../../config/connection.php';
    require_once '../../model/contacts.php';

    $con = new connection();
	$db = $con->connect();

    $contact = new Contacts($db);

    $contact->id = $_POST['id'];

    $response = $contact->show();

    if($column = $response->fetch(PDO::FETCH_ASSOC)){
        echo '
            <form id="update-form">
                <div class="form-group">
                    <label for="name" class=" form-control-label">Name</label>
                    <input type="text" id="name" name="name" value="'.$column['name'].'" class="form-control">
                </div>
                <div class="form-group">
                    <label for="company" class=" form-control-label">Company</label>
                    <input type="text" id="company" name="company" value="'.$column['company'].'" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email" class=" form-control-label">Email Address</label>
                    <input type="email" id="email" name="email" value="'.$column['email'].'" class="form-control">
                </div>
                <div class="form-group">
                    <label for="phone" class=" form-control-label">Phone Number</label>
                    <input type="phone" id="phone" name="phone" value="'.$column['phone'].'" class="form-control">
                </div>
            </form>
        ';
    }
?>