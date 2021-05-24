<?php include('partials/nav.php');


if (isset($_SESSION['login'])) {
    echo $_SESSION['login'];
    unset($_SESSION['login']);
}

?>
    <div class="main-content">
        <div class="wrapper height_72">
            <h1>Administratorių valdymo skydelis</h1>

        </div>

    </div>

<?php include('partials/footer.php'); ?>