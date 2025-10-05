// Login JavaScript functionality

document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.querySelector('.login-form');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const loginButton = document.querySelector('.login-button');

    // Form submission handler
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        const email = emailInput.value.trim();
        const password = passwordInput.value;

        // Validate inputs
        if (!validateEmail(email)) {
            alert('Please enter a valid email address.');
            emailInput.focus();
            return;
        }

        if (!password) {
            alert('Please enter your password.');
            passwordInput.focus();
            return;
        }

        // Disable button during submission
        loginButton.disabled = true;
        loginButton.textContent = 'Logging in...';

        // Simulate login (replace with actual AJAX call)
        performLogin(email, password);
    });

    // Email validation function
    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Perform login function (AJAX call to backend)
    function performLogin(email, password) {
        fetch('login_handler.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Login successful!');
                if (data.role === 'admin') {
                    window.location.href = 'dashboard_admin.php';
                } else {
                    window.location.href = 'homepage.php';
                }
            } else {
                alert(data.message || 'Invalid email or password. Please try again.');
                loginButton.disabled = false;
                loginButton.textContent = 'Log In';
            }
        })
        .catch(() => {
            alert('An error occurred. Please try again later.');
            loginButton.disabled = false;
            loginButton.textContent = 'Log In';
        });
    }

    // Optional: Add enter key support for password field
    passwordInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            loginForm.dispatchEvent(new Event('submit'));
        }
    });
});
