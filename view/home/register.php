<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<div class="login-container">
    <h2>Đăng Kí</h2>

    <?php if (!empty($_SESSION['register_error'])): ?>
        <p class="login-error" style="color: #d93025;">
            <?= htmlspecialchars($_SESSION['register_error']) ?>
        </p>
        <?php unset($_SESSION['register_error']); ?>
    <?php endif; ?>

    <form action="index.php?controller=Auth&action=handleRegister" method="POST">
        <div class="form-group">
            <label for="fullname">Tên đăng nhập / Họ tên:</label>
            <input type="text" id="fullname" name="fullname" placeholder="Nhập tên đăng nhập hoặc họ tên" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Nhập email" required>
        </div>

        <div class="form-group">
            <label for="phone">Số điện thoại:</label>
            <input type="text" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
        </div>

        <div class="form-group">
            <label for="province">Tỉnh/Thành phố:</label>
            <input type="text" id="province" name="province" placeholder="Nhập tỉnh/thành phố" required>
        </div>

        <div class="form-group">
            <label for="district">Quận/Huyện:</label>
            <input type="text" id="district" name="district" placeholder="Nhập quận/huyện" required>
        </div>

        <div class="form-group">
            <label for="birthday">Ngày tháng năm sinh:</label>
            <input type="date" id="birthday" name="birthday" required>
        </div>

        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
        </div>

        <div class="form-group action-btn">
            <a href="index.php?controller=Auth&action=login" class="action-sign">Đăng nhập</a>
            <button class="action-login" type="submit" name="btn_register">Đăng kí</button>
        </div>
    </form>
</div>