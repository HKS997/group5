(function () {
    'use strict';

    // Fetch the form element
    const form = document.querySelector('form');

    // Add event listener for form submission
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        // Validate form fields
        if (validateForm()) {
            this.submit();
        }
    });

    // Form validation function
    function validateForm() {
        const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');
        const roleInput = document.getElementById('role');

        let isValid = true;

        // Validate username field
        if (usernameInput.value.trim() === '') {
            usernameInput.classList.add('is-invalid');
            isValid = false;
        } else {
            usernameInput.classList.remove('is-invalid');
        }

        // Validate password field
        if (passwordInput.value.trim() === '') {
            passwordInput.classList.add('is-invalid');
            isValid = false;
        } else {
            passwordInput.classList.remove('is-invalid');
        }

        // Validate role field
        if (roleInput.value === '') {
            roleInput.classList.add('is-invalid');
            isValid = false;
        } else {
            roleInput.classList.remove('is-invalid');
        }

        return isValid;
    }
})();
