CREATE DATABASE IF NOT EXISTS u964374799_eden;
USE u964374799_eden;

CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    type ENUM('basic', 'image', 'scheduled', 'subtitle') NOT NULL,
    image_url VARCHAR(255) NULL,
    scheduled_at DATETIME NULL,
    subtitle VARCHAR(255) NULL,
    status VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Add admin user (password: admineden)
INSERT INTO users (username, password, email) 
VALUES ('admin', '$2y$10$3tN4tCb7X8J.q.7x8/G9/.YBxEZwmsF7KiCrwqV.IHqYHwqyRnIeO', 'admin@eden.com')
ON DUPLICATE KEY UPDATE 
    password = '$2y$10$3tN4tCb7X8J.q.7x8/G9/.YBxEZwmsF7KiCrwqV.IHqYHwqyRnIeO'; 