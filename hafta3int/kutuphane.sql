CREATE DATABASE kutuphane CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE kutuphane;

CREATE TABLE kullanicilar (
  id INT AUTO_INCREMENT PRIMARY KEY,
  kullanici_adi VARCHAR(50) NOT NULL UNIQUE,
  sifre VARCHAR(255) NOT NULL,
  rol ENUM('admin', 'uye') DEFAULT 'uye',
  kayit_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Örnek admin
INSERT INTO kullanicilar (kullanici_adi, sifre, rol) VALUES
('admin', MD5('1234'), 'admin'),
('ahmet', MD5('1234'), 'uye');
