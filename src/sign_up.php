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
        <p>Please fill the form below to create an account.</p>
        <form>
            <label for="name">Name*</label>
            <input type="text" placeholder="Name" id="name" required>
            <label for="email">Email*</label>
            <input type="email" placeholder="Email" id="email" required>
            <label for="password">Password*</label>
            <input type="password" placeholder="Password" required>
            <button type="submit" class="btn btn-signup">Sign up</button>
            <button type="button" class="btn btn-google">
                <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" alt="G">
                Sign up with Google
            </button>
        </form>
        <div class="login-text">Already have an account? <a href="login.php">Log In</a></div>
        <div class="footer">© 2025 NamaKelompok</div>
    </div>
</body>
</html>