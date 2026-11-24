document.addEventListener("DOMContentLoaded", () => {
  const picker = document.getElementById("departDatePicker");
  if (!picker) return;

  const trigger = picker.querySelector(".datepicker-trigger");
  const displayEl = picker.querySelector(".datepicker-display");
  const hiddenInput = document.getElementById("departDateValue");
  const monthLabel = picker.querySelector(".dp-month-label");
  const daysContainer = picker.querySelector(".dp-days");
  const prevBtn = picker.querySelector(".dp-prev");
  const nextBtn = picker.querySelector(".dp-next");

  const now = new Date();
  const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());

  let viewYear = today.getFullYear();
  let viewMonth = today.getMonth(); // 0 - 11
  let selectedDate = null;

  function pad2(n) {
    return String(n).padStart(2, "0");
  }

  function toIsoDate(dateObj) {
    return `${dateObj.getFullYear()}-${pad2(dateObj.getMonth() + 1)}-${pad2(dateObj.getDate())}`;
  }

  function toDisplayDate(dateObj) {
    return `${pad2(dateObj.getDate())}/${pad2(dateObj.getMonth() + 1)}/${dateObj.getFullYear()}`;
  }

  function isSameDay(a, b) {
    return (
      a &&
      b &&
      a.getFullYear() === b.getFullYear() &&
      a.getMonth() === b.getMonth() &&
      a.getDate() === b.getDate()
    );
  }

  function renderCalendar() {
    monthLabel.textContent = `Tháng ${viewMonth + 1} - ${viewYear}`;

    // Không cho lùi về trước tháng hiện tại
    const isCurrentOrPastMonth =
      viewYear < today.getFullYear() ||
      (viewYear === today.getFullYear() && viewMonth <= today.getMonth());
    prevBtn.disabled = isCurrentOrPastMonth;

    const firstDayOfMonth = new Date(viewYear, viewMonth, 1);
    const totalDays = new Date(viewYear, viewMonth + 1, 0).getDate();

    // Thứ 2 = 0, ..., Chủ nhật = 6
    const startOffset = (firstDayOfMonth.getDay() + 6) % 7;

    let html = "";

    // Ô trống trước ngày mùng 1
    for (let i = 0; i < startOffset; i++) {
      html += `<span></span>`;
    }

    for (let day = 1; day <= totalDays; day++) {
      const currentDate = new Date(viewYear, viewMonth, day);
      const isPast = currentDate < today;
      const isToday = isSameDay(currentDate, today);
      const isSelected = isSameDay(currentDate, selectedDate);
      const isSunday = currentDate.getDay() === 0;

      const classes = ["dp-day"];
      if (isPast) classes.push("disabled");
      if (isToday) classes.push("today");
      if (isSelected) classes.push("selected");
      if (isSunday) classes.push("sunday");

      html += `
        <button
          type="button"
          class="${classes.join(" ")}"
          data-date="${toIsoDate(currentDate)}"
          ${isPast ? "disabled" : ""}
        >
          ${day}
        </button>
      `;
    }

    daysContainer.innerHTML = html;
  }

  trigger.addEventListener("click", (e) => {
    e.stopPropagation();
    const willOpen = !picker.classList.contains("open");

    document.querySelectorAll(".custom-select.open, .custom-datepicker.open").forEach((el) => {
      el.classList.remove("open");
    });

    if (willOpen) {
      picker.classList.add("open");
      renderCalendar();
    }
  });

  prevBtn.addEventListener("click", (e) => {
    e.stopPropagation();
    if (prevBtn.disabled) return;
    viewMonth--;
    if (viewMonth < 0) {
      viewMonth = 11;
      viewYear--;
    }
    renderCalendar();
  });

  nextBtn.addEventListener("click", (e) => {
    e.stopPropagation();
    viewMonth++;
    if (viewMonth > 11) {
      viewMonth = 0;
      viewYear++;
    }
    renderCalendar();
  });

  daysContainer.addEventListener("click", (e) => {
    const btn = e.target.closest(".dp-day:not(:disabled)");
    if (!btn) return;

    const [y, m, d] = btn.dataset.date.split("-").map(Number);
    selectedDate = new Date(y, m - 1, d);

    hiddenInput.value = btn.dataset.date;
    displayEl.textContent = toDisplayDate(selectedDate);

    renderCalendar();
    picker.classList.remove("open");
  });

  picker.querySelector(".datepicker-popup").addEventListener("click", (e) => {
    e.stopPropagation();
  });

  document.addEventListener("click", () => {
    picker.classList.remove("open");
  });

  renderCalendar();
});