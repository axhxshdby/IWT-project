document.addEventListener("DOMContentLoaded", () => {
    // Handle registration
    const registerForm = document.getElementById("registerForm");
    registerForm?.addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(registerForm);
        const response = await fetch("server.php?action=register", {
            method: "POST",
            body: formData
        });
        const result = await response.json();
        alert(result.message);
        if (result.success) registerForm.reset();
    });

    // Handle login
    const loginForm = document.getElementById("loginForm");
    loginForm?.addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(loginForm);
        const response = await fetch("server.php?action=login", {
            method: "POST",
            body: formData
        });
        const result = await response.json();
        alert(result.message);
        if (result.success) {
            localStorage.setItem("isLoggedIn", "true");
            window.location.href = "index.html";
        }
    });
});
