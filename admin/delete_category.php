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
    </div>



<?php include('partials/footer.php'); ?>

<?php

if (isset($_POST['submit'])) {

    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    $path = "../images/category/".$image_name;
    $remove = unlink($path);

    $sql = "DELETE FROM tbl_category WHERE id = '$id'";

    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        $_SESSION['delete_category'] = "<div class='success text-center'>Kategorija ištrinta</div>";
        header('location:'.SITE_URL.'admin/manage_category.php');
    }
    else {
        $_SESSION['delete_category'] = "<div class='error text-center'>Įvyko klaida</div>";
        header('location:'.SITE_URL.'admin/manage_category.php');
    }
}
elseif (isset($_POST['back'])) {
    header('location:'.SITE_URL.'admin/manage_category.php');
}

?>