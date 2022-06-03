<div class="product">
    <?php
    $from = ($page - 1) * $pageUnit;
    $sql = "SELECT * FROM hang_hoa ORDER BY ma_hh Asc LIMIT $from,$pageUnit";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $product = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($product as $sp) : ?>
        <div class="items">
            <img src="/duanmau_tkws/admin/image/<?= $sp['hinh_anh'] ?>" alt="ảnh sản phẩm">
            <span><?= $sp['don_gia'] ?>$</span>
            <p><?= $sp['ten_hh'] ?></p>
        </div>
    <?php endforeach ?>
</div>
<div class="btn_page">
    <?php
    $x = "SELECT ma_hh FROM hang_hoa";
    $stmt = $conn->prepare($x);
    $stmt->execute();
    $product = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $productSum = count($product);
    $pageSum = ceil($productSum / $pageUnit);
    for ($i = 1; $i <= $pageSum; $i++) { ?>
        <a href="trangchu.php?trang=<?= $i ?>"><?= $i ?></a>
    <?php } ?>
</div>