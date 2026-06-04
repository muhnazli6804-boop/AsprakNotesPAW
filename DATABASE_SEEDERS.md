-- # Query Seeder Database - AsprakNotesPAW
--
-- Berikut adalah query SQL mentah untuk memasukkan data seeder (akun pengguna bawaan)
-- langsung ke dalam database (SQL Server/T-SQL):

INSERT INTO users (name, email, role, password, created_at, updated_at) VALUES
('Test User', 'test@example.com', 'asprak', '$2y$10$hZYZSJDYl1Eg4g6rGKceB.MYnLOroP/3wr0MOk9VQ3/9bsCZrItbS', GETDATE(), GETDATE()),
('Admin', 'admin@aspraknotes.com', 'admin', '$2y$10$hZYZSJDYl1Eg4g6rGKceB.MYnLOroP/3wr0MOk9VQ3/9bsCZrItbS', GETDATE(), GETDATE()),
('Nazli', 'Nazli@aspraknotes.com', 'admin', '$2y$10$hZYZSJDYl1Eg4g6rGKceB.MYnLOroP/3wr0MOk9VQ3/9bsCZrItbS', GETDATE(), GETDATE()),
('Reza', 'Reza@aspraknotes.com', 'admin', '$2y$10$hZYZSJDYl1Eg4g6rGKceB.MYnLOroP/3wr0MOk9VQ3/9bsCZrItbS', GETDATE(), GETDATE()),
('Sarah', 'Sarah@aspraknotes.com', 'asprak', '$2y$10$hZYZSJDYl1Eg4g6rGKceB.MYnLOroP/3wr0MOk9VQ3/9bsCZrItbS', GETDATE(), GETDATE()),
('Panji', 'Panji@aspraknotes.com', 'asprak', '$2y$10$hZYZSJDYl1Eg4g6rGKceB.MYnLOroP/3wr0MOk9VQ3/9bsCZrItbS', GETDATE(), GETDATE()),
('Zidan', 'Zidan@aspraknotes.com', 'asprak', '$2y$10$hZYZSJDYl1Eg4g6rGKceB.MYnLOroP/3wr0MOk9VQ3/9bsCZrItbS', GETDATE(), GETDATE());
