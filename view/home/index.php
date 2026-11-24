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