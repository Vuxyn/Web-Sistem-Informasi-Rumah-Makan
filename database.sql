-- Database creation script for RM Padang Restaurant Information System

-- Create database
CREATE DATABASE IF NOT EXISTS rm_padang;
USE rm_padang;

-- Users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    phone VARCHAR(20),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Menus table
CREATE TABLE menus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category ENUM('makanan', 'minuman', 'dessert') NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    stock INT DEFAULT 0,
    status ENUM('tersedia', 'habis') DEFAULT 'tersedia',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Orders table
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    total DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'processing', 'ready', 'completed', 'cancelled') DEFAULT 'pending',
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES users(id)
);

-- Order items table
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    menu_id INT,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (menu_id) REFERENCES menus(id)
);

-- Inventory table
CREATE TABLE inventory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category ENUM('bahan-pokok', 'bumbu', 'sayuran', 'daging') NOT NULL,
    stock DECIMAL(10,2) NOT NULL,
    unit VARCHAR(20) NOT NULL,
    price_per_unit DECIMAL(10,2),
    min_stock DECIMAL(10,2) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Promo table
CREATE TABLE promos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    code VARCHAR(50) UNIQUE,
    type ENUM('percentage', 'fixed') NOT NULL,
    value DECIMAL(10,2) NOT NULL,
    start_date DATE,
    end_date DATE,
    limit_usage INT,
    min_purchase DECIMAL(10,2),
    description TEXT,
    status ENUM('active', 'inactive', 'expired') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample admin user
INSERT INTO users (name, email, password, role) VALUES
('Admin RM Padang', 'admin@rmpadang.com', '$2y$10$hashedpassword', 'admin');

