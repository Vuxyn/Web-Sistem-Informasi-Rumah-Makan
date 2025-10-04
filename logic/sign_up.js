// Sign Up JavaScript functionality

document.addEventListener('DOMContentLoaded', function() {
    const signUpForm = document.querySelector('form');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const passwordInput = document.querySelector('input[type="password"]');
    const signUpButton = document.querySelector('.btn-signup');

    // Form submission handler
    signUpForm.addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        const name = nameInput.value.trim();
        const email = emailInput.value.trim();
        const password = passwordInput.value;

        // Validate inputs
        if (!name) {
            alert('Please enter your name.');
            nameInput.focus();
            return;
        }

        if (!validateEmail(email)) {
            alert('Please enter a valid email address.');
            emailInput.focus();
            return;
        }

        if (password.length < 6) {
            alert('Password must be at least 6 characters long.');
            passwordInput.focus();
            return;
        }

        // Disable button during submission
        signUpButton.disabled = true;
        signUpButton.textContent = 'Signing up...';

        // Simulate sign up (replace with actual AJAX call)
        performSignUp(name, email, password);
    });

    // Email validation function
    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Perform sign up function (AJAX call to backend)
    function performSignUp(name, email, password) {
        fetch('src/sign_up_handler.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `name=${encodeURIComponent(name)}&email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Sign up successful! You can now log in.');
                window.location.href = 'login.php';
            } else {
                alert(data.message || 'Sign up failed. Please try again.');
            }
            signUpButton.disabled = false;
            signUpButton.textContent = 'Sign up';
        })
        .catch(() => {
            alert('An error occurred. Please try again later.');
            signUpButton.disabled = false;
            signUpButton.textContent = 'Sign up';
        });
    }

    // Optional: Add enter key support for password field
    passwordInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            signUpForm.dispatchEvent(new Event('submit'));
        }
    });
});
