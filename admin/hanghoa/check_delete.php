<?php
require_once "../ketnoi/ketnoi.php";

if (isset($_POST['delete'])) {
    $checkbox = $_POST['check'];


    for ($i = 0; $i < count($checkbox); $i++) {
        $del_id = $checkbox[$i];
        $sql = "DELETE FROM hang_hoa  WHERE ma_hh=$del_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    };
    echo "hh";

    header("location: list_hh.php?message=Thêm thành công");
    die;
}
