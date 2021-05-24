<?php include('partials_front/nav.php')?>

<?php

    if (isset($_GET['drinks_id'])) {
        $drinks_id = $_GET['drinks_id'];
        $sql = "SELECT * FROM tbl_drinks WHERE id = $drinks_id";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);

            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
        }
        else {
            header('location'.SITE_URL);
        }
    }
    else {
        header('location:'.SITE_URL);
    }

?>

<section class="drinks_search text_center">
    <div class="container_order">

        <form action="" method="POST">
            <h2>Užpildykite formą norėdami užsisakyti</h2>
            <fieldset class="flex border_radius_10">
                    <legend>Pasirinktas gėrimas</legend>
                    <div class="padding_3">
                        <img src="<?php echo SITE_URL; ?>images/drinks/<?php echo $image_name ?>" alt="">
                    </div>
                    <div class="drinks_menu_desc_order text_center">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="drinks" value="<?php echo $title; ?>">

                        <p class="drinks_price"><?php echo $price?>€</p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div>Kiekis</div>
                        <input class="order_inputs" type="number" name="qty" value="1" required>
                    </div>
            </fieldset>

            <fieldset class="border_radius_10 allign_items_center">
                <legend>Duomenys pristatymui</legend>
                <div class="margin_top_5">Vardas</div>
                <input class="order_inputs" type="text" name="full_name" placeholder="Įveskite vardą" required>

                <div>Telefono numeris</div>
                <input class="order_inputs" type="tel" name="contact" placeholder="+3706*******" required>

                <div>El. paštas</div>
                <input class="order_inputs" type="email" name="email" placeholder="labas@paštas.com" required>

                <div>Adresas</div>
                <textarea class="order_inputs" name="address" rows="10" placeholder="Gatvė, Miestas" required></textarea>

                <input type="submit" name="submit" value="Patvirtinti užsakymą" class="order_inputs btn_primary">
            </fieldset>
        </form>

        <?php

            if (isset($_POST['submit'])) {
                $drinks = $_POST['drinks'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];

                $total = $price * $qty;
                $order_date = date("Y-m-d h:i:sa");
                $status = "Užsakytas";
                $customer_name = $_POST['full_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];

                $sql2 = "INSERT INTO tbl_order SET
                        drinks = '$drinks',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                        ";

                $res2 = mysqli_query($conn, $sql2);

                if ($res2 == TRUE) {
                    $_SESSION['order'] = "<div class='success text_center'>Gėrimas užsakytas sėkmingai!</div>";
                    header('location:'.SITE_URL);
                }
                else {
                    $_SESSION['order'] = "<div class='error'>Ivyko klaida</div>";
                    header('location:'.SITE_URL);
                }
            }

        ?>

    </div>
</section>

<?php include('partials_front/footer.php')?>
