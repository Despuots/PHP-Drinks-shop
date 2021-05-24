<?php include('partials/nav.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Redaguoti užsakymą</h1>
        <br><br>

        <?php

        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_order WHERE id =$id";
        $res = mysqli_query($conn, $sql);

        if ($res == TRUE) {
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);

                $drinks = $row['drinks'];
                $price = $row['price'];
                $qty = $row['qty'];
                $total = $row['total'];
                $order_date = $row['order_date'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];
            } else {
                header('location:' . SITE_URL . 'admin/manage_order.php');
            }
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Gėrimo pavadinimas:</td>
                    <td><?php echo $drinks ?></td>
                </tr>
                <tr>
                    <td>Kaina:</td>
                    <td><?php echo $price ?>€</td>
                </tr>
                <tr>
                    <td>Kiekis:</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Statusas:</td>
                    <td>
                        <select name="status" id="">
                            <option <?php if ($status == "Užsakytas") {
                                echo "selected";
                            } ?> value="Užsakytas">Užsakytas
                            </option>
                            <option <?php if ($status == "Pristatomas") {
                                echo "selected";
                            } ?> value="Pristatomas">Pristatomas
                            </option>
                            <option <?php if ($status == "Pristatytas") {
                                echo "selected";
                            } ?> value="Pristatytas">Pristatytas
                            </option>
                            <option <?php if ($status == "Atšauktas") {
                                echo "selected";
                            } ?> value="Atšauktas">Atšauktas
                            </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Pirkėjo vardas:</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name ?>">
                    </td>
                </tr>
                <tr>
                    <td>Pirkėjo telefono numeris:</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact ?>">
                    </td>
                </tr>
                <tr>
                    <td>Pirkėjo el. paštas:</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email ?>">
                    </td>
                </tr>
                <tr>
                    <td>Pirkėjo adresas:</td>
                    <td>
                        <textarea name="customer_address" id="" cols="30"
                                  rows="10"><?php echo $customer_address ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Redaguoti" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];

    $total = $price * $qty;

    $status = $_POST['status'];
    $customer_name = $_POST['customer_name'];
    $customer_contact = $_POST['customer_contact'];
    $customer_email = $_POST['customer_email'];
    $customer_address = $_POST['customer_address'];

    $sql2 = "UPDATE tbl_order SET
                        qty = $qty,
                        total = $total,
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address',
                        WHERE id = $id
                        ";
    $res2 = mysqli_query($conn, $sql2);

    if ($res2 == TRUE) {
        $_SESSION['update'] = "<div class='success text-center'>Užsakymas redaguotas</div>";
        header("location:" . SITE_URL . 'admin/manage_order.php');
    } else {
        $_SESSION['update'] = "<div class='error text-center'>Ivyko klaida</div>";
        header("location:" . SITE_URL . 'admin/manage_order.php');
    }

}
?>
