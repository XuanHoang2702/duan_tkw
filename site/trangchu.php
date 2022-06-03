<?php
require_once 'ketnoi.php';
$pageUnit = 9;
if (isset($_GET['trang'])) {
    $page = $_GET['trang'];
} else {
    $page = 1;
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Trang chủ</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--  CSS -->
    <link rel="stylesheet" href="trangchu.css">

    <style>
        * {
            padding: 0;
            margin: 0;
        }

        .main-content {
            margin-top: 20px;
            display: grid;
            grid-template-columns: 3fr 1fr;
            margin-bottom: 20px;

        }

        marquee {
            color: red;
            font-size: 20px;
            font-weight: bold;
        }

        .slice_product {
            width: 100%;
        }

        #carouselExampleCaptions {
            width: 100%;
        }

        .product {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .items {
            margin-top: 30px;
            width: 28%;
            grid-template-columns: 30px;
            border: 1px solid red;
            height: 290px;
            border-radius: 0px 0px 5px 5px;

        }

        .items p {
            padding-left: 10px;
        }

        .items span {
            padding-left: 10px;
            font-weight: bold;
            color: red;
            font-size: 22px;
        }

        .items img {
            width: 100%;
            height: 200px;
            margin-bottom: 10px;
        }

        .items img:hover {
            opacity: 0.5;
        }

        .btn_page {
            margin-bottom: 30px;
            margin-top: 20px;
            text-align: center;
        }

        .btn_page a {
            border: 1px solid blue;
            padding: 1px 2px;
        }

        form {
            width: 280px;
            height: auto;
            border: 1px solid black;
            margin-left: 30px;
            border-radius: 10px;
        }

        form label {
            display: block;
            padding-top: 15px;
            font-weight: bold;
            font-size: 15px;
        }

        form div {
            padding-left: 20px;
        }

        .tai_khoan {
            background-color: #ede8e8;
            height: 40px;
            border-radius: 10px 10px 0px 0px;
            padding-top: 5px;
        }

        form input {
            width: 230px;
        }

        .mind_user {
            border: 1px solid black;
            width: 230px;
            margin-left: 20px;
            margin-top: 20px;
            border-radius: 4px;
        }

        .mind_user label {
            display: inline;
        }

        .mind_user input {
            width: auto;
        }

        form button {
            margin-left: 20px;
            margin-top: 20px;
            margin-bottom: 10px;
            border: 1px solid blue;
            border-radius: 5px;
            padding: 1px 4px;
        }

        form button:hover {
            background-color: #a1aff0;
        }

        form li {
            font-size: 13px;
            margin-left: 30px;
        }

        .list-group {
            width: 280px;
            margin-left: 30px;
            margin-top: 40px;
            margin-bottom: 40px;
        }

        .search {
            border: 1px solid gray;
            text-align: center;
            padding: 12px 0px;
            background-color: gray;
        }

        .search input {
            width: 220px;
        }

        .search input::placeholder {
            font-size: 13px;
            padding-left: 10px;

        }

        .favorite {
            padding: 10px 10px;
        }

        .favorite img {
            width: 30px;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <?php require_once "webchung.php"; ?>
            <marquee behavior="" direction="">Chào mừng bạn đến với webside của chúng tôi
                , hi vọng bạn sẽ có những trải nghiệm tuyệt vời khi ghé thăm </marquee>
        </div>
        <div class="main-content">
            <!-- slice and product-->
            <div class="slice_product">
                <!--slice-->
                <?php require_once "slice.php" ?>
                <!--product and page-->
                <?php require_once "product_page.php" ?>
            </div>
            <!-- navigation-->
            <div class="navigation">
                <!--form login-->
                <?php require_once "form_login.php" ?>
                <!---category-->
                <?php require_once "category.php" ?>
                <!---navigation_favorite_product-->
                <div class="navigation_favorite_product">
                    <form action="">
                        <div class="product_favorite">
                            <h5>Top10 yêu thích</h5>
                        </div>
                        <?php
                        $sql = "SELECT  * FROM hang_hoa ORDER BY so_luot_xem Desc Limit 10";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $product_favorite = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($product_favorite as $pr) : ?>
                            <div class="favorite">
                                <img src="/duanmau_tkws/admin/image/<?= $pr['hinh_anh'] ?>" alt="ảnh sản phẩm">
                                <span><a href="#"><?= $pr['ten_hh'] ?></a></span>
                            </div>
                        <?php endforeach ?>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer alert alert-success">
            <h5>Education</h5>
            <span>Copy right @ 2020</span>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>