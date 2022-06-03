<?php
require_once "../ketnoi/ketnoi.php";
$pageUnit = 10;
if (isset($_GET['trang'])) {
    $page = $_GET['trang'];
} else {
    $page = 1;
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>danh sách hàng hóa</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        table {
            width: 100%;
        }

        td {
            height: 40px;

        }

        td button {
            border: none;
            border-radius: 5px;

        }

        a {
            padding: 0px 4px;
            color: white;
        }

        td button:hover {
            opacity: 0.5;
        }

        .button {
            margin-top: 10px;
        }

        .button button:hover {
            opacity: 0.5;
            border: 3px solid blue;
        }
    </style>

</head>

<body>
    <div class="container">

        <h1 class="alert alert-danger">Quản trị website</h1>
        <nav class="navbar navbar-expand-lg navbar-light bg-dark ">
            <a class="navbar-brand text-white" href="../trangchinh/giaodien.php">Trang chủ</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="../loai_hang/danhsach.php">Loại hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="list_hh.php">Hàng hóa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="../khachhang/list_kh.php">Khách hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">Bình Luận</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">Thống kê</a>
                    </li>
                </ul>
            </div>
        </nav>
        <h2 style="margin-top:20px ;" class="alert alert-success">Quản lý loại hàng</h2>
        <form action="check_delete.php" method="POST">
            <table>
                <thead>
                    <tr style="margin-top:20px ;" class="alert alert-success">
                        <th style="width: 5%;"></th>
                        <th style="width: 10%;">Mã hàng hóa</th>
                        <th style="width: 30%;">tên hàng hóa</th>
                        <th style="width: 10%;">đơn giá</th>
                        <th style="width: 10%;">giảm giá</th>
                        <th style="width: 10%;">lượt xem</th>
                        <th style="width: 10%;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $from = ($page - 1) * $pageUnit;
                    $sql = "SELECT * FROM hang_hoa ORDER BY ma_hh Desc LIMIT $from,$pageUnit";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $hang = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($hang as $h) : ?>
                        <tr style="border-bottom:1px solid gray ;">
                            <th><input type="checkbox" name="check[]" id="check_all" value="<?= $h['ma_hh'] ?>"></th>
                            <td><?= $h['ma_hh'] ?></td>
                            <td><?= $h['ten_hh'] ?></td>
                            <td><?= $h['don_gia'] ?></td>
                            <td><?= $h['giam_gia'] ?></td>
                            <td><?= $h['so_luot_xem'] ?></td>
                            <td>
                                <button style="background-color: blue;"><a href="sua_hh.php?ma_hh=<?= $h['ma_hh'] ?>">Sửa</a></button>
                                <button style="background-color: red;"><a onclick="return confirm('Bạn có chắc chắn muốn xóa không')" href="xoa_hh.php?ma_hh=<?= $h['ma_hh'] ?>">Xóa</a></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <div style="text-align: center; margin-bottom: 20px;" class="btn_page">
                    <?php
                    $x = "SELECT * FROM hang_hoa ORDER BY ma_hh Desc";
                    $stmt = $conn->prepare($x);
                    $stmt->execute();
                    $product = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $productSum = count($product);
                    $pageSum = ceil($productSum / $pageUnit);
                    for ($i = 1; $i <= $pageSum; $i++) { ?>
                        <a style="color: black;border: 1px solid red; padding: 2px 4px;background-color: green;" href="list_hh.php?trang=<?= $i ?>"><?= $i ?></a>
                    <?php } ?>
                </div>
            </table>

            <div class="button">
                <input type="button" id="btn1" value="Chọn hết" />
                <input type="button" id="btn2" value="Bỏ chọn" />
                <input onclick="return confirm('Bạn có chắc chắn muốn xóa không')" name="delete" type="submit" value="xóa các mục đã chọn">
                <a style="background-color: green ; text-decoration: none; border: 2px solid black; padding: 2px 2px;" href="them_hh.php"> Nhập thêm</a>
            </div>
            <script language="javascript">
                // Chức năng chọn hết
                document.getElementById("btn1").onclick = function() {
                    // Lấy danh sách checkbox
                    var checkboxes = document.getElementsByName('check[]');

                    // Lặp và thiết lập checked
                    for (var i = 0; i < checkboxes.length; i++) {
                        checkboxes[i].checked = true;
                    }
                };

                // Chức năng bỏ chọn hết
                document.getElementById("btn2").onclick = function() {
                    // Lấy danh sách checkbox
                    var checkboxes = document.getElementsByName('check[]');

                    // Lặp và thiết lập Uncheck
                    for (var i = 0; i < checkboxes.length; i++) {
                        checkboxes[i].checked = false;
                    }
                };
            </script>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>