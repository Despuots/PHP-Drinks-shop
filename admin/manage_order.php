<?php include('partials/nav.php') ?>
<?php

if (isset($_SESSION['update'])) {
    echo $_SESSION['update'];
    unset($_SESSION['update']);
}

?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Užsakymai</h1>
            <br><br>
            <table class="tbl-full">
                <tr>
                    <th>Nr.</th>
                    <th>Gėrimas</th>
                    <th>Kaina</th>
                    <th>Kiekis</th>
                    <th>Suma</th>
                    <th>Užsakymo data</th>
                    <th>Statusas</th>
                    <th>Pirkėjo vardas</th>
                    <th>Telefono numeris</th>
                    <th>El. paštas</th>
                    <th>Adresas</th>
                    <th>Galimi veiksmai</th>
                </tr>

                <?php

                $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                $sn = 1;

                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
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

                        ?>

                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $drinks; ?></td>
                            <td><?php echo $price; ?></td>
                            <td><?php echo $qty; ?></td>
                            <td><?php echo $total; ?></td>
                            <td><?php echo $order_date; ?></td>
                            <td><?php echo $status; ?></td>
                            <td><?php echo $customer_name; ?></td>
                            <td><?php echo $customer_contact; ?></td>
                            <td><?php echo $customer_email; ?></td>
                            <td><?php echo $customer_address; ?></td>
                            <td>
                                <a href="<?php echo SITE_URL; ?>admin/update_order.php?id=<?php echo $id; ?>"
                                   class="btn-secondary">Redaguoti duomenis</a>
                            </td>
                        </tr>

                        <?php
                    }
                } else {
                    echo "<tr><td colspan='2' class='error'>Užsakymu nėra.</td></tr>";
                }

                ?>

            </table>
        </div>

    </div>

<?php include('partials/footer.php') ?>