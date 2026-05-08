CREATE DATABASE IF NOT EXISTS db_personalweb;
USE db_personalweb;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    role VARCHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS level (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS studies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    idlevel INT NOT NULL,
    keterangan TEXT,
    tahun_lulus YEAR,
    foto_sekolah VARCHAR(255),
    FOREIGN KEY (idlevel) REFERENCES level(id) ON DELETE CASCADE
);

-- Insert dummy data
INSERT INTO users (username, password, nama, role) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'Admin'); 
-- password is 'password'

INSERT INTO level (nama) VALUES ('TK'), ('SD'), ('SMP'), ('SMA'), ('S1');
