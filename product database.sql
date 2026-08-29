create database PRODUCTS;
USE PRODUCTS;
create table products(
    product_id INT AUTO_INCREMENT PRIMARY KEY,
        category_id VARCHAR(150) NOT NULL,
    price DECIMAL(10, 2) NOT NULL, -- Format: 00000000.00
    stock_quantity INT DEFAULT 0
);
create table categories(
category_id INT AUTO_INCREMENT Primary Key, 
category_name VARCHAR(120)
);
