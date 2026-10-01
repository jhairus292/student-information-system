-- Import this file in phpMyAdmin (select your database first).
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_no VARCHAR(20) NOT NULL UNIQUE,
    first_name VARCHAR(60) NOT NULL,
    last_name VARCHAR(60) NOT NULL,
    email VARCHAR(120) NOT NULL,
    course VARCHAR(100) NOT NULL,
    year_level TINYINT NOT NULL,
    birthdate DATE NOT NULL,
    contact VARCHAR(20) DEFAULT NULL,
    address VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO students (student_no, first_name, last_name, email, course, year_level, birthdate, contact, address) VALUES
('2024-0001', 'Maria', 'Santos', 'maria.santos@example.com', 'BS Information Technology', 2, '2005-03-14', '09171234567', 'Bacolod City'),
('2024-0002', 'Juan', 'Dela Cruz', 'juan.delacruz@example.com', 'BS Computer Science', 3, '2004-11-02', '09181234567', 'Silay City'),
('2024-0003', 'Ana', 'Reyes', 'ana.reyes@example.com', 'BS Education', 1, '2006-07-21', '09191234567', 'Talisay City');
