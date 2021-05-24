<?php
include($_SERVER['DOCUMENT_ROOT'] . "/drinks_shop/config/constants.php");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/drinks.css">
    <title>Gėrimų parduotuvė</title>
</head>
<body>
<section class="navbar">
    <div class="container">
        <div class="flex_menu space_between">
            <div class="logo">
                <a href="<?php echo SITE_URL; ?>">
                    <img src="https://img.icons8.com/cute-clipart/64/000000/soda-cup.png"/>
                </a>
            </div>
            <div class="menu text_right">
                <ul>
                    <li>
                        <a href="<?php echo SITE_URL; ?>">Pradžia</a>
                    </li>
                    <li>
                        <a href="<?php echo SITE_URL; ?>categories.php">Kategorijos</a>
                    </li>
                    <li>
                        <a href="<?php echo SITE_URL; ?>drinks.php">Gėrimai</a>
                    </li>
                    <li>
                        <a href="<?php echo SITE_URL; ?>admin/index.php">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>