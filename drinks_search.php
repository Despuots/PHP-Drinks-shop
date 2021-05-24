<?php include('partials_front/nav.php'); ?>

<section class="drinks_search text_center">
    <div class="container">

        <?php
        $search = $_POST['search'];
        ?>

    </div>
</section>

<section class="drinks_menu">
    <div class="container">
        <h2 class="text_center">Gėrimai pagal jūsų paiešką: "<?php echo $search; ?>"</h2>
        <div class="flex flex_wrap">

            <?php

            $sql = "SELECT * FROM tbl_drinks WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
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
                echo "<div class='error'>Gėrimas nerastas</div>";
            }

            ?>
        </div>

</section>

<?php include('partials_front/footer.php') ?>
