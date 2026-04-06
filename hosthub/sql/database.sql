-- HostHub Database Schema
-- Create database
CREATE DATABASE IF NOT EXISTS hosthub_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE hosthub_db;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    is_active TINYINT(1) DEFAULT 1,
    is_admin TINYINT(1) DEFAULT 0,
    INDEX idx_email (email),
    INDEX idx_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Hosting plans table
CREATE TABLE IF NOT EXISTS hosting_plans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    plan_name VARCHAR(50) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    billing_cycle ENUM('monthly', 'yearly') NOT NULL,
    disk_space VARCHAR(20) NOT NULL,
    bandwidth VARCHAR(20) NOT NULL,
    domains INT NOT NULL,
    email_accounts INT NOT NULL,
    databases INT NOT NULL,
    ssl_certificate TINYINT(1) DEFAULT 1,
    backup TINYINT(1) DEFAULT 1,
    support_level VARCHAR(20) NOT NULL,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Orders table
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    plan_id INT NOT NULL,
    domain_name VARCHAR(100) NOT NULL,
    order_status ENUM('pending', 'active', 'suspended', 'cancelled') DEFAULT 'pending',
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    activation_date TIMESTAMP NULL,
    expiry_date TIMESTAMP NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    payment_status ENUM('pending', 'paid', 'failed') DEFAULT 'pending',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (plan_id) REFERENCES hosting_plans(id) ON DELETE RESTRICT,
    INDEX idx_user_id (user_id),
    INDEX idx_order_status (order_status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Contact messages table
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'replied') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default hosting plans
INSERT INTO hosting_plans (plan_name, price, billing_cycle, disk_space, bandwidth, domains, email_accounts, databases, support_level) VALUES
('Starter', 4.99, 'monthly', '10 GB', '100 GB', 1, 5, 2, 'Email'),
('Business', 9.99, 'monthly', '50 GB', '500 GB', 5, 25, 10, '24/7 Chat'),
('Professional', 19.99, 'monthly', '100 GB', 'Unlimited', 10, 100, 25, '24/7 Phone'),
('Enterprise', 49.99, 'monthly', '500 GB', 'Unlimited', 50, 500, 100, 'Dedicated Manager');

-- Insert default admin user (password: admin123 - hashed with bcrypt)
INSERT INTO users (username, email, password, full_name, is_admin) VALUES
('admin', 'admin@hosthub.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'System Administrator', 1);
