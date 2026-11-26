<footer class="site-footer">
  <div class="footer-container">
    <div class="footer-main">
      <!-- Cột 1: Brand -->
      <div class="footer-brand">
        <a href="index.php?controller=Home&action=index" class="footer-logo">
          <i class="fa-solid fa-paper-plane"></i>
          <span>DREAMTRIP</span>
        </a>
        <p class="footer-tagline">Cùng bạn khám phá thế giới</p>
      </div>

      <!-- Cột 2: Liên kết nhanh -->
      <div class="footer-col">
        <h3>Liên kết nhanh</h3>
        <ul>
          <li><a href="index.php?controller=Home&action=index">Trang chủ</a></li>
          <li><a href="index.php?controller=Explore&action=index">Tour du lịch</a></li>
          <li><a href="index.php?controller=Explore&action=index#destinations">Điểm đến</a></li>
        </ul>
      </div>

      <!-- Cột 3: Hỗ trợ khách hàng -->
      <div class="footer-col">
        <h3>Hỗ trợ khách hàng</h3>
        <ul>
          <li><a href="index.php?controller=Contact&action=index">Liên hệ</a></li>
          <li><a href="index.php?controller=Faq&action=index">FAQs</a></li>
          <li><a href="index.php?controller=Policy&action=privacy">Chính sách bảo mật</a></li>
        </ul>
      </div>

      <!-- Cột 4: Liên hệ -->
      <div class="footer-col">
        <h3>Liên hệ</h3>
        <ul class="footer-contact-list">
          <li>
            <i class="fa-solid fa-phone"></i>
            <span>0123 456 789</span>
          </li>
          <li>
            <i class="fa-solid fa-envelope"></i>
            <span>dreamtrip@gmail.com</span>
          </li>
          <li>
            <i class="fa-solid fa-location-dot"></i>
            <span>123 Nguyễn Văn Cừ, Quận 1, TP.HCM</span>
          </li>
        </ul>
      </div>

      <!-- Cột 5: Theo dõi chúng tôi -->
      <div class="footer-col footer-social-col">
        <h3>Theo dõi chúng tôi</h3>
        <div class="footer-socials">
          <a href="#" aria-label="Facebook" title="Facebook">
            <i class="fa-brands fa-facebook-f"></i>
          </a>
          <a href="#" aria-label="YouTube" title="YouTube">
            <i class="fa-brands fa-youtube"></i>
          </a>
          <a href="#" aria-label="Zalo" title="Zalo" class="social-zalo">
            <span>Zalo</span>
          </a>
          <a href="#" aria-label="TikTok" title="TikTok">
            <i class="fa-brands fa-tiktok"></i>
          </a>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <div class="footer-copyright">
        © <?= date('Y') ?> DREAMTRIP. All rights reserved.
      </div>
      <div class="footer-legal">
        <a href="index.php?controller=Policy&action=privacy">Chính sách bảo mật</a>
        <span>|</span>
        <a href="index.php?controller=Policy&action=terms">Điều khoản sử dụng</a>
      </div>
    </div>
  </div>

  <!-- Nút cuộn lên đầu trang -->
  <button type="button" class="scroll-top-btn" id="scrollTopBtn" aria-label="Lên đầu trang" title="Lên đầu trang">
    <i class="fa-solid fa-arrow-up"></i>
  </button>
</footer>