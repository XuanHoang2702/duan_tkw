<?php
require_once "../ketnoi/ketnoi.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $ten_loai = $_POST['ten_loai'];
    // check form
    if ($ten_loai == "") {
        $errors['ten_loai'] = "Bạn phải nhập tên loại thì mới thêm vào danh sách được";
    }
    // thêm
    if (!array_filter($errors)) {
        $sql = "INSERT INTO loai_hang(ten_loai)
             Value('$ten_loai')";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        header("location: danhsach.php?message=Thêm thành công");
        die;
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <title>thêm loại hàng</title>
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
        <h2 style="margin-top:20px ;" class="alert alert-success">Thêm loại hàng</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <label>Mã loại</label>
                <input style="background-color:darkgray;" placeholder="auto number" readonly>
            </div>
            <div class="ma_loai">
                <label>Tên loại</label>
                <input type="text" placeholder="Nhập tên loại" name="ten_loai" value="<?= $ten_loai ?? '' ?>">
                <span><?= $errors['ten_loai'] ?? '' ?></span>
            </div>
            <div>
                <button type="reset">Nhập lại</button>
                <button type="submit">Thêm mới</button>
                <button><a style="text-decoration: none ; color: black;" href="danhsach.php?btn_list">Danh sách</a></button>
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