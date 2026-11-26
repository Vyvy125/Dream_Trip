<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<?php
$currentController = $_GET['controller'] ?? 'Home';
$currentAction     = $_GET['action'] ?? 'index';

if (!function_exists('isActiveNav')) {
  function isActiveNav(string $ctrl, string $act = 'index'): string {
    global $currentController, $currentAction;
    return (strcasecmp($currentController, $ctrl) === 0 && strcasecmp($currentAction, $act) === 0)
      ? 'active'
      : '';
  }
}

$navItems = [
  ['ctrl' => 'Home',     'act' => 'index', 'label' => 'Trang chủ',  'icon' => 'fa-solid fa-house'],
  ['ctrl' => 'Explore',  'act' => 'index', 'label' => 'Khám phá',   'icon' => 'fa-solid fa-compass'],
  ['ctrl' => 'Schedule', 'act' => 'index', 'label' => 'Lịch trình', 'icon' => 'fa-regular fa-calendar'],
  ['ctrl' => 'News',     'act' => 'index', 'label' => 'Tin tức',    'icon' => 'fa-regular fa-newspaper'],
  ['ctrl' => 'Review',   'act' => 'index', 'label' => 'Đánh giá',   'icon' => 'fa-regular fa-star'],
];
?>

<header class="site-header">
  <div class="header-inner">
    <!-- Logo -->
    <a class="brand-logo" href="index.php?controller=Home&action=index">
      <i class="fa-solid fa-paper-plane"></i>
      <span>DREAMTRIP</span>
    </a>

    <!-- Menu giữa (icon trên + chữ dưới + gạch chân active) -->
    <nav class="nav-menu">
      <?php foreach ($navItems as $item): ?>
        <?php $activeClass = isActiveNav($item['ctrl'], $item['act']); ?>
        <a
          class="nav-link <?= $activeClass ?>"
          href="index.php?controller=<?= urlencode($item['ctrl']) ?>&action=<?= urlencode($item['act']) ?>"
        >
          <i class="<?= htmlspecialchars($item['icon']) ?>"></i>
          <span><?= htmlspecialchars($item['label']) ?></span>
        </a>
      <?php endforeach; ?>
    </nav>

    <!-- Khu vực tài khoản bên phải -->
    <div class="nav-auth">
      <div class="nav-auth">
        <?php
          $currentUserName = $_SESSION['user']['fullname'] ?? $_SESSION['user_name'] ?? '';
        ?>
        <?php if (!empty($currentUserName)): ?>
          <span class="user-greeting">
            Xin chào, <?= htmlspecialchars($currentUserName) ?>
          </span>
          <a class="auth-btn btn-outline" href="index.php?controller=Auth&action=logout">
            Đăng xuất
          </a>
        <?php else: ?>
          <!-- giữ nguyên nút Đăng nhập / Đăng ký của bạn ở dưới -->
        <a class="auth-btn btn-ghost" href="index.php?controller=Auth&action=login">
          Đăng nhập
        </a>
        <a class="auth-btn btn-primary" href="index.php?controller=Auth&action=register">
          Đăng ký
        </a>
      <?php endif; ?>
    </div>
  </div>
</header>