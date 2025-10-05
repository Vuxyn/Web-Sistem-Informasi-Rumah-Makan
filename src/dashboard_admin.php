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
                <a href="sign_up.php" class="logout-btn">
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
                                <h3 id="total-orders">156</h3>
                                <p>Total Pesanan Hari Ini</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div class="stat-info">
                                <h3 id="total-revenue">Rp 12.5M</h3>
                                <p>Pendapatan Hari Ini</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-utensils"></i>
                            </div>
                            <div class="stat-info">
                                <h3 id="menu-items">45</h3>
                                <p>Menu Tersedia</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-info">
                                <h3 id="active-customers">89</h3>
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
                                    <tr>
                                        <td>#001</td>
                                        <td>Budi Santoso</td>
                                        <td>Rendang + Nasi</td>
                                        <td>Rp 25.000</td>
                                        <td><span class="status pending">Pending</span></td>
                                        <td>
                                            <button class="btn-action view"><i class="fas fa-eye"></i></button>
                                            <button class="btn-action edit"><i class="fas fa-edit"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>#002</td>
                                        <td>Siti Aminah</td>
                                        <td>Gulai Ayam + Nasi</td>
                                        <td>Rp 22.000</td>
                                        <td><span class="status completed">Selesai</span></td>
                                        <td>
                                            <button class="btn-action view"><i class="fas fa-eye"></i></button>
                                            <button class="btn-action edit"><i class="fas fa-edit"></i></button>
                                        </td>
                                    </tr>
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
                                    <!-- Data akan diisi oleh JavaScript -->
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
                                    <!-- Data akan diisi oleh JavaScript -->
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
                                    <!-- Data akan diisi oleh JavaScript -->
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
                                    <!-- Data akan diisi oleh JavaScript -->
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
                                    <!-- Data akan diisi oleh JavaScript -->
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