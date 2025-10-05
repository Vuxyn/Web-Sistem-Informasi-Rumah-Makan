<!doctype HTML>
<html>
    <head>
        <title>
            Login Page RM
        </title>
        <link rel="stylesheet" href="../assets/css/login.css">
    </head>
<body>
    <div class="container">
        <p class="logo">Logo</p>
        
        <div class="footer">
            <img src="https://logodix.com/logo/498837.png" alt="Copyright" class="copyright-logo">
            <span>2025 Nama Kelompok</span>
        </div>

        <div class="left">
            <div class="login-card">
                <h1 class="header">Log In</h1>
                <p class="welcome-text">Selamat datang di Website Restoran Minang!</p>
                
                <form class="login-form">
                    <div class="input-wrapper">
                        <label for="email">Email*</label>
                        <input type="email" id="email" placeholder="Masukkan email" class="input-field">
                    </div>

                    <div class="input-wrapper">
                        <div class="label-row">
                            <label for="password">Password*</label>
                            <a href="#" class="forgot-password">Forgot Password?</a>
                        </div>
                        <input type="password" id="password" placeholder="Masukkan password" class="input-field">
                    </div>

                    <button class="login-button" type="submit">Log In</button>
                </form>

                <div class="divider">
                    <span>OR</span>
                </div>

                <button class="google-login-button">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" alt="Google" class="google-logo">
                    Login with Google
                </button>

                <p class="signup-text">
                    Don't have an account? <a href="sign_up.php" class="sign-up-link">Sign Up</a>
                </p>
            </div>
        </div>

        <div class="right">
            <div class="image-overlay"></div>
            <img src="https://www.rukita.co/stories/wp-content/uploads/2020/01/restoran-padang-terbaik-di-jakarta-1360x900.png" alt="Restaurant" class="login-image">
        </div>
    </div>

    <script src="../logic/login.js"></script>
</body>
</html>
