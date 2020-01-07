
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Forms</title>
    <?php
        $page = 'register';
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
                                        <strong>Registration</strong>
                                        <small> Form</small>
                                    </div>
                                    <div class="card-body card-block">
                                        <form id="registration-form">
                                            <div class="form-group">
                                                <label for="name" class=" form-control-label">Name</label>
                                                <input type="text" id="name" name="name" placeholder="Name" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="company" class=" form-control-label">Company</label>
                                                <input type="text" id="company" name="company" placeholder="Company" class="form-control">
                                            </div>
                                            
                                            <div class="row form-group">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="email" class=" form-control-label">Email Address</label>
                                                        <input type="email" id="email" name="email" placeholder="Email Address" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="password" class=" form-control-label">Password</label>
                                                        <input type="password" id="password" name="password" placeholder="Password" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="confirm-password" class=" form-control-label">Confirm Password</label>
                                                        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="form-group">
                                            <button id="register" type="submit" class="btn btn-lg btn-info btn-block">
                                                <span>Register</span>
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
        $('#register').on('click', function(event){
            event.preventDefault();
            var form =  $('#registration-form')[0];
            var data = new FormData(form);
            
            if(data.get('name') == '' || data.get('company') == '' || data.get('email') == '' || 
            data.get('password') == '' || data.get('confirm-password') == ''){
                alert('Some fields are missing');
            }
            else if(data.get('password') != data.get('confirm-password')){
                alert('Password does not match');
            }
            else{
                $.ajax({
                    type: "POST",
                    url: "../controller/register.php",
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response == 'success'){
                            alert('Successfully registered');
                            window.location.href = "../pages/thankyou.php";
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
