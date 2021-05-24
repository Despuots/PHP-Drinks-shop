<?php include('partials_front/nav.php')?>

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
        <div class="flex flex_wrap">

        <?php
        $sql = "SELECT * FROM tbl_category WHERE active = 'Taip'";
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

        }
        ?>
        </div>
    </div>
</section>

<?php include('partials_front/footer.php')?>
