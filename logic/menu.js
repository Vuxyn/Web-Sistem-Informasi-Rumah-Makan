// Menu JavaScript functionality for cart management

document.addEventListener('DOMContentLoaded', function() {
    // Initialize cart functionality
    initCart();

    // Load cart from localStorage
    loadCart();

    // Update cart display
    updateCartDisplay();
});

// Cart data structure
let cart = [];

// Initialize cart functionality
function initCart() {
    // Add event listeners to all "Tambahkan ke Keranjang" buttons
    const addToCartButtons = document.querySelectorAll('.menu-item .button');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const menuItem = this.closest('.menu-item');
            const itemName = menuItem.querySelector('h3').textContent;
            const itemPrice = parseInt(menuItem.querySelector('.price').textContent.replace('Rp. ', '').replace('.', ''));
            const itemImage = menuItem.querySelector('.img').src;
            const itemCategory = menuItem.querySelector('p').textContent;

            addToCart({
                name: itemName,
                price: itemPrice,
                image: itemImage,
                category: itemCategory,
                quantity: 1
            });

            // Show success message
            showNotification(`${itemName} ditambahkan ke keranjang!`, 'success');
        });
    });

    // Create cart modal
    createCartModal();
}

// Add item to cart
function addToCart(item) {
    const existingItem = cart.find(cartItem => cartItem.name === item.name);

    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push(item);
    }

    saveCart();
    updateCartDisplay();
}

// Remove item from cart
function removeFromCart(itemName) {
    cart = cart.filter(item => item.name !== itemName);
    saveCart();
    updateCartDisplay();
}

// Update item quantity
function updateQuantity(itemName, newQuantity) {
    if (newQuantity <= 0) {
        removeFromCart(itemName);
        return;
    }

    const item = cart.find(item => item.name === itemName);
    if (item) {
        item.quantity = newQuantity;
        saveCart();
        updateCartDisplay();
    }
}

// Save cart to localStorage
function saveCart() {
    localStorage.setItem('restaurantCart', JSON.stringify(cart));
}

// Load cart from localStorage
function loadCart() {
    const savedCart = localStorage.getItem('restaurantCart');
    if (savedCart) {
        cart = JSON.parse(savedCart);
    }
}

// Update cart display
function updateCartDisplay() {
    const cartCount = document.querySelector('.cart-count');
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);

    if (cartCount) {
        cartCount.textContent = totalItems;
        cartCount.style.display = totalItems > 0 ? 'block' : 'none';
    }

    // Update cart modal if open
    updateCartModal();
}

// Create cart modal
function createCartModal() {
    const cartModal = document.createElement('div');
    cartModal.id = 'cart-modal';
    cartModal.className = 'cart-modal';
    cartModal.innerHTML = `
        <div class="cart-modal-content">
            <div class="cart-modal-header">
                <h3>Keranjang Belanja</h3>
                <span class="close-cart-modal">&times;</span>
            </div>
            <div class="cart-items">
                <!-- Cart items will be inserted here -->
            </div>
            <div class="cart-total">
                <strong>Total: Rp. <span id="cart-total">0</span></strong>
            </div>
            <div class="cart-actions">
                <button class="clear-cart-btn">Kosongkan Keranjang</button>
                <button class="checkout-btn">Checkout</button>
            </div>
        </div>
    `;

    document.body.appendChild(cartModal);

    // Add cart icon to navbar
    const navbar = document.querySelector('.navbar .links');
    if (navbar) {
        const cartIcon = document.createElement('div');
        cartIcon.className = 'cart-icon';
        cartIcon.innerHTML = `
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-count" style="display: none;">0</span>
        `;
        cartIcon.addEventListener('click', openCartModal);
        navbar.appendChild(cartIcon);
    }

    // Close modal functionality
    cartModal.addEventListener('click', function(e) {
        if (e.target === cartModal || e.target.classList.contains('close-cart-modal')) {
            closeCartModal();
        }
    });

    // Clear cart button
    cartModal.querySelector('.clear-cart-btn').addEventListener('click', function() {
        cart = [];
        saveCart();
        updateCartDisplay();
        showNotification('Keranjang dikosongkan!', 'info');
    });

    // Checkout button
    cartModal.querySelector('.checkout-btn').addEventListener('click', function() {
        if (cart.length === 0) {
            showNotification('Keranjang kosong!', 'warning');
            return;
        }
        showNotification('Fitur checkout akan segera hadir!', 'info');
        // Here you would typically redirect to checkout page or process order
    });
}

// Open cart modal
function openCartModal() {
    const modal = document.getElementById('cart-modal');
    if (modal) {
        modal.style.display = 'flex';
        updateCartModal();
    }
}

// Close cart modal
function closeCartModal() {
    const modal = document.getElementById('cart-modal');
    if (modal) {
        modal.style.display = 'none';
    }
}

// Update cart modal content
function updateCartModal() {
    const cartItemsContainer = document.querySelector('.cart-items');
    const cartTotalElement = document.getElementById('cart-total');

    if (!cartItemsContainer || !cartTotalElement) return;

    // Clear existing items
    cartItemsContainer.innerHTML = '';

    if (cart.length === 0) {
        cartItemsContainer.innerHTML = '<p>Keranjang kosong</p>';
        cartTotalElement.textContent = '0';
        return;
    }

    // Add cart items
    cart.forEach(item => {
        const itemElement = document.createElement('div');
        itemElement.className = 'cart-item';
        itemElement.innerHTML = `
            <img src="${item.image}" alt="${item.name}" class="cart-item-img">
            <div class="cart-item-details">
                <h4>${item.name}</h4>
                <p>Rp. ${item.price.toLocaleString()}</p>
                <div class="quantity-controls">
                    <button class="quantity-btn minus-btn" data-name="${item.name}">-</button>
                    <span class="quantity">${item.quantity}</span>
                    <button class="quantity-btn plus-btn" data-name="${item.name}">+</button>
                </div>
            </div>
            <button class="remove-item-btn" data-name="${item.name}">&times;</button>
        `;
        cartItemsContainer.appendChild(itemElement);
    });

    // Add event listeners for quantity controls
    document.querySelectorAll('.quantity-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const itemName = this.getAttribute('data-name');
            const isPlus = this.classList.contains('plus-btn');
            const currentItem = cart.find(item => item.name === itemName);

            if (currentItem) {
                const newQuantity = isPlus ? currentItem.quantity + 1 : currentItem.quantity - 1;
                updateQuantity(itemName, newQuantity);
            }
        });
    });

    // Add event listeners for remove buttons
    document.querySelectorAll('.remove-item-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const itemName = this.getAttribute('data-name');
            removeFromCart(itemName);
            showNotification(`${itemName} dihapus dari keranjang!`, 'info');
        });
    });

    // Calculate and display total
    const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    cartTotalElement.textContent = total.toLocaleString();
}

// Show notification
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.textContent = message;

    document.body.appendChild(notification);

    // Show notification
    setTimeout(() => {
        notification.classList.add('show');
    }, 100);

    // Hide notification after 3 seconds
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}

// Add CSS styles for cart functionality
const cartStyles = document.createElement('style');
cartStyles.textContent = `
    .cart-icon {
        position: relative;
        cursor: pointer;
        margin-left: 20px;
        font-size: 24px;
        color: #333;
    }

    .cart-count {
        position: absolute;
        top: -10px;
        right: -10px;
        background: #ff6b35;
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: bold;
    }

    .cart-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 3000;
    }

    .cart-modal-content {
        background: white;
        border-radius: 10px;
        width: 90%;
        max-width: 500px;
        max-height: 80vh;
        overflow-y: auto;
        padding: 20px;
    }

    .cart-modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .close-cart-modal {
        font-size: 28px;
        cursor: pointer;
        color: #666;
    }

    .cart-items {
        margin-bottom: 20px;
    }

    .cart-item {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }

    .cart-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .cart-item-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 5px;
        margin-right: 15px;
    }

    .cart-item-details {
        flex: 1;
    }

    .cart-item-details h4 {
        margin: 0 0 5px 0;
        font-size: 16px;
    }

    .cart-item-details p {
        margin: 0 0 10px 0;
        color: #666;
        font-size: 14px;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
    }

    .quantity-btn {
        background: #f0f0f0;
        border: none;
        width: 25px;
        height: 25px;
        cursor: pointer;
        border-radius: 3px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .quantity {
        margin: 0 10px;
        min-width: 20px;
        text-align: center;
    }

    .remove-item-btn {
        background: #ff4757;
        color: white;
        border: none;
        width: 25px;
        height: 25px;
        cursor: pointer;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        margin-left: 10px;
    }

    .cart-total {
        text-align: right;
        font-size: 18px;
        margin-bottom: 20px;
        padding-top: 15px;
        border-top: 2px solid #eee;
    }

    .cart-actions {
        display: flex;
        justify-content: space-between;
    }

    .clear-cart-btn, .checkout-btn {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
    }

    .clear-cart-btn {
        background: #ff4757;
        color: white;
    }

    .checkout-btn {
        background: #ff6b35;
        color: white;
    }

    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        background: #333;
        color: white;
        padding: 15px 20px;
        border-radius: 5px;
        z-index: 4000;
        transform: translateX(100%);
        transition: transform 0.3s ease;
        max-width: 300px;
    }

    .notification.show {
        transform: translateX(0);
    }

    .notification.success {
        background: #2ed573;
    }

    .notification.warning {
        background: #ffa502;
    }

    .notification.info {
        background: #3742fa;
    }
`;
document.head.appendChild(cartStyles);
