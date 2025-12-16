
-- Database schema for sofa_online
CREATE DATABASE IF NOT EXISTS sofa_online;
USE sofa_online;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255),
  role ENUM('admin','customer') DEFAULT 'customer',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(200),
  description TEXT,
  price INT,
  discount INT DEFAULT 0,
  category VARCHAR(50),
  size VARCHAR(50),
  shape VARCHAR(50),
  stock INT DEFAULT 0,
  image VARCHAR(255)
);

CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  total INT,
  payment_method ENUM('tunai','transfer','cicilan') DEFAULT 'transfer',
  status ENUM('pending','paid','processing','delivering','done') DEFAULT 'pending',
  address TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE order_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT,
  product_id INT,
  quantity INT,
  price INT,
  FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
  FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE SET NULL
);

CREATE TABLE pickup_delivery (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  type ENUM('antar','jemput','retur') DEFAULT 'antar',
  address TEXT,
  schedule_date DATE,
  schedule_time TIME,
  driver VARCHAR(100),
  status ENUM('pending','accepted','on_the_way','done') DEFAULT 'pending',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE pickups (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(150) NOT NULL,
    customer_phone VARCHAR(50),
    customer_address TEXT,
    product_id INT,
    pickup_date DATE,
    status VARCHAR(50) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- sample admin user (password 'admin' plain, change after import)
INSERT INTO users (name, email, password, role) VALUES ('Admin','admin@sofa.test', 'admin', 'admin');

-- sample products
INSERT INTO products (name, description, price, discount, category, size, shape, stock, image) VALUES
('Sofa L-Shape Nordic','Sofa L-shape minimalis, kain lembut', 4500000, 0, 'sofa', '3-seater', 'L-shape', 5, 'sofa1.jpg'),
('Sofa Panjang Modern','Sofa panjang 2-seater, kayu solid', 3200000, 10, 'sofa', '2-seater', 'panjang', 3, 'sofa2.jpg');
