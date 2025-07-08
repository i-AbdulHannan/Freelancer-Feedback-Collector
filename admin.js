
// Handles admin login and redirects to submit.html
const ADMIN_USERNAME = "admin";
const ADMIN_PASSWORD = "123456";

document.addEventListener("DOMContentLoaded", () => {
  const loginForm = document.getElementById("loginForm");
  if (!loginForm) return;

  loginForm.addEventListener("submit", (e) => {
    e.preventDefault();
    
    const formData = new FormData(loginForm);
    const username = formData.get("username"); // case matches HTML
    const password = formData.get("password");

    if (username === ADMIN_USERNAME && password === ADMIN_PASSWORD) {
      localStorage.setItem("admin_logged_in", "true");
      window.location.href = "submit.html"; //  Redirects to testimonials
    } else {
      alert("Invalid credentials. Try again.");
    }
  });
});