-- =============================================================================
-- FILE: queries.sql (SQL Server / T-SQL Version)
-- Proyek: AsprakNotesPAW
-- Deskripsi: Script SQL bersih (DDL, Dummy Data, dan DML) untuk SQL Server.
-- =============================================================================

-- =============================================================================
-- SECTION 1: DATA DEFINITION LANGUAGE (DDL) - PEMBUATAN TABEL & RELASI
-- =============================================================================

-- Hapus tabel jika sudah ada (urut berdasarkan dependensi untuk menghindari error foreign key)
IF OBJECT_ID('dbo.transfers', 'U') IS NOT NULL DROP TABLE dbo.transfers;
IF OBJECT_ID('dbo.absensis', 'U') IS NOT NULL DROP TABLE dbo.absensis;
IF OBJECT_ID('dbo.modul', 'U') IS NOT NULL DROP TABLE dbo.modul;
IF OBJECT_ID('dbo.users', 'U') IS NOT NULL DROP TABLE dbo.users;

-- 1. Membuat Tabel users
CREATE TABLE users (
  id bigint NOT NULL IDENTITY(1,1),
  name varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  role varchar(255) NOT NULL DEFAULT 'asprak',
  email_verified_at datetime NULL DEFAULT NULL,
  password varchar(255) NOT NULL,
  remember_token varchar(100) DEFAULT NULL,
  created_at datetime NULL DEFAULT NULL,
  updated_at datetime NULL DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT users_email_unique UNIQUE (email)
);

-- 2. Membuat Tabel modul
CREATE TABLE modul (
  id bigint NOT NULL IDENTITY(1,1),
  nama varchar(255) NOT NULL,
  deskripsi text NOT NULL,
  gambar varchar(255) DEFAULT NULL,
  gaji decimal(12,2) NOT NULL DEFAULT 0.00,
  created_at datetime NULL DEFAULT NULL,
  updated_at datetime NULL DEFAULT NULL,
  PRIMARY KEY (id)
);

-- 3. Membuat Tabel absensis
CREATE TABLE absensis (
  id bigint NOT NULL IDENTITY(1,1),
  user_id bigint NOT NULL,
  modul_id bigint NOT NULL,
  kelas varchar(255) NOT NULL,
  bukti_absensi varchar(255) DEFAULT NULL,
  status varchar(50) NOT NULL DEFAULT 'menunggu',
  tanggal date NOT NULL,
  created_at datetime NULL DEFAULT NULL,
  updated_at datetime NULL DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT fk_absensis_modul FOREIGN KEY (modul_id) REFERENCES modul (id) ON DELETE CASCADE,
  CONSTRAINT fk_absensis_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
  CONSTRAINT chk_absensis_status CHECK (status IN ('menunggu', 'diproses', 'disetujui', 'ditolak'))
);

-- 4. Membuat Tabel transfers
CREATE TABLE transfers (
  id bigint NOT NULL IDENTITY(1,1),
  user_id bigint NOT NULL,
  nominal decimal(12,2) NOT NULL,
  keterangan varchar(255) DEFAULT NULL,
  tanggal date NOT NULL,
  status varchar(50) NOT NULL DEFAULT 'selesai',
  absensi_id bigint DEFAULT NULL,
  created_at datetime NULL DEFAULT NULL,
  updated_at datetime NULL DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT fk_transfers_absensi FOREIGN KEY (absensi_id) REFERENCES absensis (id) ON DELETE SET NULL,
  CONSTRAINT fk_transfers_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE NO ACTION, -- Menggunakan NO ACTION untuk mencegah multiple cascade paths di SQL Server
  CONSTRAINT chk_transfers_status CHECK (status IN ('selesai'))
);


-- =============================================================================
-- SECTION 2: DATA MANIPULATION LANGUAGE (DML) - INSERT DATA DUMMY
-- =============================================================================

-- Pastikan IDENTITY_INSERT diaktifkan jika ingin memasukkan ID manual
SET IDENTITY_INSERT users ON;
INSERT INTO users (id, name, email, role, password, created_at, updated_at) VALUES
(1, 'Admin Utama', 'admin@example.com', 'admin', '$2y$12$t41kR5Nl5B24H1Ld517c5eG2UaP/Q/1B2C3d4e5f6g7h8i9j0k1l2', GETDATE(), GETDATE()),
(2, 'Ahmad Fauzi', 'ahmad@example.com', 'asprak', '$2y$12$t41kR5Nl5B24H1Ld517c5eG2UaP/Q/1B2C3d4e5f6g7h8i9j0k1l2', GETDATE(), GETDATE()),
(3, 'Siti Aminah', 'siti@example.com', 'asprak', '$2y$12$t41kR5Nl5B24H1Ld517c5eG2UaP/Q/1B2C3d4e5f6g7h8i9j0k1l2', GETDATE(), GETDATE());
SET IDENTITY_INSERT users OFF;

SET IDENTITY_INSERT modul ON;
INSERT INTO modul (id, nama, deskripsi, gambar, gaji, created_at, updated_at) VALUES
(1, 'Pemrograman Aplikasi Web', 'Praktikum dasar-dasar Laravel dan PHP', 'paw.png', 150000.00, GETDATE(), GETDATE()),
(2, 'Basis Data', 'Praktikum perancangan SQL dan normalisasi data', 'db.png', 125000.00, GETDATE(), GETDATE()),
(3, 'Desain UI/UX', 'Praktikum prototyping aplikasi menggunakan Figma', 'uiux.png', 135000.00, GETDATE(), GETDATE());
SET IDENTITY_INSERT modul OFF;

SET IDENTITY_INSERT absensis ON;
INSERT INTO absensis (id, user_id, modul_id, kelas, bukti_absensi, status, tanggal, created_at, updated_at) VALUES
(1, 2, 1, 'PAW Kelas A', 'bukti/absensi1.png', 'disetujui', '2026-06-01', GETDATE(), GETDATE()),
(2, 2, 2, 'BD Kelas B', 'bukti/absensi2.png', 'disetujui', '2026-06-02', GETDATE(), GETDATE()),
(3, 3, 1, 'PAW Kelas C', 'bukti/absensi3.png', 'menunggu', '2026-06-03', GETDATE(), GETDATE()),
(4, 3, 3, 'UI/UX Kelas D', 'bukti/absensi4.png', 'disetujui', '2026-06-04', GETDATE(), GETDATE());
SET IDENTITY_INSERT absensis OFF;

SET IDENTITY_INSERT transfers ON;
INSERT INTO transfers (id, user_id, nominal, keterangan, tanggal, status, absensi_id, created_at, updated_at) VALUES
(1, 2, 150000.00, 'Gaji PAW Kelas A', '2026-06-03', 'selesai', 1, GETDATE(), GETDATE()),
(2, 2, 125000.00, 'Gaji BD Kelas B', '2026-06-04', 'selesai', 2, GETDATE(), GETDATE());
SET IDENTITY_INSERT transfers OFF;


-- =============================================================================
-- SECTION 3: QUERY SELEKSI & OPERASI APLIKASI (T-SQL)
-- =============================================================================

-- QUERY 1: Menambahkan User Baru
INSERT INTO users (name, email, role, password, created_at, updated_at) 
VALUES ('John Doe', 'john@example.com', 'asprak', '$2y$12$hashedpassword...', GETDATE(), GETDATE());

-- QUERY 2: Mengambil Semua User dengan Role 'asprak'
SELECT id, name, email FROM users WHERE role = 'asprak';

-- QUERY 3: Menambahkan Modul Baru
INSERT INTO modul (nama, deskripsi, gambar, gaji, created_at, updated_at) 
VALUES ('Desain UI/UX', 'Modul pembuatan prototype Figma', 'modul_uiux.png', 150000.00, GETDATE(), GETDATE());

-- QUERY 4: Memperbarui Informasi Modul
UPDATE modul SET nama = 'Desain UI/UX Modern', gaji = 175000.00, updated_at = GETDATE() WHERE id = 5;

-- QUERY 5: Mengajukan Absensi Mengajar Baru (Asprak)
INSERT INTO absensis (user_id, modul_id, kelas, bukti_absensi, status, tanggal, created_at, updated_at) 
VALUES (2, 1, 'PAW B', 'bukti_absensi/photo.jpg', 'menunggu', '2026-06-04', GETDATE(), GETDATE());

-- QUERY 6: Memverifikasi / Mengubah Status Absensi (Admin)
UPDATE absensis SET status = 'disetujui', updated_at = GETDATE() WHERE id = 12;

-- QUERY 7: Mencatat Transfer Baru (Admin)
INSERT INTO transfers (user_id, absensi_id, nominal, keterangan, tanggal, status, created_at, updated_at) 
VALUES (2, 12, 150000.00, 'Gaji Modul 1 Kelas PAW B', '2026-06-04', 'selesai', GETDATE(), GETDATE());

-- QUERY 8: Menampilkan riwayat absensi lengkap dengan nama Asisten & nama Modul (Admin Dashboard)
SELECT 
  a.id AS absensi_id,
  u.name AS nama_asprak,
  m.nama AS nama_modul,
  a.kelas,
  a.status,
  a.tanggal,
  a.bukti_absensi
FROM absensis a
INNER JOIN users u ON a.user_id = u.id
INNER JOIN modul m ON a.modul_id = m.id
ORDER BY a.tanggal DESC, a.created_at DESC;

-- QUERY 9: Menampilkan riwayat absensi milik Asisten tertentu (misal: ID Asprak = 2)
SELECT 
  a.id AS absensi_id,
  m.nama AS nama_modul,
  a.kelas,
  a.status,
  a.tanggal
FROM absensis a
INNER JOIN modul m ON a.modul_id = m.id
WHERE a.user_id = 2
ORDER BY a.tanggal DESC, a.created_at DESC;

-- QUERY 10: Menampilkan daftar absensi yang BELUM ditransfer gaji
SELECT 
  a.id AS absensi_id,
  a.tanggal,
  a.kelas,
  u.name AS nama_asprak,
  m.nama AS nama_modul,
  m.gaji AS nominal_gaji
FROM absensis a
INNER JOIN users u ON a.user_id = u.id
INNER JOIN modul m ON a.modul_id = m.id
LEFT JOIN transfers t ON a.id = t.absensi_id AND t.status = 'selesai'
WHERE t.id IS NULL
ORDER BY a.tanggal DESC;

-- QUERY 11: Laporan total nominal gaji yang sudah diterima per Asisten
SELECT 
  u.id AS user_id,
  u.name AS nama_asprak,
  ISNULL(SUM(t.nominal), 0) AS total_gaji_diterima
FROM users u
LEFT JOIN transfers t ON u.id = t.user_id AND t.status = 'selesai'
WHERE u.role = 'asprak'
GROUP BY u.id, u.name
ORDER BY total_gaji_diterima DESC;

-- QUERY 12: Statistik Dashboard Utama Admin (Total Modul, Absensi, dan User)
SELECT 
  (SELECT COUNT(*) FROM modul) AS total_modul,
  (SELECT COUNT(*) FROM absensis) AS total_absensi,
  (SELECT COUNT(*) FROM users) AS total_user;
