-- =============================================================================
-- FILE: create_tables.sql (SQL Server / T-SQL Version)
-- Deskripsi: Hanya berisi query pembuatan tabel (CREATE TABLE) untuk SQL Server.
-- =============================================================================

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
  CONSTRAINT fk_transfers_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE NO ACTION, -- Mencegah multiple cascade paths di SQL Server
  CONSTRAINT chk_transfers_status CHECK (status IN ('selesai'))
);
