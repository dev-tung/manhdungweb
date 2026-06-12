<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Mạnh Dũng Sports | Shop Cầu Lông Chính Hãng
    </title>

    <meta name="description"
          content="Mạnh Dũng Sports chuyên bán vợt cầu lông, phụ kiện cầu lông chính hãng và dịch vụ căng cước chuyên nghiệp.">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        :root {
            --primary: #69A84F;
            --primary-dark: #4F8538;
            --primary-light: #EAF4E5;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.7;
            color: #333;
        }

        .navbar {
            background: var(--primary);
            box-shadow: 0 2px 15px rgba(0, 0, 0, .08);
        }

        .navbar .nav-link {
            color: #fff !important;
            font-weight: 600;
            margin-left: 10px;
        }

        .navbar .nav-link:hover {
            opacity: .85;
        }

        .hero {
            min-height: 850px;

            background:
                linear-gradient(
                    rgba(105, 168, 79, .88),
                    rgba(79, 133, 56, .88)
                ),
                url('images/hero.jpg');

            background-size: cover;
            background-position: center;

            color: #fff;

            display: flex;
            align-items: center;
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: 700;
        }

        .hero p {
            max-width: 800px;
            margin: auto;
        }

        .btn-main {
            background: #fff;
            color: var(--primary);
            border: none;
            padding: 15px 35px;
            font-weight: 700;
        }

        .btn-main:hover {
            background: #f3f3f3;
            color: var(--primary-dark);
        }

        .section-title {
            font-weight: 700;
            margin-bottom: 50px;
            text-align: center;
        }

        .section-title::after {
            content: '';
            width: 100px;
            height: 4px;
            background: var(--primary);
            display: block;
            margin: 15px auto 0;
        }

        .feature-card {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,.08);
            height: 100%;
            transition: .3s;
        }

        .feature-card:hover {
            transform: translateY(-8px);
        }

        .feature-icon {
            font-size: 60px;
            color: var(--primary);
        }

        .stats {
            background: var(--primary);
            color: #fff;
        }

        .company-box {
            background: var(--primary-light);
            border-left: 6px solid var(--primary);
            padding: 30px;
            border-radius: 10px;
        }

        .cta-section {
            background: var(--primary);
            color: #fff;
        }

        .footer {
            background: var(--primary-dark);
            color: #fff;
        }

        @media(max-width:768px){

            .hero h1{
                font-size: 2.5rem;
            }

            .hero{
                min-height:650px;
            }

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
                 width="150"
                 class="d-inline-block align-text-top">

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
                    <a class="nav-link"
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

<section class="hero">

    <div class="container text-center">

        <span class="badge bg-light text-success px-3 py-2 mb-4">
            CÔNG TY TNHH MẠNH DŨNG SPORTS
        </span>

        <h1 class="mb-4">
            Shop Cầu Lông Chính Hãng
        </h1>

        <p class="lead mb-5">
            Chuyên cung cấp vợt cầu lông, giày cầu lông,
            phụ kiện cầu lông chính hãng cùng dịch vụ
            căng cước chuyên nghiệp.
        </p>

        <div class="d-flex justify-content-center gap-3 flex-wrap">

            <a href="products.php"
               class="btn btn-main btn-lg">

                Xem sản phẩm

            </a>

            <a href="stringing.php"
               class="btn btn-outline-light btn-lg">

                Bảng giá căng cước

            </a>

        </div>

    </div>

</section>

<section class="py-5">

    <div class="container">

        <h2 class="section-title">
            Vì Sao Chọn Mạnh Dũng Sports
        </h2>

        <div class="row g-4">

            <div class="col-lg-4">

                <div class="feature-card text-center">

                    <i class="bi bi-award-fill feature-icon"></i>

                    <h4 class="mt-3">
                        Hàng Chính Hãng
                    </h4>

                    <p>
                        Cam kết 100% sản phẩm chính hãng từ các thương hiệu uy tín.
                    </p>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="feature-card text-center">

                    <i class="bi bi-lightning-charge-fill feature-icon"></i>

                    <h4 class="mt-3">
                        Căng Cước Chuẩn
                    </h4>

                    <p>
                        Máy căng hiện đại, đảm bảo độ chính xác và độ bền của cước.
                    </p>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="feature-card text-center">

                    <i class="bi bi-headset feature-icon"></i>

                    <h4 class="mt-3">
                        Tư Vấn Tận Tâm
                    </h4>

                    <p>
                        Hỗ trợ lựa chọn vợt, giày và phụ kiện phù hợp với trình độ.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

<section class="stats py-5">

    <div class="container">

        <div class="row text-center">

            <div class="col-md-3">
                <h2 class="fw-bold">5000+</h2>
                <p>Khách Hàng</p>
            </div>

            <div class="col-md-3">
                <h2 class="fw-bold">3000+</h2>
                <p>Vợt Đã Căng</p>
            </div>

            <div class="col-md-3">
                <h2 class="fw-bold">1000+</h2>
                <p>Sản Phẩm</p>
            </div>

            <div class="col-md-3">
                <h2 class="fw-bold">5★</h2>
                <p>Đánh Giá</p>
            </div>

        </div>

    </div>

</section>

<section class="py-5">

    <div class="container">

        <h2 class="section-title">
            Thông Tin Doanh Nghiệp
        </h2>

        <div class="company-box">

            <h4 class="fw-bold mb-4">
                CÔNG TY TNHH MẠNH DŨNG SPORTS
            </h4>

            <p>
                <strong>Mã số thuế:</strong> 0901190162
            </p>

            <p>
                <strong>Địa chỉ SHOP:</strong><br>
                Số 72, phố Văn Giang,
                Xã Văn Giang,
                Tỉnh Hưng Yên,
                Việt Nam
            </p>

            <p>
                <strong>Có thể giao dịch trực tiếp tại:</strong><br>
                Tòa S1.12, Khu đô thị Vinhomes Ocean Park 1
            </p>

        </div>

    </div>

</section>

<section class="cta-section py-5">

    <div class="container text-center">

        <h2 class="fw-bold mb-3">
            Sẵn Sàng Mua Sắm Dụng Cụ Cầu Lông?
        </h2>

        <p class="mb-4">
            Hàng chính hãng - Giá tốt - Dịch vụ chuyên nghiệp
        </p>

        <a href="products.php"
           class="btn btn-light btn-lg">

            Khám Phá Sản Phẩm

        </a>

    </div>

</section>

<footer class="footer py-4">

    <div class="container text-center">

        © 2026 Mạnh Dũng Sports - All Rights Reserved

    </div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>