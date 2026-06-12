<?php

$jsonFile = __DIR__ . '/inventory-website.json';

$products = [];

if (file_exists($jsonFile)) {

    $json = json_decode(
        file_get_contents($jsonFile),
        true
    );

    if (
        isset($json['success']) &&
        $json['success'] === true
    ) {

        $products = array_filter(
            $json['data'] ?? [],
            function ($product) {

                $quantity =
                    (int)($product['quantity'] ?? 0);

                if ($quantity < 1) {
                    return false;
                }

                $groupName =
                    mb_strtolower(
                        trim(
                            $product['product_group_name']
                            ?? ''
                        ),
                        'UTF-8'
                    );

                $excludeGroups = [
                    'cước cuộn',
                    'cước vỉ',
                    'dán đế giày'
                ];

                foreach ($excludeGroups as $exclude) {

                    if (
                        str_contains(
                            $groupName,
                            $exclude
                        )
                    ) {
                        return false;
                    }

                }

                return true;

            }
        );

    }

}

?>

<!DOCTYPE html>
<html lang="vi">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>
    Tra cứu giá sản phẩm
</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<link rel="stylesheet"
      href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

<style>

:root{
    --primary:#69A84F;
    --primary-dark:#4F8538;
}

body{
    background:#f5f7fa;
}

.navbar{
    background:var(--primary);
    box-shadow:0 2px 15px rgba(0,0,0,.08);
}

.navbar .nav-link{
    color:#fff !important;
    font-weight:600;
    margin-left:10px;
}

.navbar .nav-link:hover{
    opacity:.85;
}

.footer{
    background:var(--primary-dark);
    color:#fff;
}
.header{
    background:#69A84F;
    color:#fff;
    padding:20px 0;
    margin-bottom:25px;
}

.table-box{
    background:#fff;
    border-radius:15px;
    padding:20px;
    box-shadow:0 5px 20px rgba(0,0,0,.08);
}

.table td{
    vertical-align:middle;
}

.dataTables_filter input{
    min-width:300px;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current,
.page-item.active .page-link{
    background:#69A84F !important;
    border-color:#69A84F !important;
    color:#fff !important;
}

.page-link{
    color:#69A84F;
}

.dataTables_length,
.dataTables_filter{
    margin-bottom:15px;
}

</style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">

    <div class="container">

        <a class="navbar-brand"
           href="index.php">

            <img src="images/logo.png"
                 alt="Badminton Shop"
                 width="150">

        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMain">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse"
             id="navbarMain">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link"
                       href="index.php">
                        Trang chủ
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active"
                       href="products.php">
                        Sản phẩm
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                       href="stringing.php">
                        Bảng giá căng cước
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                       href="affiliate.php">
                        Cộng tác viên bán hàng
                    </a>
                </li>

            </ul>

        </div>

    </div>

</nav>

<div class="container py-5">
    <div class="row mb-3">

        <div class="col-md-4">

            <select
                id="groupFilter"
                class="form-select"
            >

                <option value="">
                    Tất cả nhóm sản phẩm
                </option>

                <?php

                $groups = [];

                foreach ($products as $product) {

                    $group = trim(
                        $product['product_group_name']
                        ?? ''
                    );

                    if ($group !== '') {

                        $groups[$group] = $group;

                    }

                }

                ksort($groups);
                ?>

                <?php foreach ($groups as $group): ?>

                <option
                    value="<?= htmlspecialchars(trim($group)) ?>"
                >
                    <?= htmlspecialchars(trim($group)) ?>
                </option>

                <?php endforeach; ?>

            </select>

        </div>

    </div>
    <div class="table-box">

        <div class="table-responsive">

            <table
                id="productTable"
                class="table table-hover table-striped align-middle"
            >

                <thead>

                    <tr>

                        <th>
                            Tên sản phẩm
                        </th>

                        <th width="250">
                            Nhóm sản phẩm
                        </th>

                        <th width="180">
                            Giá bán
                        </th>

                        <th width="100">
                            Tồn
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php


                    foreach ($products as $product):

                        $price =
                            !empty($product['sale_price'])
                            ? $product['sale_price']
                            : ($product['price'] ?? 0);

                    ?>

                    <tr>


                        <td>

                            <?= htmlspecialchars(
                                $product['name'] ?? ''
                            ) ?>

                        </td>

                        <td>

                            <?= htmlspecialchars(
                                $product['product_group_name']
                                ?? ''
                            ) ?>

                        </td>

                        <td
                            data-order="<?= (float)$price ?>"
                        >

                            <span class="price">

                                <?= number_format(
                                    (float)$price,
                                    0,
                                    ',',
                                    '.'
                                ) ?>

                                ₫

                            </span>

                        </td>

                        <td>

                            <?= (int)(
                                $product['quantity']
                                ?? 0
                            ) ?>

                        </td>

                    </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<footer class="footer py-4 mt-5">

    <div class="container text-center">

        © 2026 Mạnh Dũng Sports - All Rights Reserved

    </div>

</footer>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<script>

$(function() {

    const table = $('#productTable').DataTable({

        pageLength: 50,

        deferRender: true,

        stateSave: true,

        lengthMenu: [
            [25, 50, 100, 200, -1],
            [25, 50, 100, 200, 'Tất cả']
        ],

        order: [[0, 'asc']],

        language: {

            search: "Tìm kiếm:",

            lengthMenu:
                "Hiển thị _MENU_ sản phẩm",

            info:
                "Hiển thị _START_ - _END_ / _TOTAL_ sản phẩm",

            infoEmpty:
                "Không có dữ liệu",

            zeroRecords:
                "Không tìm thấy sản phẩm",

            paginate: {

                first: "Đầu",

                last: "Cuối",

                next: "›",

                previous: "‹"

            }

        }

    });

    $('#groupFilter').on(
        'change',
        function () {

            const value = this.value;

            if (value) {

                table
                    .column(1)
                    .search(
                        '^' +
                        $.fn.dataTable.util.escapeRegex(
                            value
                        ) +
                        '$',
                        true,
                        false
                    )
                    .draw();

            } else {

                table
                    .column(1)
                    .search('')
                    .draw();

            }

        }
    );

});

</script>

</body>

</html>