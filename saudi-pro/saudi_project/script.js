function updateDarkButtons() {
  const isDark = document.body.classList.contains("dark");
  const buttons = document.querySelectorAll(".dark-btn");

  buttons.forEach((btn) => {
    btn.innerText = isDark ? "الوضع النهاري" : "الوضع الليلي";
  });
}

function applySavedTheme() {
  const savedTheme = localStorage.getItem("theme");
  const shouldUseDark = savedTheme === "dark";

  document.body.classList.toggle("dark", shouldUseDark);
  updateDarkButtons();
}

function toggleDarkMode() {
  const isDarkNow = document.body.classList.toggle("dark");
  localStorage.setItem("theme", isDarkNow ? "dark" : "light");
  updateDarkButtons();
}

function toggleMode() {
  toggleDarkMode();
}

document.addEventListener("DOMContentLoaded", applySavedTheme);