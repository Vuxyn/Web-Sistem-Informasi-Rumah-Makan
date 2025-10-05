<?php
require_once 'config.php';

// Query stats
// Total orders today
$sql_orders = "SELECT COUNT(*) as total_orders, SUM(total) as total_revenue FROM orders WHERE DATE(order_date) = CURDATE()";
$stmt_orders = $pdo->prepare($sql_orders);
$stmt_orders->execute();
$stats_orders = $stmt_orders->fetch();

// Total menus
$sql_menus = "SELECT COUNT(*) as total_menus FROM menus";
$stmt_menus = $pdo->prepare($sql_menus);
$stmt_menus->execute();
$stats_menus = $stmt_menus->fetch();

// Total customers
$sql_customers = "SELECT COUNT(*) as total_customers FROM users WHERE role = 'user'";
$stmt_customers = $pdo->prepare($sql_customers);
$stmt_customers->execute();
$stats_customers = $stmt_customers->fetch();

// Load data for tables
// Menus
$sql_menus_data = "SELECT * FROM menus ORDER BY id DESC";
$stmt_menus_data = $pdo->prepare($sql_menus_data);
$stmt_menus_data->execute();
$menus = $stmt_menus_data->fetchAll();

// Orders
$sql_orders_data = "SELECT o.*, u.name as customer_name FROM orders o LEFT JOIN users u ON o.customer_id = u.id ORDER BY o.order_date DESC LIMIT 10";
$stmt_orders_data = $pdo->prepare($sql_orders_data);
$stmt_orders_data->execute();
$orders = $stmt_orders_data->fetchAll();

// Customers
$sql_customers_data = "SELECT u.*, COUNT(o.id) as total_orders, SUM(o.total) as total_spent FROM users u LEFT JOIN orders o ON u.id = o.customer_id WHERE u.role = 'user' GROUP BY u.id ORDER BY u.created_at DESC";
$stmt_customers_data = $pdo->prepare($sql_customers_data);
$stmt_customers_data->execute();
$customers = $stmt_customers_data->fetchAll();

// Inventory
$sql_inventory = "SELECT * FROM inventory ORDER BY updated_at DESC";
$stmt_inventory = $pdo->prepare($sql_inventory);
$stmt_inventory->execute();
$inventory = $stmt_inventory->fetchAll();

// Promos
$sql_promos = "SELECT * FROM promos ORDER BY created_at DESC";
$stmt_promos = $pdo->prepare($sql_promos);
$stmt_promos->execute();
$promos = $stmt_promos->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - RM Padang</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/dashboard_admin.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <h2><i class="fas fa-utensils"></i> RM Padang Sejahtera</h2>
            </div>
            <nav class="nav-menu">
                <ul>
                    <li class="active">
                        <a href="#" data-page="dashboard">
                            <i class="fas fa-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-page="menu">
                            <i class="fas fa-utensils"></i>
                            <span>Menu Makanan</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-page="orders">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Pesanan</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-page="customers">
                            <i class="fas fa-users"></i>
                            <span>Pelanggan</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-page="inventory">
                            <i class="fas fa-boxes"></i>
                            <span>Inventory</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-page="promo">
                            <i class="fas fa-tags"></i>
                            <span>Promo & Diskon</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-page="reports">
                            <i class="fas fa-chart-bar"></i>
                            <span>Laporan</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="sidebar-footer">
                <a href="#" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="header-left">
                    <button class="sidebar-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 id="page-title">Dashboard</h1>
                </div>
                <div class="header-right">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Cari..." id="global-search">
                    </div>
                    <div class="notifications">
                        <i class="fas fa-bell"></i>
                        <span class="badge">5</span>
                    </div>
                    <div class="profile">
                        <img src="https://via.placeholder.com/40" alt="Profile">
                        <span>Admin</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="content">
                <!-- Dashboard Page -->
                <div id="dashboard-page" class="page-content active">
                    <!-- Stats Cards -->
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="stat-info">
                                <h3><?php echo $stats_orders['total_orders']; ?></h3>
                                <p>Total Pesanan Hari Ini</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div class="stat-info">
                                <h3>Rp <?php echo number_format($stats_orders['total_revenue'], 0, ',', '.'); ?></h3>
                                <p>Pendapatan Hari Ini</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-utensils"></i>
                            </div>
                            <div class="stat-info">
                                <h3><?php echo $stats_menus['total_menus']; ?></h3>
                                <p>Menu Tersedia</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-info">
                                <h3><?php echo $stats_customers['total_customers']; ?></h3>
                                <p>Pelanggan Aktif</p>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Section -->
                    <div class="charts-section">
                        <div class="chart-card">
                            <h3>Penjualan Mingguan</h3>
                            <div class="chart-container">
                                <p>📊 Chart akan diimplementasikan dengan Chart.js</p>
                            </div>
                        </div>
                        <div class="chart-card">
                            <h3>Menu Terpopuler</h3>
                            <div class="popular-menu">
                                <div class="menu-item">
                                    <span>Rendang</span>
                                    <div class="progress-bar">
                                        <div class="progress" style="width: 85%"></div>
                                    </div>
                                    <span>85%</span>
                                </div>
                                <div class="menu-item">
                                    <span>Gulai Ayam</span>
                                    <div class="progress-bar">
                                        <div class="progress" style="width: 72%"></div>
                                    </div>
                                    <span>72%</span>
                                </div>
                                <div class="menu-item">
                                    <span>Ayam Pop</span>
                                    <div class="progress-bar">
                                        <div class="progress" style="width: 68%"></div>
                                    </div>
                                    <span>68%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Orders -->
                    <div class="recent-orders">
                        <h3>Pesanan Terbaru</h3>
                        <div class="table-container">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Pelanggan</th>
                                        <th>Menu</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="recent-orders-tbody">
                                    <?php foreach ($orders as $order): ?>
                                    <tr>
                                        <td>#<?php echo $order['id']; ?></td>
                                        <td><?php echo htmlspecialchars($order['customer_name'] ?: 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars($order['items']); ?></td>
                                        <td>Rp <?php echo number_format($order['total'], 0, ',', '.'); ?></td>
                                        <td><span class="status <?php echo strtolower($order['status']); ?>"><?php echo ucfirst($order['status']); ?></span></td>
                                        <td>
                                            <button class="btn-action view"><i class="fas fa-eye"></i></button>
                                            <button class="btn-action edit"><i class="fas fa-edit"></i></button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Menu Management Page -->
                <div id="menu-page" class="page-content">
                    <div class="crud-section">
                        <div class="section-header">
                            <h2 class="section-title">Kelola Menu Makanan</h2>
                            <button class="btn btn-primary" onclick="openMenuModal()">
                                <i class="fas fa-plus"></i>
                                Tambah Menu
                            </button>
                        </div>

                        <div class="filters-row">
                            <div class="filter-group">
                                <label class="filter-label">Kategori</label>
                                <select class="filter-select" id="menu-category-filter">
                                    <option value="">Semua Kategori</option>
                                    <option value="makanan">Makanan</option>
                                    <option value="minuman">Minuman</option>
                                    <option value="dessert">Dessert</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <label class="filter-label">Status</label>
                                <select class="filter-select" id="menu-status-filter">
                                    <option value="">Semua Status</option>
                                    <option value="tersedia">Tersedia</option>
                                    <option value="habis">Habis</option>
                                </select>
                            </div>
                            <input type="text" class="search-input" placeholder="Cari menu..." id="menu-search">
                        </div>

                        <div class="table-container">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Nama Menu</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="menu-table-body">
                                    <?php foreach ($menus as $menu): ?>
                                    <tr>
                                        <td><img src="<?php echo htmlspecialchars($menu['image'] ?: '../assets/images/placeholder.jpg'); ?>" alt="<?php echo htmlspecialchars($menu['name']); ?>" style="width: 50px; height: 50px; object-fit: cover;"></td>
                                        <td><?php echo htmlspecialchars($menu['name']); ?></td>
                                        <td><?php echo htmlspecialchars($menu['category']); ?></td>
                                        <td>Rp <?php echo number_format($menu['price'], 0, ',', '.'); ?></td>
                                        <td><span class="status <?php echo $menu['status'] === 'tersedia' ? 'completed' : 'cancelled'; ?>"><?php echo ucfirst($menu['status']); ?></span></td>
                                        <td><?php echo $menu['stock']; ?></td>
                                        <td>
                                            <button class="btn-action edit" onclick="editMenu(<?php echo $menu['id']; ?>)"><i class="fas fa-edit"></i></button>
                                            <button class="btn-action delete" onclick="deleteMenu(<?php echo $menu['id']; ?>)"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Orders Management Page -->
                <div id="orders-page" class="page-content">
                    <div class="crud-section">
                        <div class="section-header">
                            <h2 class="section-title">Kelola Pesanan</h2>
                            <div>
                                <button class="btn btn-success btn-sm" onclick="refreshOrders()">
                                    <i class="fas fa-sync-alt"></i>
                                    Refresh
                                </button>
                            </div>
                        </div>

                        <div class="filters-row">
                            <div class="filter-group">
                                <label class="filter-label">Status</label>
                                <select class="filter-select" id="order-status-filter">
                                    <option value="">Semua Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="processing">Diproses</option>
                                    <option value="ready">Siap</option>
                                    <option value="completed">Selesai</option>
                                    <option value="cancelled">Dibatalkan</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <label class="filter-label">Tanggal</label>
                                <input type="date" class="filter-select" id="order-date-filter">
                            </div>
                            <input type="text" class="search-input" placeholder="Cari pesanan..." id="order-search">
                        </div>

                        <div class="table-container">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>ID Pesanan</th>
                                        <th>Pelanggan</th>
                                        <th>Menu</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Waktu</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="orders-table-body">
                                    <?php foreach ($orders as $order): ?>
                                    <tr>
                                        <td>#<?php echo $order['id']; ?></td>
                                        <td><?php echo htmlspecialchars($order['customer_name'] ?: 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars($order['items']); ?></td>
                                        <td><?php echo $order['quantity'] ?? 1; ?></td>
                                        <td>Rp <?php echo number_format($order['total'], 0, ',', '.'); ?></td>
                                        <td><span class="status <?php echo strtolower($order['status']); ?>"><?php echo ucfirst($order['status']); ?></span></td>
                                        <td><?php echo date('d/m/Y H:i', strtotime($order['order_date'])); ?></td>
                                        <td>
                                            <button class="btn-action view" onclick="viewOrder(<?php echo $order['id']; ?>)"><i class="fas fa-eye"></i></button>
                                            <button class="btn-action edit" onclick="editOrder(<?php echo $order['id']; ?>)"><i class="fas fa-edit"></i></button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Promo Management Page -->
                <div id="promo-page" class="page-content">
                    <div class="crud-section">
                        <div class="section-header">
                            <h2 class="section-title">Kelola Promo & Diskon</h2>
                            <button class="btn btn-primary" onclick="openPromoModal()">
                                <i class="fas fa-plus"></i>
                                Tambah Promo
                            </button>
                        </div>

                        <div class="filters-row">
                            <div class="filter-group">
                                <label class="filter-label">Status</label>
                                <select class="filter-select" id="promo-status-filter">
                                    <option value="">Semua Status</option>
                                    <option value="active">Aktif</option>
                                    <option value="inactive">Tidak Aktif</option>
                                    <option value="expired">Kadaluarsa</option>
                                </select>
                            </div>
                            <input type="text" class="search-input" placeholder="Cari promo..." id="promo-search">
                        </div>

                        <div class="table-container">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Kode Promo</th>
                                        <th>Nama Promo</th>
                                        <th>Tipe</th>
                                        <th>Nilai</th>
                                        <th>Berlaku Sampai</th>
                                        <th>Status</th>
                                        <th>Digunakan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="promo-table-body">
                                    <?php foreach ($promos as $promo): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($promo['code']); ?></td>
                                        <td><?php echo htmlspecialchars($promo['name']); ?></td>
                                        <td><?php echo htmlspecialchars($promo['type']); ?></td>
                                        <td><?php echo $promo['type'] === 'percentage' ? $promo['value'] . '%' : 'Rp ' . number_format($promo['value'], 0, ',', '.'); ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($promo['end_date'])); ?></td>
                                        <td><span class="status <?php echo strtolower($promo['status']); ?>"><?php echo ucfirst($promo['status']); ?></span></td>
                                        <td><?php echo $promo['usage_count'] ?? 0; ?>/<?php echo $promo['max_usage'] ?? '∞'; ?></td>
                                        <td>
                                            <button class="btn-action edit" onclick="editPromo(<?php echo $promo['id']; ?>)"><i class="fas fa-edit"></i></button>
                                            <button class="btn-action delete" onclick="deletePromo(<?php echo $promo['id']; ?>)"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Inventory Management Page -->
                <div id="inventory-page" class="page-content">
                    <div class="crud-section">
                        <div class="section-header">
                            <h2 class="section-title">Kelola Inventory</h2>
                            <button class="btn btn-primary" onclick="openInventoryModal()">
                                <i class="fas fa-plus"></i>
                                Tambah Item
                            </button>
                        </div>

                        <div class="filters-row">
                            <div class="filter-group">
                                <label class="filter-label">Kategori</label>
                                <select class="filter-select" id="inventory-category-filter">
                                    <option value="">Semua Kategori</option>
                                    <option value="bahan-pokok">Bahan Pokok</option>
                                    <option value="bumbu">Bumbu</option>
                                    <option value="sayuran">Sayuran</option>
                                    <option value="daging">Daging</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <label class="filter-label">Status</label>
                                <select class="filter-select" id="inventory-status-filter">
                                    <option value="">Semua Status</option>
                                    <option value="aman">Stok Aman</option>
                                    <option value="menipis">Menipis</option>
                                    <option value="habis">Habis</option>
                                </select>
                            </div>
                            <input type="text" class="search-input" placeholder="Cari bahan..." id="inventory-search">
                        </div>

                        <div class="table-container">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Nama Bahan</th>
                                        <th>Kategori</th>
                                        <th>Stok</th>
                                        <th>Satuan</th>
                                        <th>Harga/Unit</th>
                                        <th>Status</th>
                                        <th>Terakhir Update</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="inventory-table-body">
                                    <?php foreach ($inventory as $item): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                                        <td><?php echo htmlspecialchars($item['category']); ?></td>
                                        <td><?php echo $item['stock']; ?></td>
                                        <td><?php echo htmlspecialchars($item['unit']); ?></td>
                                        <td>Rp <?php echo number_format($item['price_per_unit'], 0, ',', '.'); ?></td>
                                        <td><span class="status <?php echo strtolower($item['status']); ?>"><?php echo ucfirst($item['status']); ?></span></td>
                                        <td><?php echo date('d/m/Y H:i', strtotime($item['updated_at'])); ?></td>
                                        <td>
                                            <button class="btn-action edit" onclick="editInventory(<?php echo $item['id']; ?>)"><i class="fas fa-edit"></i></button>
                                            <button class="btn-action delete" onclick="deleteInventory(<?php echo $item['id']; ?>)"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Customers Management Page -->
                <div id="customers-page" class="page-content">
                    <div class="crud-section">
                        <div class="section-header">
                            <h2 class="section-title">Kelola Pelanggan</h2>
                        </div>

                        <div class="filters-row">
                            <input type="text" class="search-input" placeholder="Cari pelanggan..." id="customer-search">
                        </div>

                        <div class="table-container">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Telepon</th>
                                        <th>Total Pesanan</th>
                                        <th>Total Belanja</th>
                                        <th>Bergabung</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="customers-table-body">
                                    <?php foreach ($customers as $customer): ?>
                                    <tr>
                                        <td><?php echo $customer['id']; ?></td>
                                        <td><?php echo htmlspecialchars($customer['name']); ?></td>
                                        <td><?php echo htmlspecialchars($customer['email']); ?></td>
                                        <td><?php echo htmlspecialchars($customer['phone'] ?: '-'); ?></td>
                                        <td><?php echo $customer['total_orders']; ?></td>
                                        <td>Rp <?php echo number_format($customer['total_spent'], 0, ',', '.'); ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($customer['created_at'])); ?></td>
                                        <td>
                                            <button class="btn-action view" onclick="viewCustomer(<?php echo $customer['id']; ?>)"><i class="fas fa-eye"></i></button>
                                            <button class="btn-action edit" onclick="editCustomer(<?php echo $customer['id']; ?>)"><i class="fas fa-edit"></i></button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Reports Page -->
                <div id="reports-page" class="page-content">
                    <div class="crud-section">
                        <div class="section-header">
                            <h2 class="section-title">Laporan Penjualan</h2>
                        </div>

                        <div class="charts-section">
                            <div class="chart-card">
                                <h3>Grafik Penjualan Bulanan</h3>
                                <div class="chart-container">
                                    <p>📈 Grafik penjualan akan diimplementasikan dengan Chart.js</p>
                                </div>
                            </div>
                            <div class="chart-card">
                                <h3>Top 10 Menu Terlaris</h3>
                                <div class="chart-container">
                                    <p>📊 Chart top menu akan diimplementasikan</p>
                                </div>
                            </div>
                        </div>

                        <div class="stats-grid">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <div class="stat-info">
                                    <h3>Rp 45.2M</h3>
                                    <p>Pendapatan Bulan Ini</p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-shopping-bag"></i>
                                </div>
                                <div class="stat-info">
                                    <h3>1,245</h3>
                                    <p>Total Pesanan</p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="stat-info">
                                    <h3>156</h3>
                                    <p>Pelanggan Baru</p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-percent"></i>
                                </div>
                                <div class="stat-info">
                                    <h3>12.5%</h3>
                                    <p>Pertumbuhan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modals -->
    <!-- Menu Modal -->
    <div id="menuModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="menuModalTitle">Tambah Menu Baru</h3>
                <span class="close" onclick="closeMenuModal()">&times;</span>
            </div>
            <form id="menuForm">
                <input type="hidden" id="menuId">
                <div class="form-group">
                    <label class="form-label">Nama Menu</label>
                    <input type="text" class="form-control" id="menuName" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Kategori</label>
                        <select class="form-control" id="menuCategory" required>
                            <option value="">Pilih Kategori</option>
                            <option value="makanan">Makanan</option>
                            <option value="minuman">Minuman</option>
                            <option value="dessert">Dessert</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Harga (Rp)</label>
                        <input type="number" class="form-control" id="menuPrice" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="menuDescription" rows="3"></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Stok</label>
                        <input type="number" class="form-control" id="menuStock" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select class="form-control" id="menuStatus" required>
                            <option value="tersedia">Tersedia</option>
                            <option value="habis">Habis</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Foto Menu</label>
                    <input type="file" class="form-control" id="menuImage" accept="image/*">
                </div>
                <div style="display: flex; gap: 10px; justify-content: flex-end;">
                    <button type="button" class="btn btn-secondary" onclick="closeMenuModal()">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Order Detail Modal -->
    <div id="orderModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Detail Pesanan</h3>
                <span class="close" onclick="closeOrderModal()">&times;</span>
            </div>
            <div id="orderDetails">
                <!-- Order details will be loaded here -->
            </div>
        </div>
    </div>

    <!-- Promo Modal -->
    <div id="promoModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="promoModalTitle">Tambah Promo Baru</h3>
                <span class="close" onclick="closePromoModal()">&times;</span>
            </div>
            <form id="promoForm">
                <input type="hidden" id="promoId">
                <div class="form-group">
                    <label class="form-label">Nama Promo</label>
                    <input type="text" class="form-control" id="promoName" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Kode Promo</label>
                        <input type="text" class="form-control" id="promoCode" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tipe Diskon</label>
                        <select class="form-control" id="promoType" required>
                            <option value="">Pilih Tipe</option>
                            <option value="percentage">Persentase (%)</option>
                            <option value="fixed">Nominal (Rp)</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Nilai Diskon</label>
                    <input type="number" class="form-control" id="promoValue" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="promoStartDate" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tanggal Berakhir</label>
                        <input type="date" class="form-control" id="promoEndDate" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Batas Penggunaan</label>
                        <input type="number" class="form-control" id="promoLimit">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Min. Pembelian (Rp)</label>
                        <input type="number" class="form-control" id="promoMinPurchase">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="promoDescription" rows="3"></textarea>
                </div>
                <div style="display: flex; gap: 10px; justify-content: flex-end;">
                    <button type="button" class="btn btn-secondary" onclick="closePromoModal()">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Inventory Modal -->
    <div id="inventoryModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="inventoryModalTitle">Tambah Item Inventory</h3>
                <span class="close" onclick="closeInventoryModal()">&times;</span>
            </div>
            <form id="inventoryForm">
                <input type="hidden" id="inventoryId">
                <div class="form-group">
                    <label class="form-label">Nama Bahan</label>
                    <input type="text" class="form-control" id="inventoryName" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Kategori</label>
                        <select class="form-control" id="inventoryCategory" required>
                            <option value="">Pilih Kategori</option>
                            <option value="bahan-pokok">Bahan Pokok</option>
                            <option value="bumbu">Bumbu</option>
                            <option value="sayuran">Sayuran</option>
                            <option value="daging">Daging</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Satuan</label>
                        <select class="form-control" id="inventoryUnit" required>
                            <option value="">Pilih Satuan</option>
                            <option value="kg">Kilogram (kg)</option>
                            <option value="liter">Liter</option>
                            <option value="pcs">Pieces</option>
                            <option value="pack">Pack</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Stok</label>
                        <input type="number" class="form-control" id="inventoryStock" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Harga per Unit (Rp)</label>
                        <input type="number" class="form-control" id="inventoryPrice" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Batas Minimum Stok</label>
                    <input type="number" class="form-control" id="inventoryMinStock" required>
                </div>
                <div style="display: flex; gap: 10px; justify-content: flex-end;">
                    <button type="button" class="btn btn-secondary" onclick="closeInventoryModal()">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <!-- JavaScript untuk Sidebar dan Modal -->
    <script src="../logic/dashboard_admin.js"></script> 
</body>
</html>