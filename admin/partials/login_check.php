<?php

    if (!isset($_SESSION['user'])) {
        $_SESSION['no_login_message'] = "<div class='error text-center'>Prisijunkite kaip administratorius!</div>";
        header('location:'.SITE_URL.'admin/login.php');
    }

?>