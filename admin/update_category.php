<?php include('partials/nav.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Rdaguoti kategoriją</h1>
        <br><br>

        <?php

            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM  tbl_category WHERE id = $id";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if ($count == 1) {
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else {
                    $_SESSION['no_category_found'] = "<div class='error text-center'>Kategorija nerasta</div>";
                    header('location:'.SITE_URL.'admin/manage_category');
                }
            }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Pavadinimas: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Sena nuotrauka: </td>
                    <td>
                        <?php
                            if ($current_image != "") {
                                ?>
                                <img src="<?php echo SITE_URL; ?>images/category/<?php echo $current_image; ?>" alt="" width="100px">
                                <?php
                            }
                            else {
                                echo "<div class='error'>Nuotrauka nepridėta</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Nauja nuotrauka: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Iškelti į pagrindinį puslapį: </td>
                    <td>
                        <input <?php if($featured == "Taip") {echo "checked";} ?> type="radio" name="featured" value="Taip"> Taip
                        <input <?php if($featured == "Ne") {echo "checked";} ?> type="radio" name="featured" value="Ne"> Ne
                    </td>
                </tr>
                <tr>
                    <td>Ar aktyvus: </td>
                    <td>
                        <input <?php if($active == "Taip") {echo "checked";} ?> type="radio" name="active" value="Taip"> Taip
                        <input <?php if($active == "Ne") {echo "checked";} ?> type="radio" name="active" value="Ne"> Ne
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Redaguoti" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php

    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $id = $_POST['id'];
        $current_image = $_POST['current_image'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        if (isset($_FILES['image']['name'])) {
            $image_name = $_FILES['image']['name'];
            if ($image_name != "") {
                $ext = end(explode('.', $image_name)); //isgaunu .jpg
                $image_name = "Drinks_category_".rand(000, 999).'.'.$ext; // pakeiciu pavadinima

                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/category/".$image_name;
                $upload = move_uploaded_file($source_path, $destination_path);

                if ($upload == FALSE) {
                    $_SESSION['image_replace'] = "<div class='error text-center'>Ivyko klaida</div>";
                    header('location:'.SITE_URL.'admin/manage_category.php');
                    die();
                }
                if ($current_image != "") {
                    $remove_path = "../images/category/".$current_image;
                    $remove = unlink($remove_path);
                    if ($remove == FALSE) {
                        $_SESSION['failed_remove'] = "<div class='error text-center'>Nepavyko ištrinti nuotraukos</div>";
                        header('location:'.SITE_URL.'admin/manage_category.php');
                        die();
                    }
                }
            }
            else {
                $image_name = $current_image;
            }
        }
        else {
            $image_name = $current_image;
        }

        $sql2 = "UPDATE tbl_category SET
                title = '$title',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active'
                WHERE id = $id
        ";

        $res2 = mysqli_query($conn, $sql2);

        if ($res2 == TRUE) {
            $_SESSION['update_category'] = "<div class='success text-center'>Kategorija redaguota</div>";
            header('location:'.SITE_URL.'admin/manage_category.php');
        }
        else {
            $_SESSION['update_category'] = "<div class='error text-center'>Ivyko klaida</div>";
            header('location:'.SITE_URL.'admin/manage_category.php');
        }

    }

?>

<?php include('partials/footer.php') ?>
