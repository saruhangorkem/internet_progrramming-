-- Library Management System Database Schema
-- Bu dosyayı phpMyAdmin'e aktarın veya MySQL komut satırı üzerinden çalıştırın.

-- Veritabanını oluştur ve kullan
CREATE DATABASE IF NOT EXISTS library_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE library_db;

-- Users table (Normal Kullanıcılar)
CREATE TABLE IF NOT EXISTS users (
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(50) UNIQUE NOT NULL,
password VARCHAR(255) NOT NULL, -- Şifre hash'leri için 255 karakter
email VARCHAR(100) DEFAULT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Admins table (Yöneticiler)
CREATE TABLE IF NOT EXISTS admins (
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(50) UNIQUE NOT NULL,
password VARCHAR(255) NOT NULL, -- Şifre hash'leri için
email VARCHAR(100) DEFAULT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Library books table (Merkezi Kütüphane Arşivi)
CREATE TABLE IF NOT EXISTS library_books (
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(255) NOT NULL,
author VARCHAR(255) NOT NULL,
year VARCHAR(10) DEFAULT NULL, -- Yayın Yılı
category VARCHAR(100) DEFAULT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- User books table (Kullanıcıların Kişisel Listeleri)
-- user_id ve library_book_id arasında bir bileşik benzersizlik indeksi (UNIQUE INDEX) tanımlamak,
-- bir kullanıcının aynı kitabı iki kez eklemesini engeller.
CREATE TABLE IF NOT EXISTS user_books (
id INT AUTO_INCREMENT PRIMARY KEY,
user_id INT NOT NULL,
library_book_id INT NOT NULL,
added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

UNIQUE KEY user_book_unique (user_id, library_book_id), -- Mükerrer kaydı engeller

FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
FOREIGN KEY (library_book_id) REFERENCES library_books(id) ON DELETE CASCADE


) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Announcements table (Duyurular)
CREATE TABLE IF NOT EXISTS announcements (
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(255) NOT NULL,
content TEXT NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Başlangıç Verileri

-- Insert default admin account (username: admin, password: admin123)
-- Hash: $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
INSERT INTO admins (username, password, email) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@library.com')
ON DUPLICATE KEY UPDATE password=password; -- Eğer admin zaten varsa şifresini koru

-- Insert sample books
INSERT INTO library_books (title, author, year, category) VALUES
('Algoritmalar ve Veri Yapıları', 'A. Yazar', '2020', 'Bilgisayar'),
('İleri Programlama', 'B. Yazar', '2019', 'Bilgisayar'),
('Veritabanı Sistemleri', 'C. Yazar', '2021', 'Bilgisayar'),
('Web Programlama', 'D. Yazar', '2022', 'Bilgisayar'),
('Yapay Zeka', 'E. Yazar', '2023', 'Bilgisayar')
ON DUPLICATE KEY UPDATE title=title; -- Zaten varsa güncellemeyi engelle (sadece başlangıç verisi olduğu için)