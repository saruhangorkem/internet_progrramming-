-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 14 Kas 2025, 18:23:57
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `ogrenci_yonetim`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenciler`
--

CREATE TABLE `ogrenciler` (
  `id` int(11) NOT NULL,
  `ad` varchar(100) NOT NULL,
  `soyad` varchar(100) NOT NULL,
  `ogrenci_no` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefon` varchar(20) DEFAULT NULL,
  `bolum` varchar(100) NOT NULL,
  `sinif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `ogrenciler`
--

INSERT INTO `ogrenciler` (`id`, `ad`, `soyad`, `ogrenci_no`, `email`, `telefon`, `bolum`, `sinif`) VALUES
(1, 'Ahmet', 'Yılmaz', '1001', 'ahmet@mail.com', '5551112233', 'Bilgisayar Mühendisliği', 2),
(2, 'Elif', 'Kaya', '1002', 'elif@mail.com', '5552223344', 'Endüstri Mühendisliği', 3),
(3, 'Mehmet', 'Demir', '1003', 'mehmet@mail.com', '5553334455', 'Makine Mühendisliği', 1),
(4, 'Zeynep', 'Avcı', '1004', 'zeynep@mail.com', '5554445566', 'Bilgisayar Mühendisliği', 4),
(5, 'Mustafa', 'Çelik', '1005', 'mustafa@mail.com', '5555556677', 'İşletme', 2),
(6, 'Ayşe', 'Güneş', '1006', 'ayse@mail.com', '5556667788', 'Hukuk', 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ogrenciler`
--
ALTER TABLE `ogrenciler`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ogrenci_no` (`ogrenci_no`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ogrenciler`
--
ALTER TABLE `ogrenciler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
