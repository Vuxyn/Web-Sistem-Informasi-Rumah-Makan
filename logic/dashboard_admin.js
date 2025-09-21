// Fungsi untuk mengelola navigasi sidebar
document.addEventListener('DOMContentLoaded', () => {
    const navLinks = document.querySelectorAll('.nav-menu a');
    const pageContents = document.querySelectorAll('.page-content');
    const pageTitle = document.getElementById('page-title');
    const sidebar = document.querySelector('.sidebar');
    const sidebarToggle = document.querySelector('.sidebar-toggle');

    // Navigasi sidebar
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault(); // Mencegah perilaku default link

            // Hapus kelas 'active' dari semua item menu
            document.querySelectorAll('.nav-menu li').forEach(li => {
                li.classList.remove('active');
            });

            // Tambahkan kelas 'active' ke item menu yang diklik
            link.parentElement.classList.add('active');

            // Dapatkan data-page dari link yang diklik
            const pageId = link.getAttribute('data-page');

            // Sembunyikan semua halaman
            pageContents.forEach(content => {
                content.classList.remove('active');
            });

            // Tampilkan halaman yang sesuai
            const targetPage = document.getElementById(`${pageId}-page`);
            if (targetPage) {
                targetPage.classList.add('active');
            }

            // Perbarui judul halaman di header
            const pageNames = {
                dashboard: 'Dashboard',
                menu: 'Menu Makanan',
                orders: 'Pesanan',
                customers: 'Pelanggan',
                inventory: 'Inventory',
                promo: 'Promo & Diskon',
                reports: 'Laporan'
            };
            pageTitle.textContent = pageNames[pageId] || 'Dashboard';

            // Tutup sidebar pada layar kecil setelah klik
            if (window.innerWidth <= 768) {
                sidebar.style.transform = 'translateX(-100%)';
            }
        });
    });

    // Toggle sidebar pada layar kecil
    sidebarToggle.addEventListener('click', () => {
        sidebar.style.transform = sidebar.style.transform === 'translateX(-100%)' ? 'translateX(0)' : 'translateX(-100%)';
    });

    // Fungsi untuk mengelola modal
    // Menu Modal
    window.openMenuModal = function() {
        const modal = document.getElementById('menuModal');
        const form = document.getElementById('menuForm');
        const modalTitle = document.getElementById('menuModalTitle');
        modalTitle.textContent = 'Tambah Menu Baru';
        form.reset(); // Reset form
        modal.classList.add('show');
    };

    window.closeMenuModal = function() {
        const modal = document.getElementById('menuModal');
        modal.classList.remove('show');
    };

    // Promo Modal
    window.openPromoModal = function() {
        const modal = document.getElementById('promoModal');
        const form = document.getElementById('promoForm');
        const modalTitle = document.getElementById('promoModalTitle');
        modalTitle.textContent = 'Tambah Promo Baru';
        form.reset(); // Reset form
        modal.classList.add('show');
    };

    window.closePromoModal = function() {
        const modal = document.getElementById('promoModal');
        modal.classList.remove('show');
    };

    // Inventory Modal
    window.openInventoryModal = function() {
        const modal = document.getElementById('inventoryModal');
        const form = document.getElementById('inventoryForm');
        const modalTitle = document.getElementById('inventoryModalTitle');
        modalTitle.textContent = 'Tambah Item Inventory';
        form.reset(); // Reset form
        modal.classList.add('show');
    };

    window.closeInventoryModal = function() {
        const modal = document.getElementById('inventoryModal');
        modal.classList.remove('show');
    };

    // Order Modal (hanya untuk melihat detail, tanpa form)
    window.openOrderModal = function(orderId) {
        const modal = document.getElementById('orderModal');
        const orderDetails = document.getElementById('orderDetails');
        // Contoh data dummy, ganti dengan data dari backend atau array
        orderDetails.innerHTML = `
            <p><strong>ID Pesanan:</strong> ${orderId || '#001'}</p>
            <p><strong>Pelanggan:</strong> Budi Santoso</p>
            <p><strong>Menu:</strong> Rendang + Nasi</p>
            <p><strong>Total:</strong> Rp 25.000</p>
            <p><strong>Status:</strong> Pending</p>
        `;
        modal.classList.add('show');
    };

    window.closeOrderModal = function() {
        const modal = document.getElementById('orderModal');
        modal.classList.remove('show');
    };

    // Refresh Orders (placeholder)
    window.refreshOrders = function() {
        alert('Fungsi refresh pesanan akan diimplementasikan dengan API.');
        // Tambahkan logika untuk refresh data pesanan di sini
    };

    // Menangani submit form untuk Menu
    document.getElementById('menuForm').addEventListener('submit', (e) => {
        e.preventDefault();
        const menuId = document.getElementById('menuId').value;
        const menuName = document.getElementById('menuName').value;
        const menuCategory = document.getElementById('menuCategory').value;
        const menuPrice = document.getElementById('menuPrice').value;
        const menuDescription = document.getElementById('menuDescription').value;
        const menuStock = document.getElementById('menuStock').value;
        const menuStatus = document.getElementById('menuStatus').value;
        const menuImage = document.getElementById('menuImage').files[0];

        // Contoh logika: simpan data (ganti dengan API call)
        console.log({
            menuId,
            menuName,
            menuCategory,
            menuPrice,
            menuDescription,
            menuStock,
            menuStatus,
            menuImage: menuImage ? menuImage.name : 'Tidak ada file'
        });
        alert(`Menu ${menuName} telah disimpan!`);
        closeMenuModal();
    });

    // Menangani submit form untuk Promo
    document.getElementById('promoForm').addEventListener('submit', (e) => {
        e.preventDefault();
        const promoId = document.getElementById('promoId').value;
        const promoName = document.getElementById('promoName').value;
        const promoCode = document.getElementById('promoCode').value;
        const promoType = document.getElementById('promoType').value;
        const promoValue = document.getElementById('promoValue').value;
        const promoStartDate = document.getElementById('promoStartDate').value;
        const promoEndDate = document.getElementById('promoEndDate').value;
        const promoLimit = document.getElementById('promoLimit').value;
        const promoMinPurchase = document.getElementById('promoMinPurchase').value;
        const promoDescription = document.getElementById('promoDescription').value;

        // Contoh logika: simpan data (ganti dengan API call)
        console.log({
            promoId,
            promoName,
            promoCode,
            promoType,
            promoValue,
            promoStartDate,
            promoEndDate,
            promoLimit,
            promoMinPurchase,
            promoDescription
        });
        alert(`Promo ${promoName} telah disimpan!`);
        closePromoModal();
    });

    // Menangani submit form untuk Inventory
    document.getElementById('inventoryForm').addEventListener('submit', (e) => {
        e.preventDefault();
        const inventoryId = document.getElementById('inventoryId').value;
        const inventoryName = document.getElementById('inventoryName').value;
        const inventoryCategory = document.getElementById('inventoryCategory').value;
        const inventoryUnit = document.getElementById('inventoryUnit').value;
        const inventoryStock = document.getElementById('inventoryStock').value;
        const inventoryPrice = document.getElementById('inventoryPrice').value;
        const inventoryMinStock = document.getElementById('inventoryMinStock').value;

        // Contoh logika: simpan data (ganti dengan API call)
        console.log({
            inventoryId,
            inventoryName,
            inventoryCategory,
            inventoryUnit,
            inventoryStock,
            inventoryPrice,
            inventoryMinStock
        });
        alert(`Item inventory ${inventoryName} telah disimpan!`);
        closeInventoryModal();
    });
});