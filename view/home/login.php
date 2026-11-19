
<!-- view/home/login.php -->
<div class="login-container">
    <h2>Đăng Nhập</h2>
    <form action="index.php?controller=Auth&action=handleLogin" method="POST">
        <div class="form-group">
            <label>Tên đăng nhập: (Số điện thoại hoặc Email)</label>
            <input class="form-user" type="text" name="username" placeholder="Nhập tên đăng nhập" required>
        </div>

        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <div class="password-wrapper">
                <input type="password" class="form-password password" name="password" placeholder="Nhập mật khẩu" required>
                    <!-- Icon con mắt -->
                <div class="toggle-password">
                    <i class="fa-regular fa-eye-slash"></i>
                </div>
            </div>
        </div>

        <div class="form-group">
           <?php
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                if (!empty($_SESSION['login_error'])) {
                    echo '<p class="login-error" style="color: #d93025; text-align:center:">' . htmlspecialchars($_SESSION['login_error']) . '</p>';
                    unset($_SESSION['login_error']);
                }
            ?>
        </div>

        <div class="form-group">
            <div class="action-btn">
                <a href="index.php?controller=Auth&action=register" class="action-sign">Đăng kí</a>
            <button class="action-login" type="submit" name="btn_login">Đăng nhập</button>
            </div>
        </div>
    </form>
</div>

