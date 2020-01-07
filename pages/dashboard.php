
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard 3</title>
    <?php
        $page = 'dashboard';
        require_once '../controller/auth.php';
        require_once '../config/connection.php';
        require_once '../model/get.php';
        include '../css/custom.php';

        $con = new connection();
        $db = $con->connect();

        $get = new Get($db);
        $get->id = $_SESSION['id'];
        $hasContacts = false;
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
                                    <form class="au-form-icon--sm" action="" method="post">
                                        <input class="au-input--w300 au-input--style2" type="text" placeholder="Search for datas &amp; reports...">
                                        <button class="au-btn--submit2" type="submit">
                                            <i class="zmdi zmdi-search"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="table-data__tool-right">
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                        <i class="zmdi zmdi-plus"></i>add new contact</button>
                                </div>
                            </div>
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2">
                                    <thead>
                                        <tr>
                                            <th>
                                                <label class="au-checkbox">
                                                    <input type="checkbox">
                                                    <span class="au-checkmark"></span>
                                                </label>
                                            </th>
                                            <th>name</th>
                                            <th>company</th>
                                            <th>email</th>
                                            <th>password</th>
                                            <th>status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while($row = $get->contacts()->fetch(PDO::FETCH_ASSOC)){
                                                $hasContacts = true;
                                                echo'
                                                    <tr class="tr-shadow">
                                                        <td>
                                                            <label class="au-checkbox">
                                                                <input type="checkbox">
                                                                <span class="au-checkmark"></span>
                                                            </label>
                                                        </td>
                                                        <td>Lori Lynch</td>
                                                        <td>
                                                            <span class="block-email">lori@example.com</span>
                                                        </td>
                                                        <td class="desc">Samsung S8 Black</td>
                                                        <td>2018-09-27 02:12</td>
                                                        <td>
                                                            <span class="status--process">Processed</span>
                                                        </td>
                                                        <td>$679.00</td>
                                                        <td>
                                                            <div class="table-data-feature">
                                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
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

                                            if(!$hasContacts){
                                                echo'
                                                    <tr class="tr-shadow">
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
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END COPYRIGHT-->
        </div>

    </div>

    <?php
        include '../js/javascripts.php';
    ?>

</body>

</html>
<!-- end document-->
