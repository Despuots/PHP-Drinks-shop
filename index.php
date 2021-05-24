<?php include('partials_front/nav.php')?>

<?php

if (isset($_SESSION['order'])) {
    echo $_SESSION['order'];
    unset($_SESSION['order']);
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
<section class="categories">
    <div class="container">
        <h2 class="text_center">Kategorijos</h2>
        <div class="flex">
        <?php
            $sql = "SELECT * FROM tbl_category WHERE active = 'Taip' AND featured = 'Taip' LIMIT 3";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if ($count > 0 ) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>

                        <div class="box-3 text_center">
                            <a href="<?php echo SITE_URL; ?>category_drinks.php?category_id=<?php echo $id; ?>"><img class="img_responsive border_radius_20" src="<?php echo SITE_URL; ?>images/category/<?php echo $image_name; ?>" alt="">
                            </a>
                            <h3 class="text_center"><?php echo $title ?></h3>
                        </div>

                    <?php
                }
            }
            else {
                echo "<div>Kategorijų nėra</div>";
            }
        ?>
        </div>
        <div class="text_center margin_top_5">
            <a class="btn_primary btn color_white" href="<?php echo SITE_URL; ?>categories.php">Visos kategorijos</a>
        </div>
    </div>
</section>
<section class="drinks_menu">
    <div class="container">
        <h2 class="text_center">Gėrimai</h2>
        <div class="flex flex_wrap">
        <?php
        $sql2 = "SELECT * FROM tbl_drinks WHERE active = 'Taip' AND featured = 'Taip' LIMIT 6";
        $res2 = mysqli_query($conn, $sql2);
        $count2 = mysqli_num_rows($res2);

        if ($count2 > 0 ) {
            while ($row2 = mysqli_fetch_assoc($res2)) {
                $id = $row2['id'];
                $title = $row2['title'];
                $price = $row2['price'];
                $description = $row2['description'];
                $image_name = $row2['image_name'];
                ?>


                    <div class="drinks_menu_box flex ">
                        <div class="drinks_menu_img">
                            <img src="<?php echo SITE_URL; ?>images/drinks/<?php echo $image_name; ?>" alt="" class="img_drinks border_radius_10">
                        </div>
                        <div class="drinks_menu_desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="drinks_price"><?php echo $price; ?>€</p>
                            <p class="drinks_detail"><?php echo $description; ?></p>
                            <br>
                            <a class="btn btn_primary color_white" href="<?php echo SITE_URL; ?>order.php?drinks_id=<?php echo $id; ?>">Užsisakyti</a>
                        </div>
                    </div>


                <?php
            }
        }
        else {

        }
        ?>

        </div>
        <div class="text_center margin_top_5 margin_bottom_5">
            <a class="btn_primary btn color_white" href="<?php echo SITE_URL; ?>drinks.php">Visi gėrimai</a>
        </div>
    </div>
</section>



<?php include('partials_front/footer.php')?>
