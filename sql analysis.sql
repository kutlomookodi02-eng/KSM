CREATE DATABASE KSM;
USE KSM;

CREATE TABLE management (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    size VARCHAR(100) NOT NULL,
colour varchar(70) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    quantity_available INT NOT NULL,
    quantity_sold INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);