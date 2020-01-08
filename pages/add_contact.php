
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Forms</title>
    <?php
        $page = 'add';
        include '../controller/auth.php';
        include '../css/custom.php';
    ?>

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-container">
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Add Contact</strong>
                                        <small> Form</small>
                                    </div>
                                    <div class="card-body card-block">
                                        <form id="contact-form">
                                            <div class="form-group">
                                                <label for="name" class=" form-control-label">Name</label>
                                                <input type="text" id="name" name="name" placeholder="Name" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="company" class=" form-control-label">Company</label>
                                                <input type="text" id="company" name="company" placeholder="Company" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class=" form-control-label">Email Address</label>
                                                <input type="email" id="email" name="email" placeholder="Email Address" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone" class=" form-control-label">Phone Number</label>
                                                <input type="phone" id="phone" name="phone" placeholder="Phone Number" class="form-control">
                                            </div>
                                        </form>
                                        <div class="form-group">
                                            <button id="add" type="submit" class="btn btn-lg btn-info btn-block">
                                                <span>ADD NEW CONTACT</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        include '../js/javascripts.php';
    ?>

    <script>
        // Add new contact
        $('#add').on('click', function(event){
            event.preventDefault();
            var form =  $('#contact-form')[0];
            var data = new FormData(form);
            
            if(data.get('name') == '' || data.get('company') == '' || data.get('email') == '' || 
            data.get('phone') == ''){
                alert('Some fields are missing');
            }
            else{
                $.ajax({
                    type: "POST",
                    url: "../controller/ContactController/create.php",
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response == 'success'){
                            alert('Successfully added');
                            window.location.href = '../pages/dashboard.php';
                        }
                        else if(response == 'exist'){
                            alert('Email already exist');
                        }
                        else{
                            alert('An error occurred');
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        alert(thrownError);
                    }
                }); 
            }
        });
    </script>
</body>
</html>
