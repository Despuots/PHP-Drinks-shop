<?php include('partials/nav.php') ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Redaguoti gėrimą</h1>
            <br><br>

            <?php

            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM  tbl_drinks WHERE id = $id";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if ($count == 1) {
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $current_image = $row['image_name'];
                    $current_category = $row['category_id'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else {
                    $_SESSION['no_drinks_found'] = "<div class='error text-center'>Gėrimas nerastas</div>";
                    header('location:'.SITE_URL.'admin/manage_drinks');
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
                        <td>Aprašymas: </td>
                        <td>
                            <textarea name="description" id="" cols="30" rows="5"><?php echo $description; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Kaina: </td>
                        <td>
                            <input type="number" name="price" value="<?php echo $price; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Sena nuotrauka: </td>
                        <td>
                            <?php
                            if ($current_image != "") {
                                ?>
                                <img src="<?php echo SITE_URL; ?>images/drinks/<?php echo $current_image; ?>" alt="" width="100px">
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
                        <td>Kategorija: </td>
                        <td>
                            <select name="category" id="">
                                <?php
                                    $sql3 = "SELECT * FROM tbl_category WHERE active = 'Taip'";
                                    $res3 = mysqli_query($conn, $sql3);
                                    $count = mysqli_num_rows($res3);

                                    if ($count > 0) {
                                        while ($row = mysqli_fetch_assoc($res3)) {
                                            $category_id = $row['id'];
                                            $category_title = $row['title'];
                                            ?>
                                            <option <?php if ($current_category == $category_id) {echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                            <?php
                                            }
                                    }
                                    else {
                                        ?>
                                        <option value="0">Kategorijų nėra</option>
                                        <?php
                                    }
                                ?>
                            </select>
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
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $current_image = $_POST['current_image'];
    $category = $_POST['category'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        if ($image_name != "") {
            $ext = end(explode('.', $image_name)); //isgaunu .jpg
            $image_name = "Drinks_".rand(000, 999).'.'.$ext; // pakeiciu pavadinima

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/drinks/".$image_name;
            $upload = move_uploaded_file($source_path, $destination_path);

            if ($upload == FALSE) {
                $_SESSION['image_replace'] = "<div class='error text-center'>Ivyko klaida</div>";
                header('location:'.SITE_URL.'admin/manage_drinks.php');
                die();
            }
            if ($current_image != "") {
                $remove_path = "../images/drinks/".$current_image;
                $remove = unlink($remove_path);
                if ($remove == FALSE) {
                    $_SESSION['failed_remove'] = "<div class='error text-center'>Nepavyko ištrinti nuotraukos</div>";
                    header('location:'.SITE_URL.'admin/manage_drinks.php');
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

    $sql2 = "UPDATE tbl_drinks SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'
                WHERE id = $id
        ";

    $res2 = mysqli_query($conn, $sql2);

    if ($res2 == TRUE) {
        $_SESSION['update_drinks'] = "<div class='success text-center'>Gėrimas redaguotas</div>";
        header('location:'.SITE_URL.'admin/manage_drinks.php');
    }
    else {
        $_SESSION['update_drinks'] = "<div class='error text-center'>Ivyko klaida</div>";
        header('location:'.SITE_URL.'admin/manage_drinks.php');
    }

}

?>

<?php include('partials/footer.php') ?>