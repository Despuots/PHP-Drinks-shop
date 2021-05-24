<?php include('partials_front/nav.php') ?>

<?php

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $sql = "SELECT title FROM tbl_category WHERE id = $category_id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $category_title = $row['title'];
} else {
    header('location:' . SITE_URL);
}

?>
<section class="drinks_search text_center">
    <div class="container">
        <form action="<?php echo SITE_URL; ?>drinks_search.php" method="POST">
            <input type="search" placeholder="Paieška" name="search" required>
            <input type="submit" value="Ieškoti" class="btn btn_primary">
        </form>
    </div>
</section>
<section class="drinks_menu">
    <div class="container">
        <h2 class="text_center">Gėrimai kategorijoje: "<?php echo $category_title ?>"</h2>
        <div class="flex flex_wrap">
            <?php
            $sql2 = "SELECT * FROM tbl_drinks WHERE active = 'Taip' AND category_id = $category_id";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);

            if ($count2 > 0) {
                while ($row2 = mysqli_fetch_assoc($res2)) {
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];
                    ?>


                    <div class="drinks_menu_box flex ">
                        <div class="drinks_menu_img">
                            <img src="<?php echo SITE_URL; ?>images/drinks/<?php echo $image_name; ?>" alt=""
                                 class="img_drinks border_radius_10">
                        </div>
                        <div class="drinks_menu_desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="drinks_price"><?php echo $price; ?>€</p>
                            <p class="drinks_detail"><?php echo $description; ?></p>
                            <br>
                            <a class="btn btn_primary color_white" href="">Užsisakyti</a>
                        </div>
                    </div>


                    <?php
                }
            } else {

            }
            ?>

        </div>
    </div>
</section>
<?php include('partials_front/footer.php') ?>
