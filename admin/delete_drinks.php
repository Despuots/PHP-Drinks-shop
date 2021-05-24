<?php include('partials/nav.php'); ?>

<div class="main-content">
    <div class="wrapper text-center">
        <h4>Ar tikrai norite istrinti?</h4>
        <br>
        <form action="" method="POST">
            <input type="submit" name="submit" value="Ištrinti" class="btn-danger">
            <input type="submit" name="back" value="Atšaukti" class="btn-primary">
        </form>
    </div>
    <?php

    if (isset($_POST['submit'])) {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if ($image_name != "") {
            $path = "../images/drinks/" . $image_name;
            $remove = unlink($path);
        }

        $sql = "DELETE FROM tbl_drinks WHERE id = '$id'";

        $res = mysqli_query($conn, $sql);

        if ($res == TRUE) {
            $_SESSION['delete_drinks'] = "<div class='success text-center'>Gėrimas ištrintas</div>";
            header('location:' . SITE_URL . 'admin/manage_drinks.php');
        } else {
            $_SESSION['delete_category'] = "<div class='error text-center'>Įvyko klaida</div>";
            header('location:' . SITE_URL . 'admin/manage_drinks.php');
        }
    } elseif (isset($_POST['back'])) {
        header('location:' . SITE_URL . 'admin/manage_drinks.php');
    }

    ?>
</div>


<?php include('partials/footer.php'); ?>

