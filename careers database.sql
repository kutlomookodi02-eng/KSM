CREATE DATABASE careers_db;
USE careers_db;
CREATE TABLE applicants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    position VARCHAR(50),
    cover_letter TEXT,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
create table HR(
Id int auto_increment Primary key,
position varchar(50) NOT NULL,
requirements Text
);