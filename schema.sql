-- Run on the VM:  sudo mysql < schema.sql
CREATE DATABASE IF NOT EXISTS CAT2;

-- Replace YourPass123 with a real password (same one goes in config.php)
CREATE USER IF NOT EXISTS 'terence'@'localhost' IDENTIFIED BY 'YourPass123';
GRANT ALL PRIVILEGES ON CAT2.* TO 'terence'@'localhost';
FLUSH PRIVILEGES;

USE CAT2;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  full_name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS feedback (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  course VARCHAR(100) NOT NULL,
  rating TINYINT NOT NULL,
  comments TEXT NOT NULL,
  submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id)
);
