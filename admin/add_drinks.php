<?php include('partials/nav.php');

if (isset($_SESSION['add'])) {
    echo $_SESSION['add'];
    unset($_SESSION['add']);
}

?>

<div class="main-content">
    <div class="wrapper">
        <h1></h1>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Pavadinimas: </td>
                    <td>
                        <input type="text" name="title" placeholder="Pavadinimas">
                    </td>
                </tr>
                <tr>
                    <td>Aprašymas: </td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="5" placeholder="Aprašymas"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Kaina: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Įkelkite nuotrauką: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Gėrimo kategorija: </td>
                    <td>
                        <select name="category" id="">

                            <?php
                                $sql = "SELECT * FROM tbl_category WHERE active = 'Taip'";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);
                                echo $count;
                                if ($count > 0) {
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                        <option value="<?php echo $id ?>"><?php echo $title ?></option>
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
                        <input type="radio" name="featured" value="Taip"> Taip
                        <input type="radio" name="featured" value="Ne"> Ne
                    </td>
                </tr>
                <tr>
                    <td>Pridėti prie aktyviu? </td>
                    <td>
                        <input type="radio" name="active" value="Taip"> Taip
                        <input type="radio" name="active" value="Ne"> Ne
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];

        if (isset($_POST['featured'])) {
            $featured = $_POST['featured'];
        }
        else {
            $featured = "Ne";
        }

        if (isset($_POST['active'])) {
            $active = $_POST['active'];
        }
        else {
            $active = "Ne";
        }
        if (isset($_FILES['image']['name'])) {
            $image_name = $_FILES['image']['name'];

            if ($image_name != "") {
                $ext = end(explode('.', $image_name)); //isgaunu .jpg
                $image_name = "Drinks_".rand(000, 999).'.'.$ext; // pakeiciu pavadinima

                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/drinks/".$image_name;
                $upload = move_uploaded_file($source_path, $destination_path);

                if ($upload == FALSE) {
                    $_SESSION['upload'] = "<div class='error text-center'>Ivyko klaida</div>";
                    header('location:'.SITE_URL.'admin/add_drinks.php');
                    die();
                }
            }
        }
        else {
            $image_name = "";
        }
        $sql2 = "INSERT INTO tbl_drinks SET 
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = $category,
                        featured = '$featured',
                        active = '$active'
                ";

        $res2 = mysqli_query($conn, $sql2);

        if ($res2 == TRUE) {
            $_SESSION['add'] = "<div class='success text-center'>Gėrimas sėkmingai sukurtas!</div>";
            header('location:'.SITE_URL.'admin/manage_drinks.php');
        }
        else {
            $_SESSION['add'] = "<div class='error text-center'>Ivyko klaida</div>";
            header('location:'.SITE_URL.'admin/add_drinks.php');
        }
    }
?>

<?php include('partials/footer.php'); ?>
