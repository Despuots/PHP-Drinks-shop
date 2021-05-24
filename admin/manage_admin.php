<?php include('partials/nav.php'); ?>
<?php
if (isset($_SESSION['add'])) {
    echo $_SESSION['add'];
    unset($_SESSION['add']);
}
if (isset($_SESSION['delete'])) {
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}
if (isset($_SESSION['update'])) {
    echo $_SESSION['update'];
    unset($_SESSION['update']);
}


if (isset($_SESSION['change_pwd'])) {
    echo $_SESSION['change_pwd'];
    unset($_SESSION['change_pwd']);
}
?>
    <div class="main-content">

        <div class="wrapper">

            <h1>Administratoriai</h1>
            <br>
            <br><br><br>
            <a href="add_admin.php" class="btn-primary">Užregistruoti administratorių</a>
            <br><br><br>
            <table class="tbl-full">
                <tr>
                    <th>Nr.</th>
                    <th>Vardas</th>
                    <th>Slapyvardis</th>
                    <th>Galimi veiksmai</th>
                </tr>

                <?php
                $sql = "SELECT * FROM tbl_admin";
                $res = mysqli_query($conn, $sql);

                if ($res == TRUE) {
                    $count = mysqli_num_rows($res);
                    $fake_id = 0;
                    if ($count > 0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            $id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $username = $rows['username'];
                            $fake_id++
                            ?>

                            <tr>
                                <td><?php echo $fake_id; ?>.</td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $username; ?></td>
                                <td>
                                    <a href="<?php echo SITE_URL; ?>admin/update_password.php?id=<?php echo $id; ?>"
                                       class="btn-primary">Pakeisti slaptažodį</a>
                                    <a href="<?php echo SITE_URL; ?>admin/update_admin.php?id=<?php echo $id; ?>"
                                       class="btn-secondary">Redaguoti duomenis</a>
                                    <a href="<?php echo SITE_URL; ?>admin/delete_admin.php?id=<?php echo $id; ?>"
                                       class="btn-danger">Ištrinti</a>
                                </td>
                            </tr>

                            <?php
                        }
                    } else {
                        echo 'Adminstratorių nėra';
                    }
                }
                ?>
            </table>
        </div>
    </div>

<?php include('partials/footer.php'); ?>