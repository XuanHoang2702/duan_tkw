<?php
require_once "../ketnoi/ketnoi.php";

if (isset($_GET['ma_hh'])) {
    $ma = $_GET['ma_hh'];
    $sql = "DELETE FROM hang_hoa  WHERE ma_hh=$ma";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header("location: list_hh.php?message=Thêm thành công");
    die;
}
