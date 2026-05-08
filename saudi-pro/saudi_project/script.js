function toggleDarkMode() {
  document.body.classList.toggle("dark");

  let btn = document.querySelector(".dark-btn");

  if(document.body.classList.contains("dark")){
    btn.innerText = "الوضع النهاري";
  } else {
    btn.innerText = "الوضع الليلي";
  }
}