// Homepage JavaScript functionality

document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for navigation links
    initSmoothScrolling();

    // Sticky header on scroll
    initStickyHeader();

    // Mobile menu toggle (if needed)
    initMobileMenu();

    // Gallery image modal or lightbox
    initGalleryModal();

    // Promo section interactions
    initPromoInteractions();

    // Contact form handling (if added later)
    initContactForm();

    // Testimonials slider
    initTestimonialsSlider();

    // Hero section animations
    initHeroAnimations();

    // Scroll to top button
    initScrollToTop();
});

// Smooth scrolling for navigation links
function initSmoothScrolling() {
    const navLinks = document.querySelectorAll('.nav a[href^="#"], .hero-btn a[href^="#"]');

    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);

            if (targetSection) {
                e.preventDefault();
                const headerHeight = document.querySelector('.header').offsetHeight;
                const targetPosition = targetSection.offsetTop - headerHeight;

                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
}

// Sticky header
function initStickyHeader() {
    const header = document.querySelector('.header');
    const stickyClass = 'sticky';

    window.addEventListener('scroll', function() {
        if (window.scrollY > 100) {
            header.classList.add(stickyClass);
        } else {
            header.classList.remove(stickyClass);
        }
    });
}

// Mobile menu toggle (assuming we add mobile menu later)
function initMobileMenu() {
    // Placeholder for mobile menu functionality
    // Can be expanded when mobile menu is added to HTML
}

// Gallery modal/lightbox
function initGalleryModal() {
    const galleryImages = document.querySelectorAll('.gallery-img img');

    galleryImages.forEach(img => {
        img.addEventListener('click', function() {
            createModal(this.src, this.alt);
        });
    });
}

function createModal(src, alt) {
    const modal = document.createElement('div');
    modal.className = 'modal';
    modal.innerHTML = `
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <img src="${src}" alt="${alt}" style="max-width: 100%; max-height: 80vh;">
        </div>
    `;

    document.body.appendChild(modal);

    // Close modal functionality
    modal.addEventListener('click', function(e) {
        if (e.target === modal || e.target.classList.contains('close-modal')) {
            modal.remove();
        }
    });
}

// Promo section interactions
function initPromoInteractions() {
    const orderButtons = document.querySelectorAll('.order-btn, .order-btns');

    orderButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            alert('Fitur pemesanan akan segera hadir! Silakan hubungi kami untuk reservasi.');
        });
    });
}

// Contact form handling
function initContactForm() {
    // Placeholder for contact form functionality
    // Can be expanded when contact form is added
}

// Testimonials slider
function initTestimonialsSlider() {
    const testimonialGrid = document.querySelector('.testimonial-grid');
    const testimonials = document.querySelectorAll('.testimonial-card');
    let currentIndex = 0;

    if (testimonials.length > 3) { // Only add slider if more than 3 testimonials
        createSliderControls(testimonialGrid);
    }
}

function createSliderControls(container) {
    const controls = document.createElement('div');
    controls.className = 'slider-controls';
    controls.innerHTML = `
        <button class="slider-prev">&larr;</button>
        <button class="slider-next">&rarr;</button>
    `;

    container.parentNode.insertBefore(controls, container.nextSibling);

    // Add slider functionality
    const prevBtn = controls.querySelector('.slider-prev');
    const nextBtn = controls.querySelector('.slider-next');

    prevBtn.addEventListener('click', () => slideTestimonials(-1));
    nextBtn.addEventListener('click', () => slideTestimonials(1));
}

function slideTestimonials(direction) {
    const testimonialGrid = document.querySelector('.testimonial-grid');
    const testimonials = document.querySelectorAll('.testimonial-card');
    const totalSlides = Math.ceil(testimonials.length / 3);
    let currentSlide = 0;

    // Simple slide implementation
    currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
    const translateX = -currentSlide * 100;
    testimonialGrid.style.transform = `translateX(${translateX}%)`;
}

// Hero section animations
function initHeroAnimations() {
    const heroText = document.querySelector('.hero-text');
    const heroImg = document.querySelector('.hero-img');

    // Add fade-in animation on load
    setTimeout(() => {
        heroText.style.opacity = '1';
        heroText.style.transform = 'translateY(0)';
    }, 500);

    setTimeout(() => {
        heroImg.style.opacity = '1';
        heroImg.style.transform = 'translateX(0)';
    }, 1000);
}

// Scroll to top button
function initScrollToTop() {
    const scrollBtn = document.createElement('button');
    scrollBtn.className = 'scroll-to-top';
    scrollBtn.innerHTML = '&uarr;';
    document.body.appendChild(scrollBtn);

    // Show/hide button based on scroll position
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            scrollBtn.style.display = 'block';
        } else {
            scrollBtn.style.display = 'none';
        }
    });

    // Scroll to top functionality
    scrollBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

// Add some CSS for animations and modal (can be moved to CSS file)
const style = document.createElement('style');
style.textContent = `
    .header.sticky {
        position: fixed;
        top: 0;
        width: 100%;
        background: rgba(255, 255, 255, 0.95);
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        z-index: 1000;
    }

    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.8);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 2000;
    }

    .modal-content {
        position: relative;
        max-width: 90%;
        max-height: 90%;
    }

    .close-modal {
        position: absolute;
        top: -40px;
        right: 0;
        color: white;
        font-size: 30px;
        cursor: pointer;
    }

    .scroll-to-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: #ff6b35;
        color: white;
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        font-size: 20px;
        cursor: pointer;
        display: none;
        z-index: 1000;
    }

    .hero-text, .hero-img {
        opacity: 0;
        transition: all 0.8s ease;
    }

    .hero-text {
        transform: translateY(50px);
    }

    .hero-img {
        transform: translateX(50px);
    }

    .slider-controls {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .slider-controls button {
        background: #ff6b35;
        color: white;
        border: none;
        padding: 10px 15px;
        margin: 0 10px;
        cursor: pointer;
        border-radius: 5px;
    }
`;
document.head.appendChild(style);
