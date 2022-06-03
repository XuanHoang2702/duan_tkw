<?php
require_once "../ketnoi/ketnoi.php";
$errors[] = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $ma_kh = $_POST['ma_kh'];
    $ten_kh = $_POST['ho_ten'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];
    $kich_hoat = $_POST['radio_kh'];
    $vai_tro = $_POST['radio_vt'];
    $hinh_anh = $_FILES['hinh_anh']['name'];

    // check form
    if ($ten_kh == "") {
        $errors['ten_kh'] = "hãy nhập tên khách hàng";
    }
    if ($password == "") {
        $errors['password'] = "hãy nhập mật khẩu";
    }
    if ($confirm_password == "") {
        $errors['confirm_password'] = "hãy nhập để xác nhận lại mật khẩu";
    }
    if ($confirm_password != $password) {
        $errors['confirm_password1'] = "mật khẩu nhập lại không đúng";
    }
    //
    if ($email == "") {
        $errors['email'] = "hãy nhập email";
    }
    if ($_FILES['hinh_anh']['size'] < 0) {
        $errors['anh1'] = "hãy chọn ảnh";
    }
    $img = ['jpg', 'png', 'gif'];
    $ext = pathinfo($_FILES['hinh_anh']['name'], PATHINFO_EXTENSION);
    if (!in_array($ext, $img)) {
        $errors['anh2'] = "ảnh sai định dạng";
    }
    // thêm
    if (!array_filter($errors)) {
        $sql = "INSERT INTO khach_hang(mat_khau, ho_ten,kich_hoat,hinh_anh_kh,email,vai_tro)
             Value('$password','$ten_kh','$kich_hoat','$hinh_anh','$email','$vai_tro')";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        move_uploaded_file($_FILES['hinh_anh']['tmp_name'], '../image/' . $_FILES['hinh_anh']['name']);
        header("location: list_kh.php?message=Thêm thành công");
        die;
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>thêm Khách hàng</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!--css-->
    <style>
        .list-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        label {
            display: block;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        input {
            width: 520px;
            border: 1px solid black;
            padding: 4px 0px;
        }

        #check_kichhoat label {
            display: inline;
        }

        #check_kichhoat input {
            width: 5%;
        }

        #check_vaitro label {
            display: inline;
        }

        #check_vaitro input {
            width: 5%;
        }

        .kich_hoat {
            border: 1px solid black;
            margin-top: 25px;
            width: 520px;
            padding: 4px 0px;
        }

        .vaitro {
            border: 1px solid black;
            margin-top: 20px;
            width: 520px;
            padding: 4px 0px;
        }

        button {
            background-color: green;
        }

        .btn button:hover {
            opacity: 0.5;
        }

        #group_right {
            padding-left: 60px;
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
                        <a class="nav-link text-light" href="../binhluan/list_bl.php">Bình Luận</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">Thống kê</a>
                    </li>
                </ul>
            </div>
        </nav>
        <h2 style="margin-top:20px ;" class="alert alert-success">Quản lý khách hàng</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="list-group">
                <div class="group">
                    <div class="ma_kh">
                        <label for="">Mã khách hàng</label>
                        <input style="background-color:	#DCDCDC;" type="text" name="ma_kh" placeholder="auto number" readonly>
                        <br>
                        <span></span>
                    </div>
                    <div class="mat_khau">
                        <label for="">Mật khẩu</label>
                        <input type="password" name="password" value="<?= $password ?? '' ?>">
                        <span style="color: red;"><?= $errors['password'] ?? ''  ?></span>
                    </div>
                    <div class="email">
                        <label for="">Địa chỉ email</label>
                        <input type="email" name="email" value="<?= $email ?? '' ?>">
                        <span style="color: red;"><?= $errors['email'] ?? ''  ?></span>
                    </div>
                    <div class="KH">
                        <label for="">kích hoạt</label>
                        <div class="kich_hoat" id="check_kichhoat">
                            <input type="radio" name="radio_kh" value="1">
                            <label for="">chưa kích hoạt</label>
                            <input type="radio" name="radio_kh" value="0" checked>
                            <label for="">đã kích hoạt</label>
                        </div>
                    </div>

                </div>
                <div class="group" id="group_right">
                    <div class="ho_ten">
                        <label for="">Họ và tên</label>
                        <input type="text" name="ho_ten" value="<?= $ten_kh ?? '' ?>">
                        <span style="color: red;"><?= $errors['ten_kh'] ?? ''  ?></span>
                    </div>
                    <div class="xacnhan_matkhau">
                        <label for="">Xác nhận lại mật khẩu</label>
                        <input type="password" name="confirm_password" value="<?= $confirm_password ?? '' ?>">
                        <span style="color: red;"><?= $errors['confirm_password'] ?? ''  ?></span>
                        <span style="color: red;"><?= $errors['confirm_password1'] ?? ''  ?></span>
                    </div>
                    <div class="hinh_anh">
                        <label for="">Hình ảnh</label>
                        <input type="file" name="hinh_anh">
                        <span style="color: red;"><?= $errors['anh1'] ?? ''  ?></span>
                        <span style="color: red;"><?= $errors['anh2'] ?? ''  ?></span>
                    </div>
                    <div class="VT">
                        <label for="">Vai trò</label>
                        <div class="vaitro" id="check_vaitro">
                            <input type="radio" name="radio_vt" value="0" checked>
                            <label for="">Khách hàng</label>
                            <input type="radio" name="radio_vt" value="1">
                            <label for="">Nhân viên</label>
                        </div>
                    </div>

                </div>
            </div>
            <div class="btn">
                <button type="submit"> thêm</button>
                <button type="reset">Nhập lại</button>
                <button><a style="color: black ; text-decoration: none;" href="list_kh.php"> danh sách</a></button>
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