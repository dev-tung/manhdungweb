<?php
require_once __DIR__ . '/includes/header.php';

$slug = strtolower(trim($_GET['slug'] ?? ''));

$jsonFile = __DIR__ . '/../data/yonex/products-detail/' . $slug . '/data.json';

if (!file_exists($jsonFile)) {
    echo "<div style='padding:50px;text-align:center;font-size:18px;'>Không tìm thấy sản phẩm</div>";
    require_once __DIR__ . '/includes/footer.php';
    exit;
}

$product = json_decode(file_get_contents($jsonFile), true);

/**
 * CATEGORY LABEL
 */
$categoryLabel = [
    'racquets'     => 'Vợt cầu lông',
    'footwear'     => 'Giày cầu lông',
    'bags'         => 'Túi vợt',
    'strings'      => 'Dây cước',
    'apparel'      => 'Quần áo',
    'shuttlecocks' => 'Cầu lông',
    'accessories'  => 'Phụ kiện'
];

/**
 * SPECS TRANSLATE MAP
 */
$specLabel = [
    'Flex' => 'Độ dẻo',
    'Frame' => 'Khung vợt',
    'Shaft' => 'Thân vợt',
    'Joint' => 'Khớp nối',
    'Length' => 'Chiều dài',
    'Weight / Grip' => 'Trọng lượng / Cán',
    'Stringing Advice' => 'Lực căng khuyến nghị',
    'Recommended String' => 'Dây khuyên dùng',
    'Color(s)' => 'Màu sắc',
    'Made In' => 'Sản xuất tại',
    'Item Code' => 'Mã sản phẩm'
];

$name        = $product['name'] ?? '';
$title       = $product['title'] ?? $name;
$price       = (int)($product['price'] ?? 0);
$category    = strtolower($product['category'] ?? '');
$url         = $product['detail_url'] ?? ($product['url'] ?? '#');

$image       = $product['image'] ?? '';
$images      = $product['images'] ?? [];
$localImages = $product['local_images'] ?? [];
$specs       = $product['specs'] ?? [];
$desc        = $product['description'] ?? '';

?>

<style>


body{
    font-family: Arial, sans-serif;
    background:#f5f5f5;
}

/* LAYOUT */
.container-detail{
    margin:30px auto;
    background:#fff;
    border-radius:16px;
    padding:20px;
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:30px;
    box-shadow:0 4px 20px rgba(0,0,0,.08);
}

/* MAIN IMAGE */
.main-image img{
    width:100%;
    height:420px;
    object-fit:contain;
    border-radius:10px;
    background:#fafafa;
}

/* THUMB */
.thumb-list{
    display:flex;
    gap:8px;
    margin-top:10px;
    flex-wrap:wrap;
}

.thumb-list img{
    width:70px;
    height:70px;
    object-fit:contain;
    border:1px solid #eee;
    border-radius:8px;
    cursor:pointer;
    background:#fff;
    background:#f8f8f8;
}

/* TEXT */
.title{
    font-size:26px;
    font-weight:700;
}

.badge{
    display:inline-block;
    background:#2e7d32;
    color:#fff;
    padding:4px 10px;
    border-radius:999px;
    font-size:12px;
    margin:10px 0;
}

.price{
    font-size:22px;
    font-weight:700;
    color:#d70018;
    margin:10px 0;
}

.desc{
    color:#555;
    line-height:1.6;
    margin-top:10px;
}

/* SPECS */
.specs{
    margin-top:20px;
    border-top:1px solid #eee;
    padding-top:15px;
}

.specs table{
    width:100%;
    border-collapse:collapse;
}

.specs td{
    padding:8px;
    border-bottom:1px solid #f0f0f0;
    font-size:14px;
}

.specs td:first-child{
    font-weight:600;
    color:#333;
    width:40%;
}

/* BUTTON */
.btn{
    margin-top:20px;
    display:inline-block;
    background:#2e7d32;
    color:#fff;
    padding:12px 18px;
    border-radius:10px;
    text-decoration:none;
    font-weight:600;
}

.btn:hover{
    background:#1b5e20;
}

@media(max-width:768px){
    .container-detail{
        grid-template-columns:1fr;
    }
}

</style>

<div class="container container-detail">

    <!-- LEFT -->
    <div>

        <div class="main-image">
            <img id="mainImg"
                 src="<?= htmlspecialchars($image) ?>"
                 onerror="this.src='https://via.placeholder.com/500x500?text=No+Image'">
        </div>

        <div class="thumb-list">

            <?php
            $allImages = array_merge($images, $localImages);

            foreach ($allImages as $img):
            ?>
                <img src="<?= htmlspecialchars($img) ?>"
                     onclick="document.getElementById('mainImg').src=this.src"
                     onerror="this.style.display='none'">
            <?php endforeach; ?>

        </div>

    </div>

    <!-- RIGHT -->
    <div>

        <div class="badge">
            <?= htmlspecialchars($categoryLabel[$category] ?? $category) ?>
        </div>

        <div class="title">
            <?= htmlspecialchars($title) ?>
        </div>

        <?php if ($price > 0): ?>
            <div class="price">
                <?= number_format($price,0,',','.') ?> ₫
            </div>
        <?php endif; ?>

        <div class="desc">
            <?= $desc ? htmlspecialchars($desc) : 'Sản phẩm chính hãng Yonex, tối ưu cho thi đấu và luyện tập.' ?>
        </div>

        <!-- SPECS VIETNAMESE -->
        <?php if (!empty($specs)): ?>
        <div class="specs">
            <table>
                <?php foreach ($specs as $key => $value): ?>
                    <tr>
                        <td><?= htmlspecialchars($specLabel[$key] ?? $key) ?></td>
                        <td><?= nl2br(htmlspecialchars($value)) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php endif; ?>

    </div>

</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>