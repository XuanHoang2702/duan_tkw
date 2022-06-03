<?php
require_once "../ketnoi/ketnoi.php";

if (isset($_GET['ma_loai'])) {
    $ma = $_GET['ma_loai'];
    $sql = "DELETE FROM loai_hang  WHERE ma_loai=$ma";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header("location: danhsach.php?message=Thêm thành công");
    die;
}
