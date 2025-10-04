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
                // Load data untuk halaman yang dipilih
                loadPageData(pageId);
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

    // Load initial data
    loadDashboardStats();
    loadPageData('menu');
    loadPageData('orders');
    loadPageData('customers');
    loadPageData('inventory');
    loadPageData('promo');

    // Fungsi untuk mengelola modal
    // Menu Modal
    window.openMenuModal = function(menuId = null) {
        const modal = document.getElementById('menuModal');
        const form = document.getElementById('menuForm');
        const modalTitle = document.getElementById('menuModalTitle');

        if (menuId) {
            modalTitle.textContent = 'Edit Menu';
            // Load menu data for editing
            loadMenuForEdit(menuId);
        } else {
            modalTitle.textContent = 'Tambah Menu Baru';
            form.reset(); // Reset form
            document.getElementById('menuId').value = '';
        }
        modal.classList.add('show');
    };

    window.closeMenuModal = function() {
        const modal = document.getElementById('menuModal');
        modal.classList.remove('show');
    };

    // Promo Modal
    window.openPromoModal = function(promoId = null) {
        const modal = document.getElementById('promoModal');
        const form = document.getElementById('promoForm');
        const modalTitle = document.getElementById('promoModalTitle');

        if (promoId) {
            modalTitle.textContent = 'Edit Promo';
            // Load promo data for editing
            loadPromoForEdit(promoId);
        } else {
            modalTitle.textContent = 'Tambah Promo Baru';
            form.reset(); // Reset form
            document.getElementById('promoId').value = '';
        }
        modal.classList.add('show');
    };

    window.closePromoModal = function() {
        const modal = document.getElementById('promoModal');
        modal.classList.remove('show');
    };

    // Inventory Modal
    window.openInventoryModal = function(inventoryId = null) {
        const modal = document.getElementById('inventoryModal');
        const form = document.getElementById('inventoryForm');
        const modalTitle = document.getElementById('inventoryModalTitle');

        if (inventoryId) {
            modalTitle.textContent = 'Edit Item Inventory';
            // Load inventory data for editing
            loadInventoryForEdit(inventoryId);
        } else {
            modalTitle.textContent = 'Tambah Item Inventory';
            form.reset(); // Reset form
            document.getElementById('inventoryId').value = '';
        }
        modal.classList.add('show');
    };

    window.closeInventoryModal = function() {
        const modal = document.getElementById('inventoryModal');
        modal.classList.remove('show');
    };

    // Customer Modal
    window.openCustomerModal = function(customerId = null) {
        const modal = document.getElementById('customerModal');
        const form = document.getElementById('customerForm');
        const modalTitle = document.getElementById('customerModalTitle');

        if (customerId) {
            modalTitle.textContent = 'Edit Pelanggan';
            // Load customer data for editing
            loadCustomerForEdit(customerId);
        } else {
            modalTitle.textContent = 'Tambah Pelanggan Baru';
            form.reset(); // Reset form
            document.getElementById('customerId').value = '';
        }
        modal.classList.add('show');
    };

    window.closeCustomerModal = function() {
        const modal = document.getElementById('customerModal');
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
    document.getElementById('menuForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const menuId = document.getElementById('menuId').value;
        const menuName = document.getElementById('menuName').value;
        const menuCategory = document.getElementById('menuCategory').value;
        const menuPrice = document.getElementById('menuPrice').value;
        const menuDescription = document.getElementById('menuDescription').value;
        const menuStock = document.getElementById('menuStock').value;
        const menuStatus = document.getElementById('menuStatus').value;
        const menuImage = document.getElementById('menuImage').files[0];

        const data = {
            name: menuName,
            category: menuCategory,
            price: menuPrice,
            description: menuDescription,
            stock: menuStock,
            status: menuStatus,
            image: menuImage ? menuImage.name : ''
        };

        try {
            const response = await fetch(menuId ? `api/menus.php?id=${menuId}` : 'api/menus.php', {
                method: menuId ? 'PUT' : 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();
            if (result.success) {
                alert(`Menu ${menuName} telah disimpan!`);
                closeMenuModal();
                loadPageData('menu');
                loadDashboardStats();
            } else {
                alert('Gagal menyimpan menu');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menyimpan');
        }
    });

    // Menangani submit form untuk Promo
    document.getElementById('promoForm').addEventListener('submit', async (e) => {
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

        const data = {
            name: promoName,
            code: promoCode,
            type: promoType,
            value: promoValue,
            start_date: promoStartDate,
            end_date: promoEndDate,
            limit_usage: promoLimit,
            min_purchase: promoMinPurchase,
            description: promoDescription
        };

        try {
            const response = await fetch(promoId ? `api/promos.php?id=${promoId}` : 'api/promos.php', {
                method: promoId ? 'PUT' : 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();
            if (result.success) {
                alert(`Promo ${promoName} telah disimpan!`);
                closePromoModal();
                loadPageData('promo');
            } else {
                alert('Gagal menyimpan promo');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menyimpan');
        }
    });

    // Menangani submit form untuk Inventory
    document.getElementById('inventoryForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const inventoryId = document.getElementById('inventoryId').value;
        const inventoryName = document.getElementById('inventoryName').value;
        const inventoryCategory = document.getElementById('inventoryCategory').value;
        const inventoryUnit = document.getElementById('inventoryUnit').value;
        const inventoryStock = document.getElementById('inventoryStock').value;
        const inventoryPrice = document.getElementById('inventoryPrice').value;
        const inventoryMinStock = document.getElementById('inventoryMinStock').value;

        const data = {
            name: inventoryName,
            category: inventoryCategory,
            unit: inventoryUnit,
            stock: inventoryStock,
            price_per_unit: inventoryPrice,
            min_stock: inventoryMinStock
        };

        try {
            const response = await fetch(inventoryId ? `api/inventory.php?id=${inventoryId}` : 'api/inventory.php', {
                method: inventoryId ? 'PUT' : 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();
            if (result.success) {
                alert(`Item inventory ${inventoryName} telah disimpan!`);
                closeInventoryModal();
                loadPageData('inventory');
            } else {
                alert('Gagal menyimpan item inventory');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menyimpan');
        }
    });

    // Menangani submit form untuk Customer
    document.getElementById('customerForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const customerId = document.getElementById('customerId').value;
        const customerName = document.getElementById('customerName').value;
        const customerEmail = document.getElementById('customerEmail').value;
        const customerPhone = document.getElementById('customerPhone').value;

        const data = {
            name: customerName,
            email: customerEmail,
            phone: customerPhone
        };

        try {
            const response = await fetch(customerId ? `api/customers.php?id=${customerId}` : 'api/customers.php', {
                method: customerId ? 'PUT' : 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();
            if (result.success) {
                alert(`Pelanggan ${customerName} telah disimpan!`);
                closeCustomerModal();
                loadPageData('customers');
                loadDashboardStats();
            } else {
                alert('Gagal menyimpan pelanggan');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menyimpan');
        }
    });
});

// API Functions
async function loadPageData(page) {
    switch (page) {
        case 'menu':
            await loadMenus();
            break;
        case 'orders':
            await loadOrders();
            break;
        case 'customers':
            await loadCustomers();
            break;
        case 'inventory':
            await loadInventory();
            break;
        case 'promo':
            await loadPromos();
            break;
    }
}

async function loadDashboardStats() {
    try {
        // Load stats from different APIs
        const [ordersRes, menusRes, customersRes] = await Promise.all([
            fetch('api/orders.php'),
            fetch('api/menus.php'),
            fetch('api/customers.php')
        ]);

        const orders = await ordersRes.json();
        const menus = await menusRes.json();
        const customers = await customersRes.json();

        // Calculate stats
        const totalOrders = orders.length;
        const totalRevenue = orders.reduce((sum, order) => sum + parseFloat(order.total || 0), 0);
        const totalMenus = menus.length;
        const totalCustomers = customers.length;

        // Update dashboard
        document.getElementById('total-orders').textContent = totalOrders;
        document.getElementById('total-revenue').textContent = `Rp ${totalRevenue.toLocaleString('id-ID')}`;
        document.getElementById('menu-items').textContent = totalMenus;
        document.getElementById('active-customers').textContent = totalCustomers;

    } catch (error) {
        console.error('Error loading dashboard stats:', error);
    }
}

async function loadMenus() {
    try {
        const response = await fetch('api/menus.php');
        const menus = await response.json();

        const tbody = document.getElementById('menu-table-body');
        tbody.innerHTML = '';

        menus.forEach(menu => {
            const row = `
                <tr>
                    <td><img src="${menu.image || 'https://via.placeholder.com/50'}" alt="${menu.name}" style="width: 50px; height: 50px; object-fit: cover;"></td>
                    <td>${menu.name}</td>
                    <td>${menu.category}</td>
                    <td>Rp ${parseInt(menu.price).toLocaleString('id-ID')}</td>
                    <td><span class="status ${menu.status}">${menu.status}</span></td>
                    <td>${menu.stock}</td>
                    <td>
                        <button class="btn-action edit" onclick="editMenu(${menu.id})"><i class="fas fa-edit"></i></button>
                        <button class="btn-action delete" onclick="deleteMenu(${menu.id})"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            `;
            tbody.innerHTML += row;
        });
    } catch (error) {
        console.error('Error loading menus:', error);
    }
}

async function loadOrders() {
    try {
        const response = await fetch('api/orders.php');
        const orders = await response.json();

        const tbody = document.getElementById('orders-table-body');
        tbody.innerHTML = '';

        orders.forEach(order => {
            const row = `
                <tr>
                    <td>${order.id}</td>
                    <td>${order.customer_name || 'N/A'}</td>
                    <td>${order.menu_items || 'N/A'}</td>
                    <td>${order.quantity || 1}</td>
                    <td>Rp ${parseInt(order.total).toLocaleString('id-ID')}</td>
                    <td><span class="status ${order.status}">${order.status}</span></td>
                    <td>${new Date(order.order_date).toLocaleDateString('id-ID')}</td>
                    <td>
                        <button class="btn-action view" onclick="viewOrder(${order.id})"><i class="fas fa-eye"></i></button>
                        <button class="btn-action edit" onclick="editOrderStatus(${order.id}, '${order.status}')"><i class="fas fa-edit"></i></button>
                    </td>
                </tr>
            `;
            tbody.innerHTML += row;
        });
    } catch (error) {
        console.error('Error loading orders:', error);
    }
}

async function loadCustomers() {
    try {
        const response = await fetch('api/customers.php');
        const customers = await response.json();

        const tbody = document.getElementById('customers-table-body');
        tbody.innerHTML = '';

        customers.forEach(customer => {
            const row = `
                <tr>
                    <td>${customer.id}</td>
                    <td>${customer.name}</td>
                    <td>${customer.email}</td>
                    <td>${customer.phone || '-'}</td>
                    <td>${customer.total_orders}</td>
                    <td>Rp ${parseInt(customer.total_spent).toLocaleString('id-ID')}</td>
                    <td>${new Date(customer.created_at).toLocaleDateString('id-ID')}</td>
                    <td>
                        <button class="btn-action edit" onclick="editCustomer(${customer.id})"><i class="fas fa-edit"></i></button>
                        <button class="btn-action delete" onclick="deleteCustomer(${customer.id})"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            `;
            tbody.innerHTML += row;
        });
    } catch (error) {
        console.error('Error loading customers:', error);
    }
}

async function loadInventory() {
    try {
        const response = await fetch('api/inventory.php');
        const inventory = await response.json();

        const tbody = document.getElementById('inventory-table-body');
        tbody.innerHTML = '';

        inventory.forEach(item => {
            const statusClass = item.stock_status === 'habis' ? 'danger' : item.stock_status === 'menipis' ? 'warning' : 'success';
            const statusText = item.stock_status === 'habis' ? 'Habis' : item.stock_status === 'menipis' ? 'Menipis' : 'Aman';

            const row = `
                <tr>
                    <td>${item.name}</td>
                    <td>${item.category}</td>
                    <td>${item.stock} ${item.unit}</td>
                    <td>Rp ${parseInt(item.price_per_unit).toLocaleString('id-ID')}</td>
                    <td><span class="status ${statusClass}">${statusText}</span></td>
                    <td>${new Date(item.updated_at).toLocaleDateString('id-ID')}</td>
                    <td>
                        <button class="btn-action edit" onclick="editInventory(${item.id})"><i class="fas fa-edit"></i></button>
                        <button class="btn-action delete" onclick="deleteInventory(${item.id})"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            `;
            tbody.innerHTML += row;
        });
    } catch (error) {
        console.error('Error loading inventory:', error);
    }
}

async function loadPromos() {
    try {
        const response = await fetch('api/promos.php');
        const promos = await response.json();

        const tbody = document.getElementById('promo-table-body');
        tbody.innerHTML = '';

        promos.forEach(promo => {
            const statusClass = promo.status === 'active' ? 'success' : promo.status === 'expired' ? 'danger' : 'warning';
            const row = `
                <tr>
                    <td>${promo.code}</td>
                    <td>${promo.name}</td>
                    <td>${promo.type === 'percentage' ? 'Persentase' : 'Nominal'}</td>
                    <td>${promo.type === 'percentage' ? `${promo.value}%` : `Rp ${parseInt(promo.value).toLocaleString('id-ID')}`}</td>
                    <td>${new Date(promo.end_date).toLocaleDateString('id-ID')}</td>
                    <td><span class="status ${statusClass}">${promo.status}</span></td>
                    <td>${promo.usage_count || 0}/${promo.limit_usage || '∞'}</td>
                    <td>
                        <button class="btn-action edit" onclick="editPromo(${promo.id})"><i class="fas fa-edit"></i></button>
                        <button class="btn-action delete" onclick="deletePromo(${promo.id})"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            `;
            tbody.innerHTML += row;
        });
    } catch (error) {
        console.error('Error loading promos:', error);
    }
}

// CRUD Functions
async function deleteMenu(id) {
    if (confirm('Apakah Anda yakin ingin menghapus menu ini?')) {
        try {
            const response = await fetch(`api/menus.php?id=${id}`, {
                method: 'DELETE'
            });
            const result = await response.json();
            if (result.success) {
                alert('Menu berhasil dihapus');
                loadPageData('menu');
                loadDashboardStats();
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }
}

async function deleteInventory(id) {
    if (confirm('Apakah Anda yakin ingin menghapus item inventory ini?')) {
        try {
            const response = await fetch(`api/inventory.php?id=${id}`, {
                method: 'DELETE'
            });
            const result = await response.json();
            if (result.success) {
                alert('Item inventory berhasil dihapus');
                loadPageData('inventory');
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }
}

async function deletePromo(id) {
    if (confirm('Apakah Anda yakin ingin menghapus promo ini?')) {
        try {
            const response = await fetch(`api/promos.php?id=${id}`, {
                method: 'DELETE'
            });
            const result = await response.json();
            if (result.success) {
                alert('Promo berhasil dihapus');
                loadPageData('promo');
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }
}

async function deleteCustomer(id) {
    if (confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')) {
        try {
            const response = await fetch(`api/customers.php?id=${id}`, {
                method: 'DELETE'
            });
            const result = await response.json();
            if (result.success) {
                alert('Pelanggan berhasil dihapus');
                loadPageData('customers');
                loadDashboardStats();
            } else {
                alert(result.error);
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }
}

// Edit Functions
async function loadMenuForEdit(id) {
    try {
        const response = await fetch(`api/menus.php?id=${id}`);
        const menu = await response.json();

        document.getElementById('menuId').value = menu.id;
        document.getElementById('menuName').value = menu.name;
        document.getElementById('menuCategory').value = menu.category;
        document.getElementById('menuPrice').value = menu.price;
        document.getElementById('menuDescription').value = menu.description;
        document.getElementById('menuStock').value = menu.stock;
        document.getElementById('menuStatus').value = menu.status;
        // Note: Image handling would need file input update, but for now we'll keep it simple
    } catch (error) {
        console.error('Error loading menu for edit:', error);
        alert('Gagal memuat data menu');
    }
}

function editMenu(id) {
    openMenuModal(id);
}

// Edit Functions for Promo
async function loadPromoForEdit(id) {
    try {
        const response = await fetch(`api/promos.php?id=${id}`);
        const promo = await response.json();

        document.getElementById('promoId').value = promo.id;
        document.getElementById('promoName').value = promo.name;
        document.getElementById('promoCode').value = promo.code;
        document.getElementById('promoType').value = promo.type;
        document.getElementById('promoValue').value = promo.value;
        document.getElementById('promoStartDate').value = promo.start_date;
        document.getElementById('promoEndDate').value = promo.end_date;
        document.getElementById('promoLimit').value = promo.limit_usage;
        document.getElementById('promoMinPurchase').value = promo.min_purchase;
        document.getElementById('promoDescription').value = promo.description;
    } catch (error) {
        console.error('Error loading promo for edit:', error);
        alert('Gagal memuat data promo');
    }
}

function editPromo(id) {
    openPromoModal(id);
}

// Edit Functions for Customer
async function loadCustomerForEdit(id) {
    try {
        const response = await fetch(`api/customers.php?id=${id}`);
        const customer = await response.json();

        document.getElementById('customerId').value = customer.id;
        document.getElementById('customerName').value = customer.name;
        document.getElementById('customerEmail').value = customer.email;
        document.getElementById('customerPhone').value = customer.phone || '';
    } catch (error) {
        console.error('Error loading customer for edit:', error);
        alert('Gagal memuat data pelanggan');
    }
}

function editCustomer(id) {
    openCustomerModal(id);
}

// Edit Functions for Inventory
async function loadInventoryForEdit(id) {
    try {
        const response = await fetch(`api/inventory.php?id=${id}`);
        const inventory = await response.json();

        document.getElementById('inventoryId').value = inventory.id;
        document.getElementById('inventoryName').value = inventory.name;
        document.getElementById('inventoryCategory').value = inventory.category;
        document.getElementById('inventoryUnit').value = inventory.unit;
        document.getElementById('inventoryStock').value = inventory.stock;
        document.getElementById('inventoryPrice').value = inventory.price_per_unit;
        document.getElementById('inventoryMinStock').value = inventory.min_stock;
    } catch (error) {
        console.error('Error loading inventory for edit:', error);
        alert('Gagal memuat data inventory');
    }
}

function editInventory(id) {
    openInventoryModal(id);
}

// Placeholder functions for edit/view
function viewOrder(id) { alert('View order functionality to be implemented'); }
function editOrderStatus(id, status) { alert('Edit order status functionality to be implemented'); }
