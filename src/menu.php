<?php
require_once 'config.php';

// Query to get all menus
$sql = "SELECT * FROM menus WHERE status = 'tersedia' ORDER BY name";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$menus = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Rumah Makan Padang Sejahtera</title>
    <link rel="stylesheet" href="../assets/css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <div class="navbar">
        <div class="logo">Logo</div>
        <div class="links">
            <a href="homepage.php">Home</a>
            <a href="menu.php">Menu Utama</a>
            <a href="#">Promo Harian</a>
            <a href="#">Galeri</a>
            <button class="button">Login</button>
        </div>
    </div>

    <div class="menu-header">
        <h6>Our Menu</h6>
        <h2>Daftar Menu Kami</h2>
        <p>Nikmati hidangan lezat khas Minang kami dengan cita rasa autentik dan bahan berkualitas terbaik</p>
    </div>

    <div class="menu-grid">
        <?php foreach ($menus as $menu): ?>
        <div class="menu-item">
            <img src="https://via.placeholder.com/280x220/667eea/ffffff?text=<?php echo urlencode($menu['name']); ?>" alt="<?php echo htmlspecialchars($menu['name']); ?>" class="img">
            <div class="menu-item-content">
                <h3><?php echo htmlspecialchars($menu['name']); ?></h3>
                <p><?php echo htmlspecialchars(ucfirst($menu['category'])); ?></p>
                <div class="price">Rp. <?php echo number_format($menu['price'], 0, ',', '.'); ?></div>
                <button class="button">Tambahkan ke Keranjang</button>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="footer">
        <div class="footer-top">
            <div class="logo">Logo</div>
            <div class="menu-links">
                <a href="#">Home</a>
                <a href="#">Menu</a>
                <a href="#">Promo</a>
                <a href="#">Kontak</a>
            </div>
            <div class="footer-icons">
                <a href="https://www.facebook.com/"><i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://www.x.com/"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="https://www.linkedin.com/"><i class="fa-brands fa-linkedin"></i></a>
                <a href="https://www.youtube.com/"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>

        <div class="footer-bottom">
            <div>© 2025 Rumah Makan Sejahtera. All rights reserved</div>
            <div>
                <a href="#">Kebijakan Privasi</a>
                <a href="#">Syarat Layanan</a>
                <a href="#">Pengaturan Cookies</a>
            </div>
        </div>
    </div>

    <script src="../logic/menu.js"></script>
</body>
</html>