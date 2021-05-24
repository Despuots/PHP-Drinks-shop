<?php include('partials/nav.php'); ?>

<?php

if (isset($_SESSION['upload'])) {
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
}
if (isset($_SESSION['add'])) {
    echo $_SESSION['add'];
    unset($_SESSION['add']);
}
if (isset($_SESSION['delete_drinks'])) {
    echo $_SESSION['delete_drinks'];
    unset($_SESSION['delete_drinks']);
}
if (isset($_SESSION['image_replace'])) {
    echo $_SESSION['image_replace'];
    unset($_SESSION['image_replace']);
}
if (isset($_SESSION['update_drinks'])) {
    echo $_SESSION['update_drinks'];
    unset($_SESSION['update_drinks']);
}
if (isset($_SESSION['failed_remove'])) {
    echo $_SESSION['failed_remove'];
    unset($_SESSION['failed_remove']);
}

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Gėrimai</h1>
        <br>
        <br><br><br>
        <a href="add_drinks.php" class="btn-primary">Sukurti gėrimą</a>
        <br><br><br>
        <table class="tbl-full">
            <tr>
                <th>Nr.</th>
                <th>Pavadinimas</th>
                <th>Kaina</th>
                <th>Nuotrauka</th>
                <th>Iškeltas į pagrindinį puslapį</th>
                <th>Aktyvus</th>
                <th>Galimi veiksmai</th>
            </tr>
            <?php
            $sql = "SELECT * FROM tbl_drinks";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $sn = 1;

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td><?php echo $price; ?>€</td>
                        <td>
                            <?php

                            if ($image_name != "") {
                                ?>
                                <img src="<?php echo SITE_URL; ?>images/drinks/<?php echo $image_name; ?>" alt=""
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
                            <a href="<?php echo SITE_URL; ?>admin/update_drinks.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"
                               class="btn-secondary">Redaguoti duomenis</a>
                            <a href="<?php echo SITE_URL; ?>admin/delete_drinks.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"
                               class="btn-danger">Ištrinti</a>
                        </td>
                    </tr>

                    <?php
                }
            } else {
                echo "<tr> <td colspan='7' class='error'>Gėrimų nėra</td> </tr>";
            }

            ?>

        </table>
    </div>
</div>

<?php include('partials/footer.php') ?>
