<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<section class="explore-hero">
  <div class="explore-hero__inner">
    <div class="explore-hero__content">
      <div class="explore-hero__heading">
        <span class="explore-hero__rays" aria-hidden="true"></span>
        <h1 class="explore-hero__title">
          <span class="title-main">Khám phá thế giới</span>
          <span class="title-sub">theo cách của bạn</span>
        </h1>
        <span class="explore-hero__heart" aria-hidden="true">♡</span>
      </div>

      <p class="explore-hero__subtitle">
        Cùng DREAMTRIP bắt đầu hành trình mới ngay hôm nay!
      </p>

      <form class="explore-search-bar" action="index.php" method="GET">
        <input type="hidden" name="controller" value="Explore">
        <input type="hidden" name="action" value="index">

        <div class="explore-search-input-wrap">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input
            type="text"
            id="explore-search-input"
            name="keyword"
            class="explore-search__input"
            placeholder="Bạn muốn đi đâu?"
            autocomplete="off"
            >
        </div>

        <button type="submit" class="explore-search-btn">
          Tìm kiếm
        </button>
      </form>
    </div>
  </div>
</section>

<?php
$regions = [
  [
    'key'   => 'mien-bac',
    'label' => 'Miền Bắc',
    'icon'  => 'fa-solid fa-mountain-sun',
    'image' => 'public/images/tours/mien-bac.jpg',
  ],
  [
    'key'   => 'mien-trung',
    'label' => 'Miền Trung',
    'icon'  => 'fa-solid fa-landmark',
    'image' => 'public/images/tours/mien-trung.jpg',
  ],
  [
    'key'   => 'mien-nam',
    'label' => 'Miền Nam',
    'icon'  => 'fa-solid fa-umbrella-beach',
    'image' => 'public/images/tours/mien-nam.jpg',
  ],
];
$activeRegion = $_GET['region'] ?? '';
?>

<section class="region-explore-section">
  <div class="region-explore__inner">
    <div class="region-explore__header">
      <h2 class="region-explore__title">
        <i class="fa-solid fa-location-dot"></i>
        <span>Khám phá theo vùng miền</span>
      </h2>
    </div>

    <div class="region-grid">
      <?php foreach ($regions as $region): ?>
        <?php $isActive = ($activeRegion === $region['key']); ?>
        <a
          href="index.php?controller=Explore&action=index®ion=<?= urlencode($region['key']) ?>"
          class="region-card <?= $isActive ? 'is-active' : '' ?>"
        >
          <img
            src="<?= htmlspecialchars($region['image']) ?>"
            alt="<?= htmlspecialchars($region['label']) ?>"
            class="region-card__img"
            loading="lazy"
          >
          <div class="region-card__overlay"></div>

          <div class="region-card__badge">
            <span class="region-card__icon">
              <i class="<?= htmlspecialchars($region['icon']) ?>"></i>
            </span>
            <span class="region-card__name"><?= htmlspecialchars($region['label']) ?></span>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php
function extractDestinationLabel(string $title): string {
  $clean = preg_replace(
    '/^(Tour|Du lịch|Khám phá|Chinh phục|Hành trình|Cung đường|Tâm linh\s*&\s*biển đảo)\s+/iu',
    '',
    trim($title)
  );

  // Tách phần tên địa danh chính trước dấu '-' hoặc cụm dài
  $parts = preg_split('/\s*[-–—|]\s*/u', (string) $clean);
  $mainPart = trim($parts[0] ?? $clean);

  // Rút gọn một số cụm phổ biến để vừa đẹp 1 dòng như mẫu
  $replacements = [
    '/^kỳ quan\s+/iu'          => '',
    '/^thành phố ngàn hoa\s*/iu' => 'Đà Lạt',
    '/^đảo ngọc thiên đường\s*/iu' => 'Phú Quốc',
    '/^miền tây sông nước\s*/iu' => 'Miền Tây',
  ];
  $shortLabel = preg_replace(array_keys($replacements), array_values($replacements), $mainPart);

  // Lấy tối đa 2-3 từ đầu nếu vẫn dài
  $words = preg_split('/\s+/u', trim((string) $shortLabel));
  if (count($words) > 3) {
    $shortLabel = implode(' ', array_slice($words, 0, 2));
  }

  return $shortLabel !== '' ? $shortLabel : $title;
}

$suggestedTours = $suggestedTours ?? [];
?>

<section class="suggested-destinations-section">
  <div class="suggested-destinations__inner">
    <div class="suggested-destinations__header">
      <h2 class="suggested-destinations__title">
        <i class="fa-solid fa-star"></i>
        <span>Điểm đến dành cho bạn</span>
      </h2>

      <a
        href="index.php?controller=Explore&action=index&view=all"
        class="suggested-destinations__view-all"
      >
        <span>Xem tất cả</span>
        <i class="fa-solid fa-arrow-right"></i>
      </a>
    </div>

    <div class="suggested-grid">
      <?php foreach ($suggestedTours as $tour): ?>
        <?php
          $imgName = trim($tour['image'] ?? '');
          $imgSrc = $imgName !== ''
            ? 'public/images/tours/' . rawurlencode($imgName)
            : 'public/images/tours/halong.jpg';
          $shortName = extractDestinationLabel($tour['title'] ?? '');
        ?>
        <a
          href="index.php?controller=Tour&action=detail&id=<?= (int) ($tour['id'] ?? 0) ?>"
          class="suggested-card"
          title="<?= htmlspecialchars($tour['title'] ?? '') ?>"
        >
          <div class="suggested-card__thumb">
            <img
              src="<?= htmlspecialchars($imgSrc) ?>"
              alt="<?= htmlspecialchars($shortName) ?>"
              loading="lazy"
            >
          </div>

          <div class="suggested-card__label">
            <span><?= htmlspecialchars($shortName) ?></span>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php
$travelStyles = [
  [
    'key'   => 'bien',
    'label' => 'Du lịch biển',
    'icon'  => 'fa-solid fa-umbrella-beach',
    'color' => '#0ea5e9',
  ],
  [
    'key'   => 'nghi-duong',
    'label' => 'Nghỉ dưỡng',
    'icon'  => 'fa-solid fa-spa',
    'color' => '#ec4899',
  ],
  [
    'key'   => 'thien-nhien',
    'label' => 'Khám phá<br>thiên nhiên',
    'icon'  => 'fa-solid fa-mountain',
    'color' => '#0284c7',
  ],
  [
    'key'   => 'van-hoa',
    'label' => 'Du lịch văn hóa',
    'icon'  => 'fa-solid fa-landmark',
    'color' => '#d97706',
  ],
  [
    'key'   => 'gia-dinh',
    'label' => 'Du lịch<br>cùng gia đình',
    'icon'  => 'fa-solid fa-people-group',
    'color' => '#f59e0b',
  ],
  [
    'key'   => 'check-in',
    'label' => 'Check-in sống ảo',
    'icon'  => 'fa-solid fa-camera',
    'color' => '#1e3a8a',
  ],
];
$activeStyle =$_GET['style'] ?? '';
?>

<section class="interest-explore-section">
  <div class="interest-explore__inner">
    <div class="interest-explore__left">
      <h2 class="interest-explore__title">
        <i class="fa-solid fa-compass"></i>
        <span>Khám phá theo sở thích</span>
      </h2>

      <div class="interest-list">
        <?php foreach ($travelStyles as$item): ?>
          <?php $isActive = ($activeStyle ===$item['key']); ?>
          <a
            href="index.php?controller=Explore&action=index&style=<?= urlencode($item['key']) ?>"
            class="interest-item <?= $isActive ? 'is-active' : '' ?>"
          >
            <span class="interest-item__circle" style="--icon-color: <?= htmlspecialchars($item['color']) ?>;">
              <i class="<?= htmlspecialchars($item['icon']) ?>"></i>
            </span>
            <span class="interest-item__label"><?= $item['label'] ?></span>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<?php
function formatShortDuration(string $duration): string {
  $lower = mb_strtolower(trim($duration), 'UTF-8');
  if (preg_match('/(\d+)\s*ngày?\s*(\d+)\s*đêm?/u', $lower, $m)) {
    return $m[1] . 'N' . $m[2] . 'Đ';
  }
  return $duration;
}

$popularTours = $popularTours ?? [];
?>

<section class="popular-tours-section">
  <div class="popular-tours__inner">
    <div class="popular-tours__header">
      <h2 class="popular-tours__title">
        <i class="fa-solid fa-fire"></i>
        <span>Tour được yêu thích</span>
      </h2>

      <a
        href="index.php?controller=Explore&action=index&view=all"
        class="popular-tours__view-all"
      >
        <span>Xem tất cả</span>
        <i class="fa-solid fa-arrow-right"></i>
      </a>
    </div>

    <div class="popular-tours-grid">
      <?php foreach ($popularTours as $tour): ?>
        <?php
          $imgName = trim($tour['image'] ?? '');
          $imgSrc = $imgName !== ''
            ? 'public/images/tours/' . rawurlencode($imgName)
            : 'public/images/tours/halong.jpg';
          $shortDuration = formatShortDuration($tour['duration'] ?? '');
          $priceFormatted = number_format((float) ($tour['price'] ?? 0), 0, ',', '.') . 'đ';
        ?>
        <a
          href="index.php?controller=Tour&action=detail&id=<?= (int) ($tour['id'] ?? 0) ?>"
          class="popular-tour-card"
        >
          <div class="popular-tour-card__thumb">
            <img
              src="<?= htmlspecialchars($imgSrc) ?>"
              alt="<?= htmlspecialchars($tour['title'] ?? '') ?>"
              loading="lazy"
            >
          </div>

          <div class="popular-tour-card__body">
            <div class="popular-tour-card__info">
              <h3 class="popular-tour-card__title">
                <?= htmlspecialchars($tour['title'] ?? '') ?>
              </h3>

              <div class="popular-tour-card__meta">
                <i class="fa-regular fa-clock"></i>
                <span><?= htmlspecialchars($shortDuration) ?></span>
              </div>

              <div class="popular-tour-card__price">
                <?= htmlspecialchars($priceFormatted) ?>
              </div>
            </div>

            <span class="popular-tour-card__arrow" aria-hidden="true">
              <i class="fa-solid fa-arrow-right"></i>
            </span>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="trip-suggest-section">
  <div class="trip-suggest__inner">
    <div class="trip-suggest__header">
      <h2 class="trip-suggest__title">
        <i class="fa-regular fa-lightbulb"></i>
        <span>Gợi ý chuyến đi</span>
      </h2>
    </div>

    <div class="trip-suggest__banner">
      <div class="trip-suggest__left">
        <h3 class="trip-suggest__headline">
          <span>Bạn chưa biết</span>
          <span>đi đâu?</span>
          <i class="fa-regular fa-heart" aria-hidden="true"></i>
        </h3>

        <p class="trip-suggest__desc">
          Để DREAMTRIP gợi ý<br>
          hành trình phù hợp nhất nhé!
        </p>

        <a
          href="index.php?controller=Schedule&action=index"
          class="trip-suggest__cta"
        >
          <span>Nhận gợi ý ngay</span>
          <i class="fa-solid fa-arrow-right"></i>
        </a>
      </div>

      <div class="trip-suggest__right">
        <ul class="trip-suggest__perks">
          <li>
            <i class="fa-solid fa-circle-check"></i>
            <span>Tour phù hợp với ngân sách</span>
          </li>
          <li>
            <i class="fa-solid fa-circle-check"></i>
            <span>Điểm đến lý tưởng theo sở thích</span>
          </li>
          <li>
            <i class="fa-solid fa-circle-check"></i>
            <span>Lịch trình linh hoạt</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section class="next-trip-cta-section">
  <div class="next-trip-cta__inner">
    <div class="next-trip-cta__banner">
      <div class="next-trip-cta__content">
        <h2 class="next-trip-cta__title">
          Sẵn sàng cho chuyến đi tiếp theo?
        </h2>

        <p class="next-trip-cta__subtitle">
          Cùng DREAMTRIP khám phá thêm nhiều điểm đến tuyệt vời khác!
        </p>

        <a
            href="#explore-search-input"
            id="scroll-to-search-btn"
            class="next-trip-cta__btn"
            >
            <span>Khám phá ngay</span>
            <i class="fa-solid fa-arrow-right"></i>
        </a>
      </div>
    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const ctaBtn = document.getElementById('scroll-to-search-btn');
  const searchInput = document.getElementById('explore-search-input');

  if (!ctaBtn || !searchInput) return;

  ctaBtn.addEventListener('click', function (e) {
    e.preventDefault();

    // Cuộn lên vị trí thanh tìm kiếm có chừa khoảng trống cho header cố định
    const headerOffset = 96;
    const targetY =
      searchInput.getBoundingClientRect().top + window.scrollY - headerOffset;

    window.scrollTo({
      top: Math.max(0, targetY),
      behavior: 'smooth'
    });

    // Chờ cuộn gần xong rồi focus vào input (preventScroll tránh giật khung hình)
    setTimeout(function () {
      searchInput.focus({ preventScroll: true });
    }, 450);
  });
});
</script>