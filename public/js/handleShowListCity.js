document.addEventListener("DOMContentLoaded", () => {
  const optionsByField = {
    departure: [
      { value: "all", label: "Tất cả" },
      { value: "hcm", label: "TP. Hồ Chí Minh" },
      { value: "hn", label: "Hà Nội" },
      { value: "dn", label: "Đà Nẵng" },
    ],
    destination: [
      { value: "all", label: "Tất cả" },
      { value: "thuy-si", label: "Thụy Sĩ" },
      { value: "da-lat", label: "Đà Lạt" },
      { value: "ha-long", label: "Hạ Long" },
      { value: "phu-quoc", label: "Phú Quốc" },
      { value: "sapa", label: "Sapa" },
    ],
    guests: [
      { value: "1", label: "1 người" },
      { value: "2", label: "2 người" },
      { value: "4", label: "4 người" },
      { value: "6+", label: "6+ người" },
    ],
  };

  const dropdowns = document.querySelectorAll(".custom-select");

  dropdowns.forEach((selectBox) => {
    const fieldName = selectBox.dataset.name || "departure";
    const items = optionsByField[fieldName] || optionsByField.departure;

    const trigger = selectBox.querySelector(".custom-select-trigger");
    const list = selectBox.querySelector(".custom-select-dropdown");
    const hiddenInput = selectBox.querySelector('input[type="hidden"]');
    const selectedText = selectBox.querySelector(".selected-text");

    if (!trigger || !list) return;

    list.innerHTML = items
      .map(
        (item) => `
          <li class="custom-option" data-value="${item.value}">
            <span class="pin-icon"></span>
            <span>${item.label}</span>
          </li>
        `
      )
      .join("");

    trigger.addEventListener("click", (e) => {
      e.stopPropagation();
      const isOpen = selectBox.classList.contains("open");

      document.querySelectorAll(".custom-select.open").forEach((el) => {
        el.classList.remove("open");
      });

      if (!isOpen) {
        selectBox.classList.add("open");
      }
    });

    list.addEventListener("click", (e) => {
      const option = e.target.closest(".custom-option");
      if (!option) return;

      const value = option.dataset.value;
      const label = option.querySelector("span:last-child").textContent;

      list.querySelectorAll(".custom-option").forEach((opt) => {
        opt.classList.remove("selected");
      });
      option.classList.add("selected");

      if (selectedText) selectedText.textContent = label;
      if (hiddenInput) hiddenInput.value = value;

      selectBox.classList.remove("open");
    });
  });

  document.addEventListener("click", () => {
    document.querySelectorAll(".custom-select.open").forEach((el) => {
      el.classList.remove("open");
    });
  });
});