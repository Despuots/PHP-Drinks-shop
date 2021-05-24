<?php include('partials/nav.php') ?>

<?php

if (isset($_SESSION['add'])) {
    echo $_SESSION['add'];
    unset($_SESSION['add']);
}
if (isset($_SESSION['delete_category'])) {
    echo $_SESSION['delete_category'];
    unset($_SESSION['delete_category']);
}
if (isset($_SESSION['no_category_found'])) {
    echo $_SESSION['no_category_found'];
    unset($_SESSION['no_category_found']);
}
if (isset($_SESSION['update_category'])) {
    echo $_SESSION['update_category'];
    unset($_SESSION['update_category']);
}
if (isset($_SESSION['image_replace'])) {
    echo $_SESSION['image_replace'];
    unset($_SESSION['image_replace']);
}
if (isset($_SESSION['failed_remove'])) {
    echo $_SESSION['failed_remove'];
    unset($_SESSION['failed_remove']);
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Kategorijos</h1>
        <br>


        <br><br><br>
        <a href="<?php echo SITE_URL; ?>admin/add_category.php" class="btn-primary">Sukurti kategoriją</a>
        <br><br>
        <table class="tbl-full">
            <tr>
                <th>Nr.</th>
                <th>Pavadinimas</th>
                <th>Nuotrauka</th>
                <th>Iškeltas į pagrindinį puslapį</th>
                <th>Ar aktyvus</th>
                <th>Galimi veiksmai</th>
            </tr>

            <?php

            $sql = "SELECT * FROM tbl_category";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            $sn = 1;

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                    ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>

                        <td>
                            <?php

                            if ($image_name != "") {
                                ?>
                                <img src="<?php echo SITE_URL; ?>images/category/<?php echo $image_name; ?>" alt=""
                                     width="100px">
                                <?php
                            } else {
                                echo "<div class='error'>Nuotrauka nepridėta</div>";
                            }

                            ?>
                        </td>

                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITE_URL; ?>admin/update_category.php?id=<?php echo $id; ?>"
                               class="btn-secondary">Redaguoti kategoriją</a>
                            <a href="<?php echo SITE_URL; ?>admin/delete_category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name ?>"
                               class="btn-danger">Ištrinti</a>
                        </td>
                    </tr>
                    <?php

                }
            } else {
                ?>

                <tr>
                    <td>
                        <div class="error">Nėra kategorijų</div>
                    </td>
                </tr>

                <?php
            }

            ?>

        </table>
    </div>

</div>

<?php include('partials/footer.php') ?>
