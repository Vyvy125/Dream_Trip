<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<section class="hero-slide">
  <div class="hero-overlay"></div>

  <div class="hero-content">
    <h1 class="hero-title">
      Khám phá thế giới<br>
      <span>Cùng DREAMTRIP</span>
    </h1>
    <p class="hero-subtitle">Những hành trình tuyệt vời đang chờ bạn!</p>

    <!-- Thanh tìm kiếm tour -->
    <form class="search-bar" action="index.php" method="GET">
      <input type="hidden" name="controller" value="Explore">
      <input type="hidden" name="action" value="index">

      <div class="search-field custom-select" data-name="departure">
        <label><i class="fa-solid fa-location-dot"></i> Điểm khởi hành</label>
        <input type="hidden" name="departure" value="">

        <button type="button" class="custom-select-trigger">
          <span class="selected-text">Chọn nơi đi</span>
          <i class="fa-solid fa-chevron-down"></i>
        </button>

        <ul class="custom-select-dropdown"></ul>
      </div>

      <div class="search-divider"></div>

      <div class="search-field custom-select" data-name="destination">
        <label><i class="fa-solid fa-location-dot"></i> Điểm đến</label>
        <input type="hidden" name="destination" value="">

        <button type="button" class="custom-select-trigger">
          <span class="selected-text">Chọn điểm đến</span>
          <i class="fa-solid fa-chevron-down"></i>
        </button>

        <ul class="custom-select-dropdown"></ul>
      </div>

      <div class="search-divider"></div>

      <div class="search-field custom-datepicker" id="departDatePicker">
  <label><i class="fa-regular fa-calendar"></i> Ngày khởi hành</label>
  <input type="hidden" name="depart_date" id="departDateValue" value="">

  <button type="button" class="datepicker-trigger">
    <span class="datepicker-display">Chọn ngày</span>
    <i class="fa-solid fa-chevron-down"></i>
  </button>

  <div class="datepicker-popup">
    <div class="datepicker-header">
      <button type="button" class="dp-nav dp-prev" aria-label="Tháng trước">
        <i class="fa-solid fa-chevron-left"></i>
      </button>
      <div class="dp-month-pill">
        <span class="dp-month-label"></span>
      </div>
      <button type="button" class="dp-nav dp-next" aria-label="Tháng sau">
        <i class="fa-solid fa-chevron-right"></i>
      </button>
    </div>

    <div class="dp-weekdays">
      <span>Th 2</span>
      <span>Th 3</span>
      <span>Th 4</span>
      <span>Th 5</span>
      <span>Th 6</span>
      <span>Th 7</span>
      <span class="is-sunday">CN</span>
    </div>

    <div class="dp-days"></div>
  </div>
</div>

      <div class="search-divider"></div>

      <div class="search-field custom-select" data-name="guests">
        <label><i class="fa-solid fa-user-group"></i> Số lượng khách</label>
        <input type="hidden" name="guests" value="1">

        <button type="button" class="custom-select-trigger">
          <span class="selected-text">1 người</span>
          <i class="fa-solid fa-chevron-down"></i>
        </button>

        <ul class="custom-select-dropdown"></ul>
      </div>

      <button type="submit" class="btn-search-tour">
        <i class="fa-solid fa-magnifying-glass"></i>
        <span>Tìm kiếm tour</span>
      </button>
    </form>
  </div>
</section>

<?php
// Hàm phụ chọn icon phương tiện khớp với cột `vehicle` trong DB
function getVehicleIcon(string $vehicle): string {
  $v = mb_strtolower($vehicle, 'UTF-8');
  if (str_contains($v, 'máy bay')) return 'fa-solid fa-plane';
  if (str_contains($v, 'du thuyền') || str_contains($v, 'cano')) return 'fa-solid fa-ship';
  if (str_contains($v, 'tàu')) return 'fa-solid fa-train';
  return 'fa-solid fa-car';
}
?>

<section class="featured-tours-section">
  <div class="section-container">
    <!-- Tiêu đề mục -->
    <div class="section-header">
      <div class="section-heading-group">
        <span class="section-accent-line"></span>
        <h2 class="section-title">Tour nổi bật</h2>
        <p class="section-subtitle">Những tour du lịch được yêu thích nhất hiện nay</p>
      </div>

      <a href="index.php?controller=Explore&action=index" class="btn-view-more">
        <span>Xem thêm</span>
        <i class="fa-solid fa-chevron-right"></i>
      </a>
    </div>

    <!-- Lưới danh sách thẻ tour -->
    <div class="tour-grid">
      <?php if (!empty($featuredTours)): ?>
        <?php foreach ($featuredTours as $index => $tour): ?>
          <article class="tour-card">
            <div class="tour-card-thumb">
              <img
                src="public/images/tours/<?= htmlspecialchars($tour['image']) ?>"
                alt="<?= htmlspecialchars($tour['title']) ?>"
                loading="lazy"
              >

              <!-- Nhãn badge góc trái (tự gắn Hot / Khuyến mãi cho 2 tour đầu giống mẫu) -->
              <?php if ($index === 0): ?>
                <span class="tour-badge badge-hot">Hot</span>
              <?php elseif ($index === 1): ?>
                <span class="tour-badge badge-promo">Khuyến mãi</span>
              <?php endif; ?>

              <!-- Nút yêu thích góc phải -->
              <button type="button" class="btn-wishlist" aria-label="Yêu thích">
                <i class="fa-regular fa-heart"></i>
              </button>
            </div>

            <div class="tour-card-body">
              <h3 class="tour-card-title" title="<?= htmlspecialchars($tour['title']) ?>">
                <?= htmlspecialchars($tour['title']) ?>
              </h3>

              <div class="tour-card-meta">
                <span>
                  <i class="fa-regular fa-clock"></i>
                  <?= htmlspecialchars($tour['duration']) ?>
                </span>
                <span>
                  <i class="<?= getVehicleIcon($tour['vehicle']) ?>"></i>
                  <?= htmlspecialchars($tour['vehicle']) ?>
                </span>
              </div>

              <div class="tour-card-footer">
                <span class="tour-price">
                  <?= number_format((float)$tour['price'], 0, ',', '.') ?><u>đ</u>
                </span>

                <a
                  href="index.php?controller=Tour&action=detail&id=<?= (int)$tour['id'] ?>"
                  class="btn-book-now"
                >
                  <span>Đặt ngay</span>
                  <i class="fa-solid fa-arrow-right"></i>
                </a>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="empty-tours">Hiện chưa có tour nổi bật nào.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="promo-banner-section">
  <div class="section-container">
    <div class="promo-banner-box">
      <img
        src="public/images/banners/banner-deal.jpg"
        alt="Ưu đãi cực hấp dẫn giảm ngay 20% cho mọi tour"
        class="promo-banner-img"
      >

      <a
        href="index.php?controller=Explore&action=index"
        class="promo-book-btn"
      >
        <span>Đặt tour ngay</span>
        <i class="fa-solid fa-arrow-right"></i>
      </a>
    </div>
  </div>
</section>

<section class="popular-destinations-section">
  <div class="section-container">
    <div class="section-header">
      <div class="dest-heading-wrapper">
        <span class="dest-vertical-bar"></span>
        <div>
          <h2 class="section-title">Điểm đến nổi tiếng</h2>
          <p class="section-subtitle">Khám phá những địa điểm du lịch hấp dẫn nhất Việt Nam</p>
        </div>
      </div>

      <a href="index.php?controller=Explore&action=index" class="btn-view-more btn-view-more-blue">
        <span>Xem thêm</span>
        <i class="fa-solid fa-arrow-right"></i>
      </a>
    </div>

    <div class="destinations-carousel">
  <button type="button" class="dest-arrow dest-prev" aria-label="Địa điểm trước">
    <i class="fa-solid fa-chevron-left"></i>
  </button>

  <div class="destinations-track" id="destinationsTrack">
    <?php if (!empty($featuredDestinations)): ?>
      <?php foreach ($featuredDestinations as $dest): ?>
        <a
          href="index.php?controller=Explore&action=index&destination=<?= urlencode($dest['slug']) ?>"
          class="destination-card"
        >
          <img
            src="public/images/tours/<?= htmlspecialchars($dest['image']) ?>"
            alt="<?= htmlspecialchars($dest['name']) ?>"
            loading="lazy"
          >
          <div class="destination-overlay"></div>
          <div class="destination-label">
            <i class="fa-solid fa-location-dot"></i>
            <span><?= htmlspecialchars($dest['name']) ?></span>
          </div>
        </a>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="empty-tours">Hiện chưa có địa điểm nào.</p>
    <?php endif; ?>
  </div>

  <button type="button" class="dest-arrow dest-next" aria-label="Địa điểm tiếp theo">
    <i class="fa-solid fa-chevron-right"></i>
  </button>
</div>
  </div>
</section>

<section class="why-choose-section">
  <div class="section-container">
    <div class="why-choose-box">
      <div class="why-choose-overlay"></div>

      <div class="why-choose-content">
        <div class="why-choose-header">
          <h2>Tại sao nên chọn chúng tôi?</h2>
          <p>Cam kết mang lại hành trình tuyệt vời nhất cho bạn</p>
        </div>

        <div class="why-choose-grid">
          <div class="why-item">
            <div class="why-icon">
              <i class="fa-solid fa-shield-check"></i>
              <!-- Nếu bản FontAwesome của bạn chưa hiện shield-check thì dùng fa-circle-check bên dưới -->
            </div>
            <h3>Lịch trình đa dạng</h3>
            <p>Nhiều tour hấp dẫn</p>
          </div>

          <div class="why-item">
            <div class="why-icon">
              <i class="fa-solid fa-headset"></i>
            </div>
            <h3>Hỗ trợ 24/7</h3>
            <p>Tận tâm, nhanh chóng</p>
          </div>

          <div class="why-item">
            <div class="why-icon">
              <i class="fa-solid fa-certificate"></i>
              <span class="badge-percent">%</span>
            </div>
            <h3>Giá tốt nhất</h3>
            <p>Thị trường</p>
          </div>

          <div class="why-item">
            <div class="why-icon">
              <i class="fa-solid fa-thumbs-up"></i>
            </div>
            <h3>Trải nghiệm tuyệt vời</h3>
            <p>Cùng DREAMTRIP</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="testimonials-section">
  <div class="section-container">
    <div class="section-header">
      <div class="dest-heading-wrapper">
        <span class="dest-vertical-bar"></span>
        <div>
          <h2 class="section-title">Khách hàng nói gì về chúng tôi?</h2>
          <p class="section-subtitle">Hơn 10.000+ khách hàng đã tin tưởng và đồng hành cùng chúng tôi</p>
        </div>
      </div>

      <a href="index.php?controller=Review&action=index" class="btn-view-more btn-view-more-blue">
        <span>Xem thêm</span>
        <i class="fa-solid fa-arrow-right"></i>
      </a>
    </div>

    <div class="testimonials-carousel">
      <button type="button" class="testi-arrow testi-prev" aria-label="Đánh giá trước">
        <i class="fa-solid fa-chevron-left"></i>
      </button>

      <div class="testimonials-track" id="testimonialsTrack">
        <?php if (!empty($testimonials)): ?>
          <?php foreach ($testimonials as $item): ?>
            <?php $rating = max(1, min(5, (int)($item['rating'] ?? 5))); ?>
            <article class="testimonial-card">
              <img
                src="public/images/avatars/<?= htmlspecialchars($item['avatar']) ?>"
                alt="<?= htmlspecialchars($item['customer_name']) ?>"
                class="testimonial-avatar"
                loading="lazy"
              >

              <div class="testimonial-content">
                <blockquote class="testimonial-quote">
                  "<?= htmlspecialchars($item['comment']) ?>"
                </blockquote>

                <div class="testimonial-author"><?= htmlspecialchars($item['customer_name']) ?></div>

                <div class="testimonial-stars" aria-label="<?= $rating ?> trên 5 sao">
                  <?php for ($i = 1; $i <= 5; $i++): ?>
                    <i class="<?= $i <= $rating ? 'fa-solid' : 'fa-regular' ?> fa-star"></i>
                  <?php endfor; ?>
                </div>
              </div>
            </article>
          <?php endforeach; ?>
        <?php else: ?>
          <p class="empty-tours">Chưa có đánh giá nào từ khách hàng.</p>
        <?php endif; ?>
      </div>

      <button type="button" class="testi-arrow testi-next" aria-label="Đánh giá tiếp theo">
        <i class="fa-solid fa-chevron-right"></i>
      </button>
    </div>
  </div>
</section>

<section class="partners-section">
  <div class="section-container">
    <div class="section-header">
      <div class="dest-heading-wrapper">
        <span class="dest-vertical-bar"></span>
        <div>
          <h2 class="section-title">Đối tác chiến lược</h2>
          <p class="section-subtitle">Đồng hành cùng chúng tôi trên mọi hành trình</p>
        </div>
      </div>
    </div>

    <div class="partners-grid">
      <a href="index.php?controller=Explore&action=index" class="partner-card" title="Vietnam Airlines">
        <img src="public/images/partners/vietnam-airlines.png" alt="Vietnam Airlines" loading="lazy">
      </a>

      <a href="index.php?controller=Explore&action=index" class="partner-card" title="Bamboo Airways">
        <img src="public/images/partners/bamboo-airways.png" alt="Bamboo Airways" loading="lazy">
      </a>

      <a href="index.php?controller=Explore&action=index" class="partner-card" title="Vietjet Air">
        <img src="public/images/partners/vietjet-air.png" alt="Vietjet Air" loading="lazy">
      </a>

      <a href="index.php?controller=Explore&action=index" class="partner-card" title="Sabre">
        <img src="public/images/partners/sabre.png" alt="Sabre" loading="lazy">
      </a>

      <a href="index.php?controller=Explore&action=index" class="partner-card" title="Booking.com">
        <img src="public/images/partners/booking.png" alt="Booking.com" loading="lazy">
      </a>

      <a href="index.php?controller=Explore&action=index" class="partner-card" title="Expedia">
        <img src="public/images/partners/expedia.png" alt="Expedia" loading="lazy">
      </a>
    </div>
  </div>
</section>