-- E-Commerce Database Schema

CREATE DATABASE IF NOT EXISTS ecommerce_db;
USE ecommerce_db;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    city VARCHAR(50),
    state VARCHAR(50),
    pincode VARCHAR(10),
    is_admin BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Categories table
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    description TEXT,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Products table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    name VARCHAR(200) NOT NULL,
    slug VARCHAR(200) UNIQUE NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    discount_price DECIMAL(10, 2),
    stock INT DEFAULT 0,
    image VARCHAR(255),
    images TEXT,
    featured BOOLEAN DEFAULT FALSE,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

-- Orders table
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    order_number VARCHAR(50) UNIQUE NOT NULL,
    total_amount DECIMAL(10, 2) NOT NULL,
    status ENUM('pending', 'processing', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending',
    payment_method VARCHAR(50),
    payment_status ENUM('pending', 'completed', 'failed') DEFAULT 'pending',
    shipping_address TEXT,
    shipping_city VARCHAR(50),
    shipping_state VARCHAR(50),
    shipping_pincode VARCHAR(10),
    shipping_phone VARCHAR(20),
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Order items table
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Reviews table
CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    user_id INT NOT NULL,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Wishlist table
CREATE TABLE IF NOT EXISTS wishlist (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    UNIQUE KEY unique_wishlist (user_id, product_id)
);

-- Insert default admin user (password: admin123)
INSERT INTO users (name, email, password, is_admin)
VALUES ('Admin', 'admin@ecommerce.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', TRUE);

-- Insert sample categories
INSERT INTO categories (name, slug, description) VALUES
('Electronics', 'electronics', 'Electronic devices and gadgets'),
('Fashion', 'fashion', 'Clothing and accessories'),
('Home & Kitchen', 'home-kitchen', 'Home and kitchen appliances'),
('Books', 'books', 'Books and magazines'),
('Sports', 'sports', 'Sports equipment and accessories'),
('Beauty', 'beauty', 'Beauty and personal care products');

-- Insert sample products
INSERT INTO products (category_id, name, slug, description, price, discount_price, stock, featured) VALUES
(1, 'Wireless Headphones', 'wireless-headphones', 'High-quality wireless headphones with noise cancellation', 2999.00, 2499.00, 50, TRUE),
(1, 'Smart Watch', 'smart-watch', 'Feature-rich smartwatch with fitness tracking', 4999.00, 3999.00, 30, TRUE),
(1, 'Bluetooth Speaker', 'bluetooth-speaker', 'Portable bluetooth speaker with premium sound', 1999.00, 1499.00, 40, FALSE),
(2, 'Men Casual Shirt', 'men-casual-shirt', 'Premium cotton casual shirt', 799.00, 599.00, 100, FALSE),
(2, 'Women Dress', 'women-dress', 'Elegant party wear dress', 1499.00, 999.00, 50, TRUE),
(3, 'Coffee Maker', 'coffee-maker', 'Automatic coffee maker with timer', 3499.00, 2999.00, 20, FALSE),
(3, 'Mixer Grinder', 'mixer-grinder', 'Powerful mixer grinder with 3 jars', 2499.00, 1999.00, 25, FALSE),
(4, 'Self Help Book', 'self-help-book', 'Bestselling self-help book', 299.00, 249.00, 150, FALSE);
