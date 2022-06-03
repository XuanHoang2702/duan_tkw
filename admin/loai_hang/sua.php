<?php
require_once "../ketnoi/ketnoi.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $ma_loai = $_POST['ma'];
    $ten_loai = $_POST['ten_loai'];
    // check form
    if ($ten_loai == "") {
        $errors['ten_loai'] = "Hãy nhập vào để sửa";
    }
    // thêm
    if (!array_filter($errors)) {
        $sql = "UPDATE loai_hang SET ma_loai='$ma_loai', ten_loai='$ten_loai' where ma_loai=$ma_loai";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        header("location: danhsach.php?message=Thêm thành công");
        die;
    }
}
// 
$ma = $_GET['ma_loai'];
$sql = "SELECT * FROM loai_hang where ma_loai=$ma";
$stmt = $conn->prepare($sql);
$stmt->execute();
$ll = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sửa loại hàng</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        button {
            border-radius: 5px;
        }

        label {
            display: block;
        }

        input {
            width: 100%;
            border-radius: 5px;
        }

        .ma_loai {
            margin-bottom: 30px;
            margin-top: 10px;
        }

        span {
            display: block;
            color: red;
        }

        button:hover {
            border: 3px solid blue;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php require_once "../trangchinh/layoutchung.php"; ?>
        <h2 style="margin-top:20px ;" class="alert alert-success">Sửa loại hàng</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <label>Mã loại</label>
                <input type="text" name="ma" value="<?= $ll['ma_loai'] ?>" readonly>
            </div>
            <div class="ma_loai">
                <label>Tên loại</label>
                <input type="text" placeholder="Nhập tên loại" name="ten_loai" value="<?= $ll['ten_loai'] ?>">
                <span><?= $errors['ten_loai'] ?? '' ?></span>
            </div>
            <div>
                <button type="reset">Nhập lại</button>
                <button type="submit">Sửa</button>
                <button><a style="color: black ; text-decoration: none;" href="them.php"> Nhập thêm</a></button>
                <button><a style="text-decoration: none ; color: black;" href="danhsach.php?btn_list">Danh sách</a></button>
            </div>
        </form>
    </div>
</body>

</html>