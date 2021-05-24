<?php include('partials_front/nav.php'); ?>

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
        <h2 class="text_center">Gėrimai</h2>
        <div class="flex flex_wrap">
            <?php
            $sql2 = "SELECT * FROM tbl_drinks WHERE active = 'Taip'";
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
    </div>
</section>

<?php include('partials_front/footer.php'); ?>
