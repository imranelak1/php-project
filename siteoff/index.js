document.addEventListener("DOMContentLoaded", function () {
    console.log("DOM fully loaded and parsed");

    // Check if forms are available
    const registerForm = $('.register-form'); // Wrap in jQuery
    const loginForm = $('.login-form'); // Wrap in jQuery
    if (registerForm.length && loginForm.length) {
        console.log("Forms are loaded");
    } else {
        console.error("Forms not found");
    }

    // Toggle between login and register forms
    $('.message a').click(function (event) {
        event.preventDefault(); // Prevent default anchor click behavior
        registerForm.toggle();  // Use jQuery toggle
        loginForm.toggle();      // Use jQuery toggle
    });
});
