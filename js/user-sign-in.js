document.addEventListener("DOMContentLoaded", function () {
  const container = document.querySelector(".user-sign-in-container");
  const loginContainer = document.querySelector(".form-box.login");
  const registerContainer = document.querySelector(".form-box.register");

  const loginLink = document.querySelector(".login-link");
  const registerLink = document.querySelector(".register-link");

  const btnPopup = document.querySelectorAll(".login-btn"); // Select all login buttons
  const btnClose = document.querySelectorAll(".icon-close");

  if (registerLink) {
    registerLink.addEventListener("click", () => {
      container.classList.add("active");
      loginContainer.classList.add("active");
      registerContainer.classList.add("active");

      loginContainer.classList.remove("deactivate");
      registerContainer.classList.remove("deactivate");
    });
  }

  if (loginLink) {
    loginLink.addEventListener("click", () => {
      container.classList.remove("active");
      loginContainer.classList.add("deactivate");
      registerContainer.classList.add("deactivate");

      loginContainer.classList.remove("active");
      registerContainer.classList.remove("active");
    });
  }

  // Fix: Apply event listeners to all login buttons
  btnPopup.forEach(button => {
    button.addEventListener("click", () => {
      container.classList.add("active-popup");
      container.classList.remove("remove-popup");
    });
  });

  // Fix: Ensure close buttons work properly
  btnClose.forEach(closeButton => {
    closeButton.addEventListener("click", () => {
      container.classList.add("remove-popup");
      container.classList.remove("active-popup");
    });
  });

  // Close popup on scroll
  window.addEventListener("scroll", () => {
    if (window.scrollY > 600) {
      container.classList.add("remove-popup");
      container.classList.remove("active-popup");
    }
  });
});
