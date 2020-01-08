
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <?php
        $page = 'index';
        include 'controller/auth.php';
        include 'css/custom.php';
    ?>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-form">
                            <form id="login-form">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="login-checkbox">
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-5 m-t-15" type="submit">sign in</button>
                            </form>
                            <div class="register-link">
                                <p>
                                    Don't you have account?
                                    <a href="pages/register.php">Sign Up Here</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        include 'js/javascripts.php';
    ?>

    <script>
        $('button[type=submit]').on('click', function(event){
            event.preventDefault();
            
            var form = $('#login-form')[0];
            var data = new FormData(form);

            if(data.get('email') == '' || data.get('password') == ''){
                alert('Some fields are missing');
            }
            else{
                $.ajax({
                    type: "POST",
                    url: "controller/LoginController/login.php",
                    data: data,
                    contentType: false, // used when using FormData
                    processData: false, // used when using FormData
                    success: function(response){
                        if(response == 'success'){
                            window.location.href = "pages/dashboard.php";
                        }
                        else{
                            alert('Invalid email or password');
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
<!-- end document-->