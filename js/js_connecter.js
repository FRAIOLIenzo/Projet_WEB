const button = document.querySelector(".btn_password");
button.addEventListener("click", (event) => {
  event.preventDefault();
});

const togglePasswordButton = document.querySelector(".btn_password");
const passwordInput = document.getElementById("password");

togglePasswordButton.addEventListener("click", function () {
  const type =
    passwordInput.getAttribute("type") === "password" ? "text" : "password";
  passwordInput.setAttribute("type", type);
  this.textContent = type === "password" ? "afficher" : "masquer";
});
