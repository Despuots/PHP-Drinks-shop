<?php

include($_SERVER['DOCUMENT_ROOT'] . "/drinks_shop/config/constants.php");
include('login_check.php');

?>


<html>
<head>
    <title>Gėrimų parduotuvė</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
<div class="nav text-center">
    <div class="wrapper">
        <ul>
            <li><a href="index.php">Pradzia</a></li>
            <li><a href="manage_admin.php">Admin</a></li>
            <li><a href="manage_category.php">Kategorijos</a></li>
            <li><a href="manage_drinks.php">Gėrimai</a></li>
            <li><a href="manage_order.php">Užsakymai</a></li>
            <li><a href="logout.php">Atsijungti</a></li>
        </ul>
    </div>
</div>