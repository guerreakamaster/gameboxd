CREATE TABLE IF NOT EXISTS games (
	id INT AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(255) NOT NULL,
	YEAR INT NOT NULL,
	genre VARCHAR(50) NOT NULL,
	image_url VARCHAR(500) DEFAULT NULL
);

INSERT INTO games (title, year, genre) VALUES
('Elden Ring', 2022, 'Action RPG'),
('Hades', 2020, 'Roguelike'),
('The Witcher 3', 2015, 'RPG'),
('Mewgenics', 2026, 'Roguelike');