<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

    <div class="header-slide">
        <div class="line-sp">
            <p>Liên hệ hỗ trợ: 1800 363 636</p>
        </div>

        <div class="line-address">
            <div class="address-list">
                <i class="address-icon fa-solid fa-location-dot"></i>
                <div class="list-city">
                    TP.Hồ Chí Minh
                    <i class="list-icon fa-solid fa-sort-down"></i>
                    <div class="city-gr invi">
                        <p class="gr-header">Chọn địa điểm khởi hành</p>
                        <p class="gr-drs">Hãy chọn để điểm khởi hành để Dream Trip gợi ý cho bạn những điểm đến khiến bạn phải ngạc nhiên</p>
                        <div class="gr-city">
                            <a href="">TP.Hồ Chí Minh</a>
                            <a href="">Hà Nội</a>
                            <a href="">Đà Nẵng</a>
                            <a href="">Cần Thơ</a>
                            <a href="">Nha Trang</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="address-langues">
                Tiếng Việt
                <div class="langues-gr">
                    <a href="">Tiếng Việt</a>
                    <a href="">Tiếng Anh</a>
                    <a href="">Tiếng Trung</a>
                </div>
            </div>
        </div>
    </div>

<!-- Navbar -->
    <div class="navbar ">
        <div class="container">
            <div class="col20 navbar-left">
                <a class="navbar-brand" href="index.php">✈️ DreamTrip</a>
                <div class="navbar-search">
                    <input class="input-search" placeholder="Tìm kiếm" type="text">
                </div>
            </div>

            <div class="col80 navbar-right">
                <div class="navbar-service">
                    <a href="">Tour trọn gói</a>
                    <a href="">Vé máy bay</a>
                    <a href="">Khách sạn</a>
                    <a href="">Combo du lịch</a>
                    <a href="">Dịch vụ khác</a>
                </div>

                <div class="navbar-user">
                    <?php if (!empty($_SESSION['user'])): ?>
                        <span class="user-fullname">
                            Xin chào, <?= htmlspecialchars($_SESSION['user']['fullname']) ?>
                        </span>
                        <a class="user-logout" href="index.php?controller=Auth&action=logout">
                            Đăng xuất
                        </a>
                    <?php else: ?>
                        <a class="user-login btn-login" href="index.php?controller=Auth&action=login">
                            Đăng nhập
                        </a>
                        <a class="user-sign btn-signin" href="index.php?controller=Auth&action=register">
                            Đăng ký
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>