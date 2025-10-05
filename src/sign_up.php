<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="../assets/css/sign_up.css">
</head>
<body>
    <div class="container">
        <div class="logo">Logo</div>
        <h2>Sign Up</h2>
        <p>Create your account to get started</p>
        <form method="post">
            <div class="input-wrapper">
                <label for="name">Name*</label>
                <input type="text" placeholder="Enter your full name" id="name" required>
            </div>
            <div class="input-wrapper">
                <label for="email">Email*</label>
                <input type="email" placeholder="Enter your email" id="email" required>
            </div>
            <div class="input-wrapper">
                <label for="password">Password*</label>
                <input type="password" id="password" placeholder="Create a password" required>
            </div>
            <button type="submit" class="btn btn-signup">Sign up</button>
            
            <div class="divider">
                <span>OR</span>
            </div>
            
            <button type="button" class="btn btn-google">
                <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" alt="Google">
                Sign up with Google
            </button>
        </form>
        <div class="login-text">Already have an account? <a href="login.php">Log In</a></div>
        <div class="footer">© 2025 NamaKelompok</div>
    </div>
    <script src="../logic/sign_up.js"></script>
</body>
</html>