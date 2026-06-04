-- Query Seeder untuk Tabel users di SQL Server
-- Jalankan query di bawah ini langsung di SQL Server Anda:

INSERT INTO users (name, email, role, password, created_at, updated_at) VALUES
('Test User', 'test@example.com', 'asprak', '$2y$12$t41kR5Nl5B24H1Ld517c5eG2UaP/Q/1B2C3d4e5f6g7h8i9j0k1l2', GETDATE(), GETDATE()),
('Admin', 'admin@aspraknotes.com', 'admin', '$2y$12$t41kR5Nl5B24H1Ld517c5eG2UaP/Q/1B2C3d4e5f6g7h8i9j0k1l2', GETDATE(), GETDATE()),
('Nazli', 'Nazli@aspraknotes.com', 'admin', '$2y$12$t41kR5Nl5B24H1Ld517c5eG2UaP/Q/1B2C3d4e5f6g7h8i9j0k1l2', GETDATE(), GETDATE()),
('Reza', 'Reza@aspraknotes.com', 'admin', '$2y$12$t41kR5Nl5B24H1Ld517c5eG2UaP/Q/1B2C3d4e5f6g7h8i9j0k1l2', GETDATE(), GETDATE()),
('Sarah', 'Sarah@aspraknotes.com', 'asprak', '$2y$12$t41kR5Nl5B24H1Ld517c5eG2UaP/Q/1B2C3d4e5f6g7h8i9j0k1l2', GETDATE(), GETDATE()),
('Panji', 'Panji@aspraknotes.com', 'asprak', '$2y$12$t41kR5Nl5B24H1Ld517c5eG2UaP/Q/1B2C3d4e5f6g7h8i9j0k1l2', GETDATE(), GETDATE()),
('Zidan', 'Zidan@aspraknotes.com', 'asprak', '$2y$12$t41kR5Nl5B24H1Ld517c5eG2UaP/Q/1B2C3d4e5f6g7h8i9j0k1l2', GETDATE(), GETDATE());
