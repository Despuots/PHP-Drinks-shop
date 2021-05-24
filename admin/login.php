<?php include('../config/constants.php') ?>


    <html>
    <head>
        <title>Prisijungti</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
    <div class="login">
        <h1 class="text-center">Prisijungti</h1>
        <?php

        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if (isset($_SESSION['no_login_message'])) {
            echo $_SESSION['no_login_message'];
            unset($_SESSION['no_login_message']);
        }
        ?>
        <br>
        <form action="" method="POST">

            Įveskite slapyvardį: <br>
            <input type="text" name="username" placeholder="Įveskite slapyvardį">
            <br><br>

            Įveskite slaptažodį: <br>
            <input type="password" name="password" placeholder="Įveskite slaptažodį">
            <br><br>

            <input type="submit" name="submit" value="Prisijungti" class="btn-primary">

        </form>
    </div>
    </body>
    </html>

<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {

        $count = mysqli_num_rows($res);

        echo $count;
        if ($count == 1) {
            $_SESSION['login'] = "<div class='success text-center'>Sėkmingai prisijungėte!</div>";
            $_SESSION['user'] = $username;
            header('location:' . SITE_URL . 'admin');
        } else {
            $_SESSION['login'] = "<div class='error text-center'>Neteisingas slapyvardis arba slaptažodis</div>";
            header('location:' . SITE_URL . 'admin/login.php');

        }
    } else {
        echo ':(';
    }

}
?>