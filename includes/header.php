<header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
        <div class="header3-wrap">
            <div class="header__logo">
                <a href="../controller/logout.php">
                   Contact Management System
                </a>
            </div>
            <div class="header__tool">
                <div class="account-wrap">
                    <div class="account-item account-item--style2 clearfix js-item-menu">
                        <div class="content">
                            <a class="js-acc-btn" href="#" onclick="logout()">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    function logout(){
        window.location.href = "../controller/logout.php";
    }
</script>