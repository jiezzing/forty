<?php
	session_start(); 
    require_once '../../config/connection.php';
    require_once '../../model/contacts.php';

    $con = new connection();
	$db = $con->connect();

    $contact = new Contacts($db);

    $contact->user_id = $_SESSION['id'];
    $contact->key = $_POST['search'];

    $response = $contact->search();

    $hasMatch = false;

    while($data = $response->fetch(PDO::FETCH_ASSOC)){
        $hasMatch = true;
        echo'
            <tr class="tr-shadow">
                <td>'.$data['name'].'</td>
                <td>
                    <span class="block-email">'.$data['company'].'</span>
                </td>
                <td class="desc">'.$data['email'].'</td>
                <td>'.$data['phone'].'</td>
                <td>
                    <span class="status--process">'.$data['status'].'</span>
                </td>
                <td>
                    <div class="table-data-feature">
                        <a href="#"></a>
                        <button class="item edit" data-toggle="tooltip" data-placement="top" title="Edit" value="'.$data['id'].'">
                            <i class="zmdi zmdi-edit"></i>
                        </button>
                        <button class="item delete" data-toggle="tooltip" data-placement="top" title="Delete" value="'.$data['id'].'">
                            <i class="zmdi zmdi-delete"></i>
                        </button>
                    </div>
                </td>
            </tr>
        ';
    }

    if(!$hasMatch){
        echo'
            <tr class="tr-shadow" >
                <td colspan="7" class="text-center"> NO DATA FOUND </td>
            </tr>
        ';
    }
?>