document.addEventListener("DOMContentLoaded", () => {
  const track = document.getElementById("testimonialsTrack");
  const prevBtn = document.querySelector(".testi-prev");
  const nextBtn = document.querySelector(".testi-next");

  if (!track || !prevBtn || !nextBtn) return;

  function getStepWidth() {
    const firstCard = track.querySelector(".testimonial-card");
    if (!firstCard) return 320;
    const gap = parseFloat(getComputedStyle(track).columnGap) || 20;
    return firstCard.getBoundingClientRect().width + gap;
  }

  function updateButtons() {
    const maxScrollLeft = track.scrollWidth - track.clientWidth - 2;
    prevBtn.disabled = track.scrollLeft <= 2;
    nextBtn.disabled = maxScrollLeft <= 2 || track.scrollLeft >= maxScrollLeft;
  }

  prevBtn.addEventListener("click", () => {
    track.scrollBy({ left: -getStepWidth(), behavior: "smooth" });
  });

  nextBtn.addEventListener("click", () => {
    track.scrollBy({ left: getStepWidth(), behavior: "smooth" });
  });

  track.addEventListener("scroll", updateButtons, { passive: true });
  window.addEventListener("resize", updateButtons);

  updateButtons();
});