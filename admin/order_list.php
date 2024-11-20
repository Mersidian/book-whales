<?php
require("nav_admin.php");
require '../dbconnect.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/bootstrap-5.3.0-alpha3-dist/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="../assets/fontawesome/css/brands.css" rel="stylesheet">
    <link href="../assets/fontawesome/css/solid.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <title>คำสั่งซื้อ</title>
</head>

<body>
        <?php
        $sql = "SELECT * FROM orders LEFT JOIN orders_detail ON orders.orders_id = orders_detail.orders_id";
        $result = mysqli_query($connect, $sql);

        if ($result->num_rows > 0) {
            echo "<div class='container-fluid d-flex justify-content-center table-responsive mt-3'>";
            echo "<table class='table table-bordered w-auto'>";
            echo "<thead class='text-center'>";
            echo "<tr>
                        <th scope='col'>ลำดับ</th>
                        <th scope='col'>เวลาสั่งซื้อ</th>
                        <th scope='col'>ชื่อผู้รับ</th>
                        <th scope='col'>ที่อยู่รับ</th>
                        <th scope='col'>เบอร์มือถือผู้รับ</th>
                        <th scope='col'>ราคารวม</th>
                        <th scope='col'>สถานะ</th>
                      </tr>";
            echo "</thead>";
            echo "<tbody>";

            $order = 1;

            while ($row = $result->fetch_assoc()) {
                echo "<tr >";
                echo "<th scope='row' class='text-center' style='width: 100px;'>" . $order++ . "</th>";
                echo "<td class='text-center'>" . $row["orders_created"] . "</td>";
                echo "<td>" . $row["orders_fullname"] . "</td>";
                echo "<td>" . $row["orders_address"] . "</td>";
                echo "<td class='text-center'>" . $row["orders_phone"] . "</td>";
                echo "<td class='text-center'>" . $row["detail_total"] . "</td>";
                if ($row["detail_status"] == 0) {
                    echo "<td class='text-center bg bg-warning'>รอการชำระ</td>";
                } else if ($row["detail_status"] == 1) {
                    echo "<td class='text-center bg bg-primary text-white'>กำลังจัดส่ง</td>";
                } else if ($row["detail_status"] == 2) {
                    echo "<td class='text-center bg bg-danger text-white'>คำสั่งซื้อถูกยกเลิก</td>";
                } else if ($row["detail_status"] == 3) {
                    echo "<td class='text-center bg bg-success text-white'>เสร็จสิ้น</td>";
                }
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        } else {
            echo "<div class='alert alert-danger mx-3' role='alert'>ไม่พบคำสั่งซื้อ</div>";
        }

        ?>

        <script src="../assets/bootstrap-5.3.0-alpha3-dist/js/bootstrap.bundle.js"></script>
</body>

</html>