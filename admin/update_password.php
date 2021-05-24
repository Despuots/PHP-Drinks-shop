<?php include('partials/nav.php') ?>

<?php

if (isset($_SESSION['user_not_found'])) {
    echo $_SESSION['user_not_found'];
    unset($_SESSION['user_not_found']);
}
if (isset($_SESSION['pwd_not_match'])) {
    echo $_SESSION['pwd_not_match'];
    unset($_SESSION['pwd_not_match']);
}

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Slaptažodzio keitimas</h1>
        <br><br>

        <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            }
        ?>
        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Įveskite seną slaptažodį: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Senas slptažodis">
                    </td>
                </tr>
                <tr>
                    <td>Įveskite naują slaptažodį: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="Naujas slaptažodis">
                    </td>
                </tr>
                <tr>
                    <td>Pakartokite slaptažodį: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Pakartokite slaptažodį">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Pakeisti slaptažodį" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        $sql = "SELECT * FROM tbl_admin WHERE id= $id AND password= '$current_password'";

        $res = mysqli_query($conn, $sql);

        if ($res == TRUE) {
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                if ($new_password == $confirm_password) {
                    $sql2 = "UPDATE tbl_admin SET
                             password = '$new_password'
                             WHERE id = $id
                             ";
                    $res2 = mysqli_query($conn, $sql2);

                    if ($res2 == TRUE) {
                        $_SESSION['change_pwd'] = '<div class="success text-center">Slaptažodis pakeistas</div>';
                        header("location:".SITE_URL.'admin/manage_admin.php');
                    }
                    else {
                        $_SESSION['change_pwd'] = '<div class="error text-center">Ivyko klaida</div>';
                        header("location:".SITE_URL.'admin/manage_admin.php');
                    }
                }
                else {
                    $_SESSION['pwd_not_match'] = '<div class="error text-center">Slaptažodžiai nesutampa</div>';
                    header("location:".SITE_URL.'admin/update_password.php?id='.$id.'');
                }
            }
            else {
                $_SESSION['user_not_found'] = '<div class="error text-center">Neteisingas senas slaptazodis</div>';
                header("location:".SITE_URL.'admin/update_password.php?id='.$id.'');
            }
        }
    }
?>

<?php include('partials/footer.php') ?>
