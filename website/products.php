<?php
require_once __DIR__ . '/includes/header.php';

$jsonFile = __DIR__ . '/../data/yonex/products/data.json';

$products = [];

if (file_exists($jsonFile)) {
    $json = json_decode(file_get_contents($jsonFile), true);
    if (is_array($json)) {
        $products = $json;
    }
}

/**
 * FILTER INPUT
 */
$q    = trim($_GET['q'] ?? '');
$cat  = strtolower(trim($_GET['cat'] ?? 'all'));
$sort = $_GET['sort'] ?? '';

/**
 * CATEGORY NORMALIZE (theo data thật của bạn)
 */
$categoryMap = [
    'racket'     => 'racquets',
    'shoes'      => 'footwear',
    'bag'        => 'bags',
    'accessory'  => 'accessories'
];

$categoryLabel = [
    'racquets'     => 'Vợt cầu lông',
    'footwear'     => 'Giày cầu lông',
    'bags'         => 'Túi vợt',
    'strings'      => 'Dây cước',
    'apparel'      => 'Quần áo',
    'shuttlecocks' => 'Quả cầu lông',
    'accessories'  => 'Phụ kiện'
];

/**
 * NORMALIZE PRODUCTS
 */
$products = array_map(function ($p) use ($categoryMap) {

    $cat = strtolower(trim($p['category'] ?? 'other'));
    $cat = $categoryMap[$cat] ?? $cat;

    return [
        'name'       => $p['name'] ?? '',
        'price'      => (int)($p['price'] ?? 0),
        'category'   => $cat,
        'image'      => $p['image'] ?? '',
        'image_file' => $p['image_file'] ?? '',
        'slug'       => $p['slug'] ?? '',
        'url'        => $p['url'] ?? '#'
    ];
}, $products);



/**
 * FILTER
 */
$products = array_values(array_filter($products, function ($p) use ($q, $cat) {

    if ($cat !== 'all' && $p['category'] !== $cat) {
        return false;
    }

    if ($q !== '' && mb_stripos($p['name'], $q) === false) {
        return false;
    }

    return true;
}));

/**
 * SORT PRICE
 */
if ($sort === 'asc') {
    usort($products, fn($a,$b) => $a['price'] <=> $b['price']);
}
if ($sort === 'desc') {
    usort($products, fn($a,$b) => $b['price'] <=> $a['price']);
}
?>

<style>

body{
    font-family: Arial, Helvetica, sans-serif;
    background:#f5f5f5;
    color:#222;
}

/* TITLE */
.page-title{
    font-size:28px;
    font-weight:700;
    text-align:center;
    margin:20px 0;
}

/* FILTER BAR */
.filter-bar{
    background:#fff;
    padding:14px;
    border-radius:14px;
    box-shadow:0 2px 10px rgba(0,0,0,.06);
    margin-bottom:18px;

    display:flex;
    gap:10px;
    flex-wrap:wrap;
    align-items:center;
}

.filter-bar input,
.filter-bar select{
    height:40px;
    padding:10px 12px;
    border:1px solid #ddd;
    border-radius:10px;
    outline:none;
}

.filter-bar input{
    width:240px;
}

/* CHIPS */
.filter-chips{
    display:flex;
    gap:8px;
    flex-wrap:wrap;
    margin-left:auto;
}

.chip{
    padding:8px 14px;
    border-radius:10px;
    border:1px solid #e0e0e0;
    background:#f7f7f7;
    cursor:pointer;
    font-size:13px;
    font-weight:600;
    transition:.2s;
    color:#444;
}

.chip:hover{
    background:#e9f5ea;
    border-color:#2e7d32;
    color:#2e7d32;
    transform:translateY(-1px);
}

.chip.active{
    background:#2e7d32;
    color:#fff;
    border-color:#2e7d32;
    box-shadow:0 4px 10px rgba(46,125,50,.25);
}

/* GRID */
.product-grid{
    display:grid;
    grid-template-columns:repeat(5,1fr);
    gap:14px;
}

/* CARD */
.product-card{
    background:#fafafa;
    border-radius:12px;
    padding:12px;
    box-shadow:0 2px 8px rgba(0,0,0,.06);
    transition:.2s;
    position:relative;
}

.product-card:hover{
    transform:translateY(-3px);
    box-shadow:0 10px 22px rgba(0,0,0,.12);
}

.product-image{
    width:100%;
    height:160px;
    object-fit:contain;
    padding:10px;
}

.product-name{
    font-size:14px;
    font-weight:600;
    margin-top:10px;
    min-height:38px;
}

.product-price{
    margin-top:6px;
    font-size:15px;
    font-weight:700;
    color:#d70018;
}

.product-price.empty{
    color:#666;
    font-weight:500;
}

/* BUTTON */
.product-btn{
    margin-top:10px;
    display:flex;
    gap:6px;
    align-items:center;
    color:#2e7d32;
    font-weight:600;
    font-size:13px;
    text-decoration:none;
}

.icon{
    width:16px;
    height:16px;
    fill:currentColor;
}

/* BADGE */
.badge{
    position:absolute;
    top:8px;
    left:8px;
    background:#2e7d32;
    color:#fff;
    font-size:11px;
    padding:3px 8px;
    border-radius:999px;
}

/* RESPONSIVE */
@media(max-width:1200px){.product-grid{grid-template-columns:repeat(4,1fr);}}
@media(max-width:992px){.product-grid{grid-template-columns:repeat(3,1fr);}}
@media(max-width:768px){.product-grid{grid-template-columns:repeat(2,1fr);}}

</style>

<div class="container py-4">

<form class="filter-bar" method="GET">

    <input type="text" name="q"
           placeholder="Tìm kiếm sản phẩm..."
           value="<?= htmlspecialchars($q) ?>">

    <select name="sort">
        <option value="">Sắp xếp</option>
        <option value="asc"  <?= $sort=='asc'?'selected':'' ?>>Giá tăng dần</option>
        <option value="desc" <?= $sort=='desc'?'selected':'' ?>>Giá giảm dần</option>
    </select>

    <div class="filter-chips">

        <button type="submit" name="cat" value="all"
            class="chip <?= $cat=='all'?'active':'' ?>">Tất cả</button>

        <button type="submit" name="cat" value="racquets"
            class="chip <?= $cat=='racquets'?'active':'' ?>">Vợt</button>

        <button type="submit" name="cat" value="footwear"
            class="chip <?= $cat=='footwear'?'active':'' ?>">Giày</button>

        <button type="submit" name="cat" value="bags"
            class="chip <?= $cat=='bags'?'active':'' ?>">Túi</button>

        <button type="submit" name="cat" value="accessories"
            class="chip <?= $cat=='accessories'?'active':'' ?>">Phụ kiện</button>

        <button type="submit" name="cat" value="strings"
            class="chip <?= $cat=='strings'?'active':'' ?>">Dây đan</button>

        <button type="submit" name="cat" value="apparel"
            class="chip <?= $cat=='apparel'?'active':'' ?>">Quần áo</button>

        <button type="submit" name="cat" value="shuttlecocks"
            class="chip <?= $cat=='shuttlecocks'?'active':'' ?>">Cầu lông</button>

    </div>

</form>

<div class="product-grid">

<?php foreach ($products as $p):

    $name  = $p['name'];
    $url   = "product-detail.php?slug=" . urlencode($p['slug'] ?? '');
    $price = $p['price'];

    $imgFile = $p['image_file'];
    $imgUrl  = $p['image'];
    $category = $p['category'];

    $realPath = __DIR__ . '/../' . $imgFile;

    $img = (!empty($imgFile) && file_exists($realPath))
        ? '/' . $imgFile
        : $imgUrl;

?>

<div class="product-card">

    <div class="badge">
        <?= htmlspecialchars($categoryLabel[$category] ?? $category) ?>
    </div>

    <img class="product-image"
         src="<?= htmlspecialchars($img) ?>"
         alt="<?= htmlspecialchars($name) ?>">

    <div class="product-name">
        <?= htmlspecialchars($name) ?>
    </div>

    <?php if ($price > 0): ?>
        <div class="product-price">
            <?= number_format($price,0,',','.') ?> ₫
        </div>
    <?php else: ?>
        <div class="product-price empty">Liên hệ</div>
    <?php endif; ?>

    <a class="product-btn" href="<?= htmlspecialchars($url) ?>" target="_blank">
        <svg class="icon" viewBox="0 0 24 24">
            <path d="M10 6l6 6-6 6V6z"/>
        </svg>
        Xem chi tiết
    </a>

</div>

<?php endforeach; ?>

</div>

</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>