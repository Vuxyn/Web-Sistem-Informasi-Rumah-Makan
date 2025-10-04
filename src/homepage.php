<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="../assets/css/homepage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    
</head>
<body>
    <header class="header">
        <div class="logo">Logo</div>
        <nav class="nav">
            <a href="menu.php">Menu Utama</a>
            <a href="#">Promo Harian</a>
            <a href="#">Galeri</a>
            <a href="#">Kontak</a>
        </nav>
        <a class="btn" href="login.php">Login</a>
    </header>
    <main class="main">
        <section class="hero">
            <div class="hero-text">
                <h1>Rumah Makan Padang Sejahtera</h1>
                <p>Nikmati cita rasa Minang autentik di Rumah Makan Padang Sejahtera.
          Setiap hidangan disajikan dengan resep tradisional yang telah
          diwariskan turun-temurun.</p>
                <div class="hero-btn">
                    <a class="view-btn" href="menu.php">Lihat Menu</a>
                    <a class="order-btn" href="#">Pesan Sekarang</a>
                </div>
            </div>
            <div class="hero-img">
                <img src="../assets/img/Warung Kopi.jpg" alt="Hero Image">
            </div>
        </section>

        <section class="promo">
            <div class="promo-text">
                <p class="promoh">Promo</p>
                <h2>Nikmati Diskon Menarik Setiap Minggu</h2>
                <p>Dapatkan diskon 10% untuk Rendang setiap jumat dan jangan lewatkan kesempatan ini untuk menikmati hidangan favorit anda</p>
                <div class="promo-content">
                    <div class="promo-items">
                        <img src="../assets/img/Rendang.png" alt="Rendang icon" class="rendang">
                        <h3>Rendang spesial</h3>
                        <p>Rendang lezat dengan bumbu spesial, siap menggelitik lidah anda</p>
                    </div>
                    <div class="promo-items2">
                        <img src="../assets/img/" alt="Link icon">
                        <h3>Jangan Lewatkan</h3>
                        <p>Bergabunglah dengan kami, nikmati hidangan lezat setiap Jumat</p>
                    </div>
                </div>
                <div class="promo-btn">
                    <a href="#" class="view-btns">Lihat</a>
                    <a href="#" class="order-btns">Pesan ></a>
                </div>
            </div>
            <div class="promo-img">
                <img src="../assets/img/Promo-img.jpg" alt="Promo Image">
            </div>
        </section>
        
        <section class="gallery">
            <h2>Nikmati Beragam Menu Lezat yang Siap <br> Memanjakan Lidah Anda</h2>
            <div class="gallery-items">
                <div class="gallery-item">
                    <div class="gallery-img">
                        <img src="../assets/img/Gallery1.jpg" alt="Gallery Image 1">
                    </div>
                    <h2>Rasakan Cita Rasa Minang yang Autentik dan Menggugah Selera</h2>
                    <p>Kami menyajikan hidangan khas Padang dengan bahan berkualitas dan resep Tradisional</p>
                </div>
                <div class="gallery-item">
                    <div class="gallery-img">
                        <img src="../assets/img/Gallery2.jpg" alt="Gallery Image 2">
                    </div>
                    <h2>Promo Menarik Setiap Hari untuk Anda Nikmati</h2>
                    <p>Dapatkan diskon dan penawaran menarik setiap harinya</p>
                </div>
                <div class="gallery-item">
                    <div class="gallery-img">
                        <img src="../assets/img/Gallery3.jpg" alt="Gallery Image 3">
                    </div>
                    <h2>Galeri Makanan dan Suasana Restoran yang Menggoda</h2>
                    <p>Lihat koleksi foto kami yang menunjukan kelezatan hidangan dan suasana restoran</p>
                </div>
            </div>
        </section>

        <section id="contact">
            <div class="container contact-wrapper">
                <div class="contact-left">
                    <p class="hub-text">Hubungi</p>
                    <h2>Kontak Kami</h2>
                    <p>Kami siap membantu Anda dengan pertanyaan atau reservasi yang Anda butuhkan.</p>
                </div>
                <div class="contact-right">
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                        <h4>Email</h4>
                        <p>info@rumahmakanpadangsejahtera.com</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <div>
                        <h4>Telepon</h4>
                        <p>+62 812 3456 7890</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                        <h4>Alamat</h4>
                        <p>Jl. Raya Padang No. 123, Padang</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="map-container">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127643.07135189994!2d100.3347!3d-0.9471!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b9417db8df35%3A0x3039d80b220d7a0!2sPadang%2C%20Kota%20Padang%2C%20Sumatera%20Barat!5e0!3m2!1sen!2sid!4v1693470000000!5m2!1sen!2sid"
                    width="100%"
                    height=400"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
            </div>
        </section>


        <!-- Testimoni Pelanggan -->
        <section id="testimonials">
        <div class="container">
            <h2>Testimoni Pelanggan</h2>
            <p>Rasa yang luar biasa dan pelayanan yang cepat!</p>

            <div class="testimonial-grid" id="testimonial-list">
            <div class="testimonial-card placeholder">
                <p>⭐⭐⭐⭐⭐</p>
                <p>"Makanan di sini selalu memuaskan dan enak!"</p>
                <h4>Andi Setiawan</h4>
                <span>Konsumen, Jakarta</span>
            </div>

            <div class="testimonial-card placeholder">
                <p>⭐⭐⭐⭐⭐</p>
                <p>"Pelayanannya ramah dan suasananya nyaman."</p>
                <h4>Siti Amina</h4>
                <span>Pelanggan, Bekasi</span>
            </div>

            <div class="testimonial-card placeholder">
                <p>⭐⭐⭐⭐⭐</p>
                <p>"Menu yang bervariasi dan harga yang terjangkau."</p>
                <h4>Budi Hartono</h4>
                <span>Karyawan, Surabaya</span>
            </div>
            </div>
        </div>
        </section>


    </main>
    <footer>
  <div class="footer-container">
    <!-- Logo -->
    <div class="footer-logo">
      <h3>Logo</h3>
    </div>

    <!-- Menu -->
    <ul class="footer-menu">
      <li><a href="#">Home</a></li>
      <li><a href="#">Link 1</a></li>
      <li><a href="#">Link 2</a></li>
      <li><a href="#">Link 3</a></li>
      <li><a href="#">Link 4</a></li>
    </ul>

    <!-- Sosial Media -->
    <div class="footer-social">
      <a href="#"><i class="fab fa-facebook"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
      <a href="#"><i class="fab fa-youtube"></i></a>
    </div>
  </div>

  <!-- Bottom -->
  <div class="footer-bottom">
    <p>© 2025 Rumah Makan Sejahtera. All rights reserved.</p>
    <div class="footer-links">
      <a href="#">Kebijakan Privasi</a> | 
      <a href="#">Ketentuan Layanan</a>
    </div>
  </div>
</footer>

<script src="../logic/homepage.js"></script>
</body>
</html>
