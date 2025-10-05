<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - Rumah Makan Padang Sejahtera</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', sans-serif;
    color: #1a1a1a;
    background: #ffffff;
    line-height: 1.6;
    overflow-x: hidden;
}

/* Header */
.header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 60px;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    box-shadow: 0 2px 20px rgba(0, 0, 0, 0.05);
    z-index: 1000;
    transition: all 0.3s ease;
}

.logo {
    font-weight: 800;
    font-size: 24px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    letter-spacing: -0.5px;
}

.nav {
    display: flex;
    gap: 35px;
}

.nav a {
    color: #374151;
    text-decoration: none;
    font-weight: 500;
    font-size: 15px;
    transition: all 0.3s ease;
    position: relative;
}

.nav a::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 0;
    height: 2px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    transition: width 0.3s ease;
}

.nav a:hover {
    color: #667eea;
}

.nav a:hover::after {
    width: 100%;
}

.btn {
    text-decoration: none;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 10px 28px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
}

/* Hero Section */
.hero {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 140px 60px 100px;
    min-height: 90vh;
    background: linear-gradient(135deg, #f8f9ff 0%, #faf5ff 100%);
    position: relative;
    overflow: hidden;
}

.hero::before {
    content: '';
    position: absolute;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(102, 126, 234, 0.1) 0%, transparent 70%);
    top: -200px;
    right: -200px;
    border-radius: 50%;
}

.hero-text {
    flex: 0 0 50%;
    z-index: 1;
    animation: fadeInLeft 1s ease-out;
}

@keyframes fadeInLeft {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.hero-text h1 {
    font-size: 56px;
    font-weight: 900;
    line-height: 1.2;
    margin-bottom: 20px;
    color: #1a1a1a;
    letter-spacing: -2px;
}

.hero-text p {
    font-size: 18px;
    color: #6b7280;
    margin-bottom: 40px;
    line-height: 1.8;
    max-width: 550px;
}

.hero-btn {
    display: flex;
    gap: 15px;
}

.view-btn {
    text-decoration: none;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 16px 32px;
    color: white;
    border-radius: 12px;
    font-weight: 600;
    font-size: 16px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.view-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
}

.order-btn {
    text-decoration: none;
    background: white;
    padding: 16px 32px;
    color: #667eea;
    border: 2px solid #667eea;
    border-radius: 12px;
    font-weight: 600;
    font-size: 16px;
    transition: all 0.3s ease;
}

.order-btn:hover {
    background: #667eea;
    color: white;
    transform: translateY(-3px);
}

.hero-img {
    flex: 0 0 45%;
    position: relative;
    z-index: 1;
    animation: fadeInRight 1s ease-out;
}

@keyframes fadeInRight {
    from {
        opacity: 0;
        transform: translateX(50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.hero-img img {
    width: 100%;
    height: 500px;
    object-fit: cover;
    border-radius: 24px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
}

/* Promo Section */
.promo {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 100px 60px;
    background: white;
}

.promo-text {
    flex: 0 0 50%;
}

.promoh {
    font-weight: 700;
    font-size: 14px;
    color: #667eea;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 15px;
}

.promo-text h2 {
    font-size: 42px;
    font-weight: 800;
    margin-bottom: 20px;
    line-height: 1.3;
    color: #1a1a1a;
    letter-spacing: -1px;
}

.promo-text > p {
    font-size: 16px;
    color: #6b7280;
    margin-bottom: 40px;
    line-height: 1.8;
}

.promo-content {
    display: flex;
    gap: 25px;
    margin-bottom: 40px;
}

.promo-items,
.promo-items2 {
    flex: 1;
    background: linear-gradient(135deg, #f8f9ff 0%, #faf5ff 100%);
    padding: 30px;
    border-radius: 16px;
    transition: all 0.3s ease;
}

.promo-items:hover,
.promo-items2:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.15);
}

.promo-items h3,
.promo-items2 h3 {
    font-size: 20px;
    margin: 20px 0 10px;
    color: #1a1a1a;
}

.promo-items p,
.promo-items2 p {
    font-size: 14px;
    color: #6b7280;
    line-height: 1.6;
}

.rendang {
    width: 50px;
    height: 50px;
}

.promo-btn {
    display: flex;
    gap: 15px;
}

.view-btns {
    text-decoration: none;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 14px 28px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 15px;
    transition: all 0.3s ease;
}

.view-btns:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
}

.order-btns {
    text-decoration: none;
    background: white;
    padding: 14px 28px;
    color: #667eea;
    border-radius: 12px;
    font-weight: 600;
    font-size: 15px;
    transition: all 0.3s ease;
}

.order-btns:hover {
    background: #f8f9ff;
}

.promo-img {
    flex: 0 0 45%;
}

.promo-img img {
    width: 100%;
    height: 550px;
    object-fit: cover;
    border-radius: 24px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
}

/* Gallery Section */
.gallery {
    padding: 100px 60px;
    text-align: center;
    background: linear-gradient(135deg, #f8f9ff 0%, #faf5ff 100%);
}

.gallery h2 {
    font-size: 42px;
    font-weight: 800;
    margin-bottom: 60px;
    line-height: 1.4;
    color: #1a1a1a;
    letter-spacing: -1px;
}

.gallery-items {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    margin-top: 40px;
}

.gallery-item {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

.gallery-item:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
}

.gallery-img {
    height: 280px;
    overflow: hidden;
}

.gallery-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.gallery-item:hover .gallery-img img {
    transform: scale(1.1);
}

.gallery-item h2 {
    font-size: 20px;
    font-weight: 700;
    padding: 25px 25px 10px;
    text-align: left;
    line-height: 1.4;
}

.gallery-item p {
    font-size: 14px;
    color: #6b7280;
    padding: 0 25px 25px;
    text-align: left;
    line-height: 1.6;
}

/* Contact Section */
#contact {
    padding: 100px 60px;
    background: white;
}

.contact-wrapper {
    display: flex;
    justify-content: space-between;
    gap: 60px;
    margin-bottom: 60px;
}

.contact-left {
    flex: 1;
}

.hub-text {
    font-weight: 700;
    font-size: 14px;
    color: #667eea;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 15px;
}

.contact-left h2 {
    font-size: 42px;
    font-weight: 800;
    margin-bottom: 20px;
    color: #1a1a1a;
    letter-spacing: -1px;
}

.contact-left > p {
    font-size: 16px;
    color: #6b7280;
    line-height: 1.8;
}

.contact-right {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 20px;
    padding: 25px;
    background: linear-gradient(135deg, #f8f9ff 0%, #faf5ff 100%);
    border-radius: 16px;
    transition: all 0.3s ease;
}

.contact-item:hover {
    transform: translateX(5px);
    box-shadow: 0 5px 20px rgba(102, 126, 234, 0.1);
}

.contact-item i {
    font-size: 24px;
    color: #667eea;
    min-width: 24px;
}

.contact-item h4 {
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 5px;
    color: #1a1a1a;
}

.contact-item p {
    font-size: 14px;
    color: #6b7280;
}

.map-container {
    margin-top: 40px;
}

.map-container iframe {
    width: 100%;
    height: 450px;
    border: 0;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
}

/* Testimonials */
#testimonials {
    background: linear-gradient(135deg, #f8f9ff 0%, #faf5ff 100%);
    padding: 100px 60px;
    text-align: center;
}

#testimonials h2 {
    font-size: 42px;
    font-weight: 800;
    margin-bottom: 15px;
    color: #1a1a1a;
    letter-spacing: -1px;
}

#testimonials > .container > p {
    font-size: 16px;
    color: #6b7280;
    margin-bottom: 50px;
}

.testimonial-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    margin-top: 40px;
}

.testimonial-card {
    background: white;
    padding: 35px;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.testimonial-card > p:first-child {
    font-size: 24px;
    margin-bottom: 20px;
}

.testimonial-card > p:nth-child(2) {
    font-size: 15px;
    color: #374151;
    line-height: 1.7;
    margin-bottom: 25px;
    font-style: italic;
}

.testimonial-card h4 {
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 5px;
    color: #1a1a1a;
}

.testimonial-card span {
    font-size: 14px;
    color: #9ca3af;
}

/* Footer */
footer {
    background: #1a1a1a;
    padding: 60px 60px 30px;
    color: #d1d5db;
}

.footer-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 40px;
    border-bottom: 1px solid #374151;
    margin-bottom: 30px;
}

.footer-logo h3 {
    font-size: 24px;
    font-weight: 800;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.footer-menu {
    list-style: none;
    display: flex;
    gap: 30px;
}

.footer-menu li a {
    text-decoration: none;
    color: #d1d5db;
    font-weight: 500;
    transition: color 0.3s ease;
}

.footer-menu li a:hover {
    color: #667eea;
}

.footer-social a {
    margin-left: 15px;
    font-size: 20px;
    color: #d1d5db;
    transition: all 0.3s ease;
}

.footer-social a:hover {
    color: #667eea;
    transform: translateY(-2px);
}

.footer-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 14px;
}

.footer-links a {
    text-decoration: none;
    margin-left: 15px;
    color: #9ca3af;
    transition: color 0.3s ease;
}

.footer-links a:hover {
    color: #667eea;
}

/* Responsive */
@media (max-width: 1024px) {
    .hero,
    .promo,
    #contact,
    #testimonials,
    .gallery,
    footer {
        padding: 60px 40px;
    }

    .header {
        padding: 20px 40px;
    }

    .gallery-items,
    .testimonial-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .hero,
    .promo {
        flex-direction: column;
        text-align: center;
    }

    .hero-text,
    .promo-text,
    .hero-img,
    .promo-img {
        flex: 1 1 100%;
    }

    .hero-btn,
    .promo-btn {
        justify-content: center;
    }

    .nav {
        display: none;
    }

    .gallery-items,
    .testimonial-grid {
        grid-template-columns: 1fr;
    }

    .contact-wrapper {
        flex-direction: column;
    }
}
    </style>
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
                <p>Nikmati cita rasa Minang autentik di Rumah Makan Padang Sejahtera. Setiap hidangan disajikan dengan resep tradisional yang telah diwariskan turun-temurun.</p>
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
                        <h3>Rendang Spesial</h3>
                        <p>Rendang lezat dengan bumbu spesial, siap menggelitik lidah anda</p>
                    </div>
                    <div class="promo-items2">
                        <h3>Jangan Lewatkan</h3>
                        <p>Bergabunglah dengan kami, nikmati hidangan lezat setiap Jumat</p>
                    </div>
                </div>
                <div class="promo-btn">
                    <a href="#" class="view-btns">Lihat</a>
                    <a href="#" class="order-btns">Pesan →</a>
                </div>
            </div>
            <div class="promo-img">
                <img src="../assets/img/Promo-img.jpg" alt="Promo Image">
            </div>
        </section>
        
        <section class="gallery">
            <h2>Nikmati Beragam Menu Lezat yang Siap<br>Memanjakan Lidah Anda</h2>
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
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
            </div>
        </section>

        <section id="testimonials">
            <div class="container">
                <h2>Testimoni Pelanggan</h2>
                <p>Rasa yang luar biasa dan pelayanan yang cepat!</p>

                <div class="testimonial-grid">
                    <div class="testimonial-card">
                        <p>⭐⭐⭐⭐⭐</p>
                        <p>"Makanan di sini selalu memuaskan dan enak!"</p>
                        <h4>Andi Setiawan</h4>
                        <span>Konsumen, Jakarta</span>
                    </div>

                    <div class="testimonial-card">
                        <p>⭐⭐⭐⭐⭐</p>
                        <p>"Pelayanannya ramah dan suasananya nyaman."</p>
                        <h4>Siti Amina</h4>
                        <span>Pelanggan, Bekasi</span>
                    </div>

                    <div class="testimonial-card">
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
            <div class="footer-logo">
                <h3>Logo</h3>
            </div>

            <ul class="footer-menu">
                <li><a href="#">Home</a></li>
                <li><a href="#">Menu</a></li>
                <li><a href="#">Promo</a></li>
                <li><a href="#">Galeri</a></li>
                <li><a href="#">Kontak</a></li>
            </ul>

            <div class="footer-social">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>

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