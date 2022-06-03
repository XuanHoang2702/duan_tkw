<?php
require_once "../ketnoi/ketnoi.php";

$sql = "SELECT * FROM khach_hang ORDER BY ma_kh Desc";
$stmt = $conn->prepare($sql);
$stmt->execute();
$khach_hang = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">

<head>
    <title>danh sách Khách hàng</title>
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
            color: white;
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

        img {
            width: 100px;
            height: 100px;
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
                        <a class="nav-link text-light" href="#">Khách hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="../binhluan/list_bl.php">Bình Luận</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">Thống kê</a>
                    </li>
                </ul>
            </div>
        </nav>
        <h2 style="margin-top:20px ;" class="alert alert-success">Quản lý khách hàng</h2>
        <form action="">
            <table>
                <thead>
                    <tr style="margin-top:20px ;" class="alert alert-success">
                        <th style="width: 5%;"></th>
                        <th style="width: 10%;">Mã khách hàng</th>
                        <th style="width: 20%;">Họ và tên</th>
                        <th style="width: 20%;">Địa chỉ email</th>
                        <th style="width: 20%;">Hình ảnh </th>
                        <th style="width: 10%;">Vai trò</th>
                        <th style="width: 10%;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($khach_hang as $kh) :
                    ?>
                        <tr style="border-bottom:1px solid gray ;">
                            <th><input type="checkbox" value="<?= $ma_kh ?>"></th>
                            <td><?= $kh['ma_kh'] ?></td>
                            <td><?= $kh['ho_ten'] ?></td>
                            <td><?= $kh['email'] ?></td>
                            <td>
                                <img src="/duanmau_tkws/image/<?= $kh['hinh_anh_kh'] ?>" alt="">
                            </td>
                            <!-- <td><?= $kh['hinh_anh_kh'] ?></td> -->
                            <td>
                                <?php if ($kh['vai_tro'] = 1) {
                                    echo "nhân viên";
                                } else {
                                    echo "khách hàng";
                                } ?>
                            </td>
                            <td>
                                <button style="background-color: blue;"><a href="sua_kh.php?ma_kh=<?= $kh['ma_kh'] ?>">Sửa</a></button>
                                <button style="background-color: red;"><a onclick="return confirm('Bạn có chắc chắn muốn xóa không')" href="xoa_kh.php?ma_kh=<?= $kh['ma_kh'] ?>">Xóa</a></button>
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