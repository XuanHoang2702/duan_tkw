<?php
require_once "../ketnoi/ketnoi.php";
$errors[] = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $ten_hh = $_POST['ten_hh'];
    $don_gia = $_POST['don_gia'];
    $giam_gia = $_POST['giam_gia'];
    $hinh_anh = $_FILES['hinh_anh']['name'];
    $ngay_nhap = $_POST['ngay_nhap'];
    $mo_ta = $_POST['mota'];
    $dac_biet = $_POST['gender'];
    $so_luotxem = $_POST['luot_xem'];
    $ma_loai = $_POST['ma_loai'];
    // check form
    if ($ten_hh == "") {
        $errors['ten_hh'] = "Bạn hãy nhập tên hàng hóa";
    }
    if ($don_gia == "" && $don_gia < 0) {
        $errors['don_gia'] = "Bạn hãy nhập đơn giá và là số lớn hơn 0";
    }
    if ($giam_gia == "" && $giam_gia < 0) {
        $errors['giam_gia'] = "hãy nhập giảm giá và là số lớn hơn hoặc bằng 0 ";
    }
    if ($ngay_nhap == "") {
        $errors['ngay_nhap'] = "hãy chọn ngày nhập";
    }
    if ($dac_biet == "") {
        $errors['dac_biet'] = "hãy chọn 1 trong 2 để xác định hàng đặc biệt hay bình thường";
    }
    if ($so_luotxem == "") {
        $errors['luot_xem'] = "hãy nhập lượt xem";
    }
    if ($_FILES['hinh_anh']['size'] < 0) {
        $errors['anh1'] = "hãy chọn ảnh";
    }
    // đuôi

    // thêm
    if (!array_filter($errors)) {
        $sql = "INSERT INTO hang_hoa(ten_hh, don_gia,giam_gia,hinh_anh,ngay_nhap,mo_ta,dac_biet,so_luot_xem,ma_loai)
        Value('$ten_hh','$don_gia','$giam_gia','$hinh_anh','$ngay_nhap','$mo_ta','$dac_biet','$so_luotxem','$ma_loai')";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        move_uploaded_file($_FILES['hinh_anh']['tmp_name'], '../image/' . $_FILES['hinh_anh']['name']);
        header("location: list_hh.php?message=Thêm thành công");
        die;
    }
}
$sql = "SELECT * FROM loai_hang ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$loai = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">

<head>
    <title>thêm hàng hóa</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!--css-->
    <style>
        .list-group {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            grid-column-gap: 65px;
        }

        .group {
            width: 33%;
        }

        label {
            display: block;
            margin-top: 10px;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 18px;
            width: 320px;
        }

        input {
            width: 320px;
            border: 1px solid black;
            padding: 4px 0px;
        }

        select {
            width: 320px;
            padding: 5px 0px;
        }

        .dac_biet {
            width: 320px;
        }

        .dac_biet label {
            padding-top: 6px;
        }

        #check_dacbiet {
            border: 1px solid black;
            padding: 5px 2px;
        }

        #check_dacbiet label {
            display: inline;
            font-size: 15px;
            font-weight: 400;
        }

        #check_dacbiet input {
            width: auto;
        }

        button {
            margin-top: 20px;
            padding: 2px 7px;
        }

        .btn button:hover {
            border: 3px solid red;
        }

        span {
            color: red;
            width: 320px;
        }

        .list-group div {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="alert alert-danger">Quản trị website</h1>
        <nav class="navbar navbar-expand-lg navbar-light bg-dark ">
            <a class="navbar-brand text-white" href="giaodien.php">Trang chủ</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="../loai_hang/danhsach.php">Loại hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="list_hh">Hàng hóa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">Khách hàng</a>
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
        <h2 style="margin-top:20px ;" class="alert alert-success">Thêm hàng hóa</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="list-group">
                <div class="group">
                    <div class="ma_hh">
                        <label for="">Mã hàng hóa</label>
                        <input style="background-color:	#DCDCDC;" type="text" name="ma_hh" placeholder="autonumber" readonly>
                    </div>
                    <div class="giam_gia">
                        <label for="">Giảm giá</label>
                        <input type="number" name="giam_gia" value="<?= $giam_gia ?? '' ?>">
                        <br>
                        <span><?= $errors['giam_gia'] ?? '' ?></span>
                    </div>
                    <div class="dac_biet">
                        <label for="">hàng đặc biệt</label>
                        <div class="check" id="check_dacbiet">
                            <input type="radio" name="gender" value="1">
                            <label for="">Đặc biệt</label>
                            <input type="radio" name="gender" value="0" checked>
                            <label for="">Bình thường</label>
                        </div>
                        <span><?= $errors['dac_biet'] ?? '' ?></span>
                    </div>
                </div>
                <div class="group">
                    <div class="ten_hanghoa">
                        <label for="">Tên hàng hóa</label>
                        <input type="text" name="ten_hh" value="<?= $ten_hh ?? '' ?>">
                        <br>
                        <span style="width:320px ;"><?= $errors['ten_hh'] ?? '' ?></span>
                    </div>
                    <div class="hinh_anh">
                        <label for="">Hình ảnh</label>
                        <input type="file" name="hinh_anh">
                        <br>
                        <span><?= $errors['hinh_anh1'] ?? '' ?></span>
                    </div>
                    <div class="ngay_nhap">
                        <label for="">Ngày nhập</label>
                        <input type="date" name="ngay_nhap" value="<?= $ngay_nhap ?? '' ?>">
                        <br>
                        <span><?= $errors['ngay_nhap'] ?? '' ?></span>
                    </div>
                </div>
                <div class="group">
                    <div class="don_gia">
                        <label for="">Đơn giá</label>
                        <input type="number" name="don_gia" value="<?= $don_gia ?? '' ?>">
                        <br>
                        <span><?= $errors['don_gia'] ?? '' ?></span>
                    </div>
                    <div class="loai_hang">
                        <label for="">Loại hàng</label>
                        <select name="ma_loai">
                            <?php foreach ($loai as $l) : ?>
                                <option value="<?= $l['ma_loai'] ?>">
                                    <?= $l['ten_loai'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="so_luotxem">
                        <label for="">Số lượt xem</label>
                        <input type="text" name="luot_xem" value="<?= $so_luotxem ?? '' ?>">
                        <br>
                        <span><?= $errors['luot_xem'] ?? '' ?></span>
                    </div>
                </div>
            </div>
            <div class="mota">
                <label for="">Mô tả</label>
                <textarea name="mota" id="" cols="147" rows="5"></textarea>
            </div>
            <div class="btn">
                <button type="submit">Thêm mới</button>
                <button type="reset">Nhập lại</button>
                <button type="submit"><a style="color: black ; text-decoration: none;" href="list_hh.php"> danh sách</a></button>
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