<?php include('partials/nav.php'); ?>

<?php

if (isset($_SESSION['add'])) {
    echo $_SESSION['add'];
    unset($_SESSION['add']);
}
if (isset($_SESSION['upload'])) {
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
}

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Sukurti kategorija</h1>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Pavadinimas: </td>
                    <td>
                        <input type="text" name="title" placeholder="Įveskite pavadinimą">
                    </td>
                </tr>
                <tr>
                    <td>Įkelkite nuotrauką: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Iškelti į pagrindinį puslapį:</td>
                    <td>
                        <input type="radio" name="featured" value="Taip"> Taip
                        <input type="radio" name="featured" value="Ne"> Ne
                    </td>
                </tr>
                <tr>
                    <td>Ar aktyvus</td>
                    <td>
                        <input type="radio" name="active" value="Taip"> Taip
                        <input type="radio" name="active" value="Ne"> Ne
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Sukurti" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php

            if (isset($_POST['submit'])) {
                $title = $_POST['title'];

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
                        $image_name = "Drinks_category_".rand(000, 999).'.'.$ext; // pakeiciu pavadinima

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/".$image_name;
                        $upload = move_uploaded_file($source_path, $destination_path);

                        if ($upload == FALSE) {
                            $_SESSION['upload'] = "<div class='error text-center'>Ivyko klaida</div>";
                            header('location:'.SITE_URL.'admin/add_category.php');
                            die();
                        }
                    }
                }
                else {
                    $image_name = "bla";
                }

                $sql = "INSERT INTO tbl_category SET 
                        title = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'
                ";

                $res = mysqli_query($conn, $sql);

                if ($res == TRUE) {
                    $_SESSION['add'] = "<div class='success text-center'>Kategorija sėkmingai sukurta!</div>";
                    header('location:'.SITE_URL.'admin/manage_category.php');
                }
                else {
                    $_SESSION['add'] = "<div class='error text-center'>Ivyko klaida</div>";
                    header('location:'.SITE_URL.'admin/add_category.php');
                }
            }


        ?>

    </div>
</div>


<?php include('partials/footer.php'); ?>
