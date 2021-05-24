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
    $sql = "DELETE FROM tbl_admin WHERE id = '$id'";

    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        $_SESSION['delete'] = "<div class='success text-center'>Administratorius ištrintas</div>";
        header('location:' . SITE_URL . 'admin/manage_admin.php');
    } else {
        $_SESSION['delete'] = "<div class='error text-center'>Įvyko klaida</div>";
        header('location:' . SITE_URL . 'admin/manage_admin.php');
    }
} elseif (isset($_POST['back'])) {
    header('location:' . SITE_URL . 'admin/manage_admin.php');
}
?>
