<?php include('partials/nav.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Redaguoti administratorių</h1>
        <br><br>

        <?php

            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_admin WHERE id =$id";
            $res = mysqli_query($conn, $sql);

            if($res == TRUE) {
                $count = mysqli_num_rows($res);

                if($count == 1) {
                    $row = mysqli_fetch_assoc($res);
                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else {
                    header('location:'.SITE_URL.'admin/manage_admin.php');
                }
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Įveskite vardą: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Įveskite Slapyvardį: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Redaguoti" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php

if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    $sql = "UPDATE tbl_admin SET
                full_name = '$full_name',
                username = '$username'
                WHERE id = '$id'
        ";

    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        $_SESSION['update'] = "<div class='success text-center'>Administratoriaus duomenys sėkmingai pakeisti</div>";
        header("location:".SITE_URL.'admin/manage_admin.php');
    }
    else {
        $_SESSION['update'] = "<div class='error text-center'>Ivyko klaida</div>";
        header("location:".SITE_URL.'admin/manage_admin.php');
    }

}
?>

