<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<?php $old = $old ?? []; ?>

<div class="auth-page-wrapper">
  <div class="login-container">
    <h2>Đăng kí</h2>

    <?php if (!empty($error)): ?>
    <div class="auth-alert auth-alert-error">
        <i class="fa-solid fa-circle-exclamation"></i>
        <span><?= htmlspecialchars($error) ?></span>
    </div>
    <?php endif; ?>

    <form action="index.php?controller=Auth&action=handleRegister" method="POST">
      <div class="register-grid">
        <div class="form-group">
          <label for="fullname">Tên đăng nhập / Họ tên:</label>
          <input
            type="text"
            id="fullname"
            name="fullname"
            placeholder="Nhập tên đăng nhập hoặc họ tên"
            value="<?= htmlspecialchars($old['fullname'] ?? '') ?>"
            required
          >
        </div>

        <div class="form-group">
          <label for="email">Email:</label>
          <input
            type="email"
            id="email"
            name="email"
            placeholder="Nhập email"
            value="<?= htmlspecialchars($old['email'] ?? '') ?>"
            required
          >
        </div>

        <div class="form-group">
          <label for="phone">Số điện thoại:</label>
          <input
            type="text"
            id="phone"
            name="phone"
            placeholder="Nhập số điện thoại"
            value="<?= htmlspecialchars($old['phone'] ?? '') ?>"
            required
          >
        </div>

        <div class="form-group">
          <label for="birthday">Ngày tháng năm sinh:</label>
          <input
            type="date"
            id="birthday"
            name="birthday"
            value="<?= htmlspecialchars($old['birthday'] ?? '') ?>"
            required
          >
        </div>

        <div class="form-group">
          <label for="province">Tỉnh/Thành phố:</label>
          <input
            type="text"
            id="province"
            name="province"
            placeholder="Nhập tỉnh/thành phố"
            value="<?= htmlspecialchars($old['province'] ?? '') ?>"
            required
          >
        </div>

        <div class="form-group">
          <label for="district">Quận/Huyện:</label>
          <input
            type="text"
            id="district"
            name="district"
            placeholder="Nhập quận/huyện"
            value="<?= htmlspecialchars($old['district'] ?? '') ?>"
            required
          >
        </div>

        <div class="form-group full-width">
          <label for="password">Mật khẩu:</label>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="Nhập mật khẩu (tối thiểu 6 ký tự)"
            required
          >
        </div>

        <div class="form-group action-btn">
          <a href="index.php?controller=Auth&action=login" class="action-sign">Đăng nhập</a>
          <button class="action-login" type="submit" name="btn_register">Đăng kí</button>
        </div>
      </div>
    </form>
  </div>
</div>