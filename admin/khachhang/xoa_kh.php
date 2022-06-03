
<?php
require_once "../ketnoi/ketnoi.php";

if (isset($_GET['ma_kh'])) {
    $ma = $_GET['ma_kh'];
    $sql = "DELETE FROM khach_hang  WHERE ma_kh=$ma";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header("location: list_kh.php?message=Thêm thành công");
    die;
}
?>