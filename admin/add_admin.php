<?php include('partials/nav.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Administratoriaus sukūrimo forma</h1>
        <br><br>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Įveskite vardą:</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Įveskite savo vardą">
                    </td>
                </tr>
                <tr>
                    <td>Įveskite Slapyvardį:</td>
                    <td>
                        <input type="text" name="username" placeholder="Įveskite savo slapyvardį">
                    </td>
                </tr>
                <tr>
                    <td>Įveskite slaptažodį:</td>
                    <td><input type="password" name="password" placeholder="Įveskite savo slaptažodį"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Registruoti" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php') ?>

<?php

if (isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";

    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    if ($res == TRUE) {
        $_SESSION['add'] = "<div class='success text-center'>Administratorius sukurtas</div>";
        header('location:' . SITE_URL . 'admin/manage_admin.php');
    } else {
        $_SESSION['add'] = "<div class='error text-center'>Ivyko klaida</div>";
        header('location:' . SITE_URL . 'admin/add_admin.php');
    }
}
?>
