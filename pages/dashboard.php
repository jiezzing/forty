
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard 3</title>
    <?php
        $page = 'dashboard';
        require_once '../controller/auth.php';
        require_once '../config/connection.php';
        require_once '../model/contacts.php';
        include '../css/custom.php';

        $con = new connection();
        $db = $con->connect();

        $get = new Contacts($db);

        $get->user_id = $_SESSION['id'];

        $hasContacts = false;
        $total_pages = 0;
    ?>

</head>

<body class="animsition">
    <div class="page-wrapper">

        <?php
            include '../includes/header.php';
        ?>

        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">
            <!-- BREADCRUMB-->
            <section class="au-breadcrumb2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="au-breadcrumb-content">
                                <div class="au-breadcrumb-left">
                                    <span class="au-breadcrumb-span">You are here:</span>
                                    <ul class="list-unstyled list-inline au-breadcrumb__list">
                                        <li class="list-inline-item active">
                                            <a href="#">Home</a>
                                        </li>
                                        <li class="list-inline-item seprate">
                                            <span>/</span>
                                        </li>
                                        <li class="list-inline-item">Dashboard</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->

            <!-- WELCOME-->
            <section class="welcome p-t-10">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="title-4">Welcome
                                <span><?php echo $_SESSION['name'] ?> !</span>
                            </h1>
                            <hr class="line-seprate">
                        </div>
                    </div>
                </div>
            </section>
            <!-- END WELCOME-->

            <!-- DATA TABLE-->
            <section class="p-t-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                    <form class="au-form-icon--sm">
                                        <input class="au-input--w300 au-input--style2" type="text" id="search" placeholder="Search . . .">
                                        <button class="au-btn--submit2" type="submit">
                                            <i class="zmdi zmdi-search"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="table-data__tool-right">
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small" onclick="addContact()">
                                        <i class="zmdi zmdi-plus"></i>add new contact</button>
                                </div>
                            </div>
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2">
                                    <thead>
                                        <tr>
                                            <th>name</th>
                                            <th>company</th>
                                            <th>email</th>
                                            <th>phone</th>
                                            <th>status</th>
                                            <th>actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="result">
                                        <?php
                                            // Get all specific contacts
                                            $contacts = $get->index();
                                            while($data = $contacts->fetch(PDO::FETCH_ASSOC)){
                                                $hasContacts = true;
                                                $total_pages = $data['total'];
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

                                            if(!$hasContacts){
                                                echo'
                                                    <tr class="tr-shadow" >
                                                        <td colspan="7" class="text-center"> NO DATA FOUND </td>
                                                    </tr>
                                                ';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END DATA TABLE-->

            <!-- COPYRIGHT-->
            <section class="p-t-60 p-b-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <?php
                                            for($index = 1; $index <= ceil($total_pages / 5); $index++){
                                                echo '<li class="page-item pages" value="'.$index.'"><a class="page-link" href="#">'.$index.'</a></li>';
                                            }
                                        ?>
                                  </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="largeModalLabel">Edit Contact</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button id="update" type="button" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END COPYRIGHT-->
        </div>

    </div>

    <?php
        include '../js/javascripts.php';
    ?>

    <script>
        // Global declration
        window.id = 0;

        // Direct to page coz href attribute is not working in this template
        function addContact() {
            window.location.href = '../pages/add_contact.php';
        }

        // Search for the data that only visible to the table
        $('#search').on('keyup', function(event) {
            var key = $(this).val().toLowerCase();
            var hasMatch = false;

            // jQuery solution of search filtering
            $("#result tr").filter(function() {
                if($(this).text().toLowerCase().indexOf(key) > -1)
                    hasMatch = true;
                $(this).toggle($(this).text().toLowerCase().indexOf(key) > -1);
            });

            if(!hasMatch){
                $('#result').append('<tr class="tr-shadow"><td colspan="7" class="text-center"> NO DATA FOUND </td></tr>');
            }

            // Using ajax and sql
            // $.ajax({
            //     type: "POST",
            //     url: "../controller/ContactController/search.php",
            //     data: { 
            //         search: key
            //     },
            //     success: function(html){
            //         $('#result').html(html);
            //     },
            //     error: function(xhr, ajaxOptions, thrownError){
            //         alert(thrownError);
            //     }
            // }); 
        });

        // Pagination
        $(document).on('click', '.pages', function(event) {
            event.preventDefault();

            var page = $(this).attr('value');

            $.ajax({
                type: "POST",
                url: "../controller/ContactController/pagination.php",
                data: { index: page },
                success: function(response){
                    $('#result').html(response);
                },
                error: function(xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
            }); 
        });

        // Delete specific contact
        $(document).on('click', '.delete', function(event) {
            event.preventDefault();

            var data = $(this).attr('value');
            var response = confirm('Do you want to delete this contact?');

            if(response == true){
                $.ajax({
                    type: "POST",
                    url: "../controller/ContactController/delete.php",
                    data: { data: data },
                    success: function(response){
                        if(response == 'success'){
                            alert('Contact successfully deleted');
                            location.reload();
                        }
                        else{
                            alert('An error occured');
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        alert(thrownError);
                    }
                }); 
            }
            else{
                return false;
            }
        });

        // Show details of selected contact
        $(document).on('click', '.edit', function(event) {
            event.preventDefault();

            id = $(this).attr('value');

            $.ajax({
                type: "POST",
                url: "../controller/ContactController/show.php",
                data: { id: id },
                success: function(response){
                    $('.modal-body').html(response);
                    $('#edit').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
            }); 
        })

        // Update selected contact
        $('#update').on('click', function(event) {
            event.preventDefault();

            var form = $('#update-form')[0];
            var data = new FormData(form);

            data.append('id', id);

            if(data.get('name') == '' || data.get('company') == '' || data.get('email') == '' || 
            data.get('phone') == ''){
                alert('Some fields are missing');
            }
            else{
                $.ajax({
                    type: "POST",
                    url: "../controller/ContactController/update.php",
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response == 'success'){
                            alert('Successfully updated');
                            location.reload();
                        }
                        else{
                            alert('An error occured');
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        alert(thrownError);
                    }
                }); 
            }
        })
    </script>
</body>
</html>
