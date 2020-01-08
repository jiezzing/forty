
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thank You</title>

    <?php
        $page = 'thankyou';
        include '../controller/auth.php';
        include '../css/custom.php';
    ?>

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-form">
                            <div class="form-group text-center">
                                <label>Thank you for your signing-up !</label>
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
        $(document).ready(function(){
            setTimeout(function(){
                window.location.href = "../pages/dashboard.php";
            }, 3000);
        })
    </script>
</body>
</html>