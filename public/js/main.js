document.addEventListener("DOMContentLoaded", () => {
  const scrollTopBtn = document.getElementById("scrollTopBtn");
  if (!scrollTopBtn) return;

  scrollTopBtn.addEventListener("click", () => {
    window.scrollTo({ top: 0, behavior: "smooth" });
  });
});