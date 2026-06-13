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


.string-section{
background:#f5f7fa;
padding:80px 0;
}

.string-title{
text-align:center;
font-size:42px;
font-weight:700;
color:#69A84F;
margin-bottom:50px;
}

.notice-box{
background:#fff;
border-radius:20px;
padding:25px 30px;
display:flex;
align-items:center;
gap:20px;
margin-bottom:50px;
box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.notice-icon{
width:60px;
height:60px;
background:#69A84F;
border-radius:15px;
display:flex;
align-items:center;
justify-content:center;
color:#fff;
font-size:30px;
font-weight:700;
flex-shrink:0;
}

.notice-content{
font-size:20px;
line-height:1.6;
}

.notice-content span{
color:#e60000;
font-weight:700;
}

.string-list{
display:flex;
flex-direction:column;
gap:18px;
}

.string-item{
background:#fff;
border-radius:14px;
padding:22px 24px;
display:flex;
justify-content:space-between;
align-items:center;
box-shadow:
0 3px 10px rgba(0,0,0,.08),
0 10px 25px rgba(0,0,0,.05);
transition:.25s;
}

.string-item:hover{
transform:translateY(-3px);
}

.string-item span{
color:#222;
font-size:18px;
font-weight:500;
}

.string-item strong{
color:#e60000;
font-size:20px;
font-weight:700;
white-space:nowrap;
}

@media(max-width:768px){
.string-title{
    font-size:30px;
}

.notice-box{
    flex-direction:column;
    text-align:center;
}

.notice-content{
    font-size:16px;
}

.string-item{
    padding:16px;
}

.string-item span{
    font-size:14px;
}

.string-item strong{
    font-size:16px;
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
                <li class="nav-item">
                    <a class="nav-link"
                      href="recruitment.php">
                        Tuyển dụng
                    </a>
                </li>
            </ul>

        </div>

    </div>

</nav>

<section class="string-section">
<div class="container">

    <h2 class="string-title">
        Bảng Giá Căng Cước Vợt Cầu Lông
    </h2>

    <div class="notice-box">

        <div class="notice-icon">
            ✓
        </div>

        <div class="notice-content">
            Căng xong – Nếu đứt trong 3 ngày đầu, các bác chụp ảnh lại trước khi cắt,
            mang ra shop <span>được căng lại miễn phí.</span>
        </div>

    </div>

    <div class="row g-4">

        <div class="col-lg-4">

            <div class="string-list">

                <div class="string-item">
                    <span>★ Học sinh</span>
                    <strong>80.000 ₫</strong>
                </div>

                <div class="string-item">
                    <span>★ Gosen Ryzonic 58</span>
                    <strong>140.000 ₫</strong>
                </div>

                <div class="string-item">
                    <span>★ Cước Gosen 65 Xanh Chuối</span>
                    <strong>140.000 ₫</strong>
                </div>

                <div class="string-item">
                    <span>★ Gosen Ryzonic 65 - Cam</span>
                    <strong>140.000 ₫</strong>
                </div>

                <div class="string-item">
                    <span>★ Yonex BG 65</span>
                    <strong>140.000 ₫</strong>
                </div>

                <div class="string-item">
                    <span>★ Yonex BG 65 Ti - Đỏ</span>
                    <strong>150.000 ₫</strong>
                </div>

                <div class="string-item">
                    <span>★ Cước cuộn 65 Ti - Trắng</span>
                    <strong>150.000 ₫</strong>
                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="string-list">

                <div class="string-item">
                    <span>★ Cước Gosen 69 - Trắng</span>
                    <strong>150.000 ₫</strong>
                </div>

                <div class="string-item">
                    <span>★ Kizuna Z69T</span>
                    <strong>160.000 ₫</strong>
                </div>

                <div class="string-item">
                    <span>★ Kizuna Z61S</span>
                    <strong>170.000 ₫</strong>
                </div>

                <div class="string-item">
                    <span>★ Yonex BG 66 Ultimax</span>
                    <strong>180.000 ₫</strong>
                </div>

                <div class="string-item">
                    <span>★ Kizuna Z61S Vỉ</span>
                    <strong>180.000 ₫</strong>
                </div>

                <div class="string-item">
                    <span>★ Yonex Nanogy 95</span>
                    <strong>190.000 ₫</strong>
                </div>

                <div class="string-item">
                    <span>★ Yonex Exbolt 63</span>
                    <strong>190.000 ₫</strong>
                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="string-list">

                <div class="string-item">
                    <span>★ Yonex Nanogy 98</span>
                    <strong>190.000 ₫</strong>
                </div>

                <div class="string-item">
                    <span>★ Exbolt 68</span>
                    <strong>190.000 ₫</strong>
                </div>

                <div class="string-item">
                    <span>★ Exbolt 65</span>
                    <strong>190.000 ₫</strong>
                </div>

                <div class="string-item">
                    <span>★ Kizuna Z58</span>
                    <strong>190.000 ₫</strong>
                </div>

                <div class="string-item">
                    <span>★ Yonex BG Aerobite</span>
                    <strong>200.000 ₫</strong>
                </div>

                <div class="string-item">
                    <span>★ Cước Vỉ 80 Power</span>
                    <strong>220.000 ₫</strong>
                </div>

                <div class="string-item">
                    <span>★ Cước Vỉ Nanogy 95</span>
                    <strong>220.000 ₫</strong>
                </div>

            </div>

        </div>

    </div>

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