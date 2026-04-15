CREATE DATABASE db_humas;
USE db_humas;

CREATE TABLE admin (
 id INT AUTO_INCREMENT PRIMARY KEY,
 username VARCHAR(50),
 password VARCHAR(50)
);
INSERT INTO admin VALUES(null,'admin','admin123');

CREATE TABLE berita (
 id INT AUTO_INCREMENT PRIMARY KEY,
 judul VARCHAR(255),
 isi TEXT,
 gambar VARCHAR(255),
 tanggal DATE,
 kategori VARCHAR(100)
);
