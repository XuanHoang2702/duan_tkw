<?php
require_once "../ketnoi/ketnoi.php";

$sql = "SELECT * FROM binh_luan ORDER BY ma_bl Desc";
$stmt = $conn->prepare($sql);
$stmt->execute();
$binh_luan = $stmt->fetchAll(PDO::FETCH_ASSOC);
//
$sql = "SELECT * FROM hang_hoa ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$hang_hoa = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">

<head>
    <title>danh sách bình luận</title>
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
            height: auto;

        }

        td button {
            border: none;
            border-radius: 5px;

        }

        a {
            padding: 2px 10px;
            color: black;
        }

        td button:hover {
            opacity: 0.5;
        }

        .button button {
            height: 50px;
            border-radius: 5px;
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
                        <a class="nav-link text-light" href="../hanghoa/list_hh.php">Hàng hóa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="../khachhang/list_kh.php">Khách hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="list_bl.php">Bình Luận</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">Thống kê</a>
                    </li>
                </ul>
            </div>
        </nav>
        <h2 style="margin-top:20px ;" class="alert alert-success">Tổng hợp bình luận</h2>
        <form action="">
            <table>
                <thead>
                    <tr style="margin-top:20px ;" class="alert alert-success">
                        <th style="width: 10%;"> hàng hóa</th>
                        <th style="width: 20%;">Số bình luận</th>
                        <th style="width: 20%;">Mới nhất</th>
                        <th style="width: 20%;">Cũ nhất</th>
                        <th style="width: 10%;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($binh_luan as $bl) :
                    ?>
                        <tr style="border-bottom:1px solid gray ;">
                            <td>
                                <?= $bl['ma_hh'] ?>
                            </td>
                            <td>
                                <?php foreach ($hang_hoa as $hh) : ?>
                                    <?php if ($hh['ma_hh'] == $bl['ma_hh']) : ?>
                                        <span><?= $hh['ten_hh'] ?></span>
                                    <?php else : ?>
                                        <span><?php  ?></span>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </td>
                            <td><?= $bl['ngay_bl'] ?></td>
                            <td><?= $bl['ngay_bl'] ?></td>
                            <td>
                                <button style="background-color: green ;"><a href="chi_tiet.php?ma_bl=<?= $bl['ma_bl'] ?>">chi tiết</a></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="button">
                <button>chọn tất cả</button>
                <button>Bỏ chọn tất cả</button>
                <button>xóa các mục đã chọn</button>
                <button><a style="color: black ; text-decoration: none;" href="them_kh.php"> Nhập thêm</a></button>
            </div>
        </form>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>