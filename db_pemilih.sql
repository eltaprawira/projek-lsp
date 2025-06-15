CREATE TABLE pemilih (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nis VARCHAR(50) NOT NULL UNIQUE,
  nama VARCHAR(100),
  jurusan VARCHAR(100),
  kelas VARCHAR(50),
  status_memilih VARCHAR(50),
  kode_akses VARCHAR(10) UNIQUE
);