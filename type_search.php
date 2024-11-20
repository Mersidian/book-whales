<?php
session_start();

require("dbconnect.php");

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/bootstrap-5.3.0-alpha3-dist/css/bootstrap.css" rel="stylesheet">
    <link href="assets/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="assets/fontawesome/css/brands.css" rel="stylesheet">
    <link href="assets/fontawesome/css/solid.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <title>หนังสือ</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-white mx-3 mt-3">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold fs-3 mb-2" href="#">Book Whales</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto ms-auto mb-2 mb-lg-0">
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="index.php">
                            <h5 class="fw-semibold">หน้าหลัก</h5>
                        </a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="books.php">
                            <h5 class="fw-semibold">หนังสือ</h5>
                        </a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="store.php">
                            <h5 class="fw-semibold">ร้านหนังสือ</h5>
                        </a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="promotion.php">
                            <h5 class="fw-semibold">ข่าวสารและโปรโมชั่น</h5>
                        </a>
                    </li>
                    <li class="nav-item mx-3 d-lg-none d-xl-none">
                        <a class="nav-link" href="#">
                            <h5 class="fw-semibold">ล็อคอิน</h5>
                        </a>
                    </li>
                    <li class="nav-item mx-3 d-lg-none d-xl-none">
                        <a class="nav-link" href="register.php">
                            <h5 class="fw-semibold">สมัครสมาชิก</h5>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav d-none d-lg-flex d-xl-flex">
                    <li class="nav-item mx-1">
                        <a class="nav-link" href="loginform.php">
                            <h5 class="fw-semibold">ลงชื่อเข้าใช้ระบบ</h5>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link border rounded bg-warning px-3 ms-2 text-white" href="register.php">
                            <h5 class="fw-semibold">สมัครสมาชิก</h5>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php
    $searchrs = $_GET["type"];

    $sql = "SELECT * FROM books WHERE type_id = '$searchrs' ORDER BY book_name ASC";
    $result = mysqli_query($connect, $sql);
    $count = mysqli_num_rows($result);
    $order = 1;
    ?>

    <section>

        <form method="GET" action="search.php" class="d-flex justify-content-center">
            <button class="btn btn-secondary dropdown-toggle mx-2" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                หมวดหนังสือ
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="type_search.php?type=1">นิยาย/วรรณกรรม</a></li>
                <li><a class="dropdown-item" href="type_search.php?type=2">บริหาร</a></li>
                <li><a class="dropdown-item" href="type_search.php?type=3">การศึกษา</a></li>
                <li><a class="dropdown-item" href="type_search.php?type=4">จิตวิทยาและการพัฒนาตัวเอง</a></li>
                <li><a class="dropdown-item" href="type_search.php?type=5">หนังสือเด็กและการ์ตูนความรู้</a></li>
                <li><a class="dropdown-item" href="type_search.php?type=6">การ์ตูนและไลท์โนเวล</a></li>
                <li><a class="dropdown-item" href="type_search.php?type=7">วิทยาการและเทคโนโลยี</a></li>
                <li><a class="dropdown-item" href="type_search.php?type=8">ความรู้ทั่วไป</a></li>
                <li><a class="dropdown-item" href="type_search.php?type=9">ประวัติศาสตร์ ศาสนา วัฒนธรรม การเมือง
                        การปกครอง</a></li>
                <li><a class="dropdown-item" href="type_search.php?type=10">อัตชีวประวัติ ชีวประวัติ</a></li>
                <li><a class="dropdown-item" href="type_search.php?type=11">อาหารและสุขภาพ</a></li>
                <li><a class="dropdown-item" href="type_search.php?type=12">บันเทิงและท่องเที่ยว</a></li>
                <li><a class="dropdown-item" href="type_search.php?type=13">การเกษตรและธรรมชาติ</a></li>
                <li><a class="dropdown-item" href="type_search.php?type=14">ครอบครัว</a></li>
                <li><a class="dropdown-item" href="type_search.php?type=15">บ้านและที่อยู่อาศัย</a></li>
            </ul>
            <input type="text" name="query" class="form-control w-50 d-inline"
                placeholder="ค้นหาข้อมูลตามชื่อหนังสือ...">
            <button type="submit" class='btn btn-primary ms-2'><i class='fa-solid fa-magnifying-glass'></i></button>
        </form>

        <div class="container-fluid py-5">
            <div class="row">
                <?php
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-12 col-lg-2 mb-4 mb-lg-2">

                        <div class="card">
                            <a href="books_detail.php?book=<?php echo $row["book_id"]; ?>">
                                <div class="text-center">
                                    <img src="  <?php echo '../bookwhales' . $row["book_img"] ?>"
                                        style="width:150px; height:220;" width="150" height="220"
                                        class="card-img-top mt-1" />
                                </div>
                            </a>
                            <div class="card-body">

                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0 fs-6">
                                        <?php echo $row["book_name"]; ?>
                                    </h5>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <h5 class="mb-0 fw-bold fs-6 text-danger"><span>
                                            <?php echo number_format($row["book_price"], 2) . " "; ?>บาท
                                        </span></h5>
                                    <a href="loginform.php" class="btn btn-primary position-absolute"
                                        style="right: 6%; bottom: 9%;"><i class="fa-solid fa-cart-shopping"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

    </section>

    <script src="assets/bootstrap-5.3.0-alpha3-dist/js/bootstrap.bundle.js"></script>

</body>

</html>