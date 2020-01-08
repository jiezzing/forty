<?php
	session_start(); 
    require_once '../../config/connection.php';
    require_once '../../model/contacts.php';

    $con = new connection();
	$db = $con->connect();

    $contact = new Contacts($db);

    $contact->user_id = $_SESSION['id'];
    $contact->offset = ($_POST['index'] - 1) * 5;

    $result = $contact->index();

    while($data = $result->fetch(PDO::FETCH_ASSOC)){
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
                        <button class="item" data-toggle="modal" data-target="#edit" value="'.$data['id'].'">
                            <i class="zmdi zmdi-edit"></i>
                        </button>
                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                            <i class="zmdi zmdi-delete"></i>
                        </button>
                    </div>
                </td>
            </tr>
        ';
    }
?>