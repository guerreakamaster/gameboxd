-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         11.5.2-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para gameboxd
DROP DATABASE IF EXISTS `gameboxd`;
CREATE DATABASE IF NOT EXISTS `gameboxd` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci */;
USE `gameboxd`;

-- Volcando estructura para tabla gameboxd.games
DROP TABLE IF EXISTS `games`;
CREATE TABLE IF NOT EXISTS `games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `developer` varchar(50) DEFAULT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Volcando datos para la tabla gameboxd.games: ~26 rows (aproximadamente)
DELETE FROM `games`;
INSERT INTO `games` (`id`, `title`, `year`, `genre`, `developer`, `image_url`) VALUES
	(1, 'Elden Ring', 2022, 'Action RPG', 'FromSoftware', 'https://cdng.europosters.eu/pod_public/750/216712.jpg'),
	(2, 'Hades', 2020, 'Roguelike', 'Supergiant Games', 'https://m.media-amazon.com/images/I/71FjVhf-SlL._AC_UF894,1000_QL80_.jpg'),
	(3, 'The Witcher 3', 2015, 'RPG', 'CD Projekt Red', 'https://m.media-amazon.com/images/M/MV5BNTQ2NjNkMTItNjViYy00MjhlLTgxMTEtOTM1ODJiNmFiMmJhXkEyXkFqcGc@._V1_.jpg'),
	(4, 'Mewgenics', 2026, 'Roguelike', 'Edmund McMiller', 'https://upload.wikimedia.org/wikipedia/en/thumb/a/a5/Mewgenics_Poster.jpg/250px-Mewgenics_Poster.jpg'),
	(5, 'The Legend of Zelda: Breath of the Wild', 2017, 'Action-Adventure', 'Nintendo', 'https://static.posters.cz/image/750/40519.jpg'),
	(6, 'Red Dead Redemption 2', 2018, 'Action-Adventure', 'Rockstar Games', 'https://myhotposters.com/cdn/shop/products/mL2362_1024x1024.jpg?v=1748535382'),
	(7, 'Hollow Knight', 2017, 'Metroidvania', 'Team Cherry', 'https://i.redd.it/ohro7c8y2hi81.jpg'),
	(8, 'Cyberpunk 2077', 2020, 'Action RPG', 'CD Projekt Red', 'https://cdn.xzone.cz/p/klasicke-plakaty/plakat-cyberpunk-2077-ready-player-v/plakat-cyberpunk-2077-ready-player-v-600w.png'),
	(9, 'Bloodborne', 2015, 'Action RPG', 'FromSoftware', 'https://i.ebayimg.com/images/g/cvgAAOSwQjZXPsHp/s-l1200.jpg'),
	(10, 'Portal 2', 2011, 'Puzzle-Platform', 'Valve', 'https://m.media-amazon.com/images/I/71wNXtVNbmL._AC_UF894,1000_QL80_.jpg'),
	(11, 'Mass Effect 2', 2010, 'Action RPG', 'BioWare', 'https://static.posters.cz/image/1300/8726.jpg'),
	(12, 'Minecraft', 2011, 'Sandbox', 'Mojang', 'https://i.ebayimg.com/images/g/Y9IAAOSwM2ddrpX2/s-l1200.jpg'),
	(13, 'Stardew Valley', 2016, 'Simulation', 'ConcernedApe', 'https://m.media-amazon.com/images/I/71IcDLw+8UL.jpg'),
	(14, 'Baldur\'s Gate 3', 2023, 'RPG', 'Larian Studios', 'https://m.media-amazon.com/images/I/71T9Nc8x-3L._AC_UF894,1000_QL80_.jpg'),
	(15, 'God of War', 2018, 'Action-Adventure', 'Santa Monica Studio', 'https://m.media-amazon.com/images/M/MV5BNjJiNTFhY2QtNzZkYi00MDNiLWEzNGEtNWE1NzBkOWIxNmY5XkEyXkFqcGc@._V1_.jpg'),
	(16, 'Grand Theft Auto V', 2013, 'Action-Adventure', 'Rockstar North', 'https://i.ebayimg.com/images/g/eMMAAOSwKnddf6LY/s-l1200.jpg'),
	(17, 'Persona 5 Royal', 2019, 'JRPG', 'P-Studio', 'https://m.media-amazon.com/images/I/71rTxqiMuVL._AC_UF894,1000_QL80_.jpg'),
	(18, 'Super Mario Odyssey', 2017, 'Platformer', 'Nintendo', 'https://static.posters.cz/image/750/50045.jpg'),
	(19, 'Celeste', 2018, 'Platformer', 'Maddy Makes Games', 'https://m.media-amazon.com/images/I/61B8FQ4gejL._AC_UF894,1000_QL80_.jpg'),
	(22, 'The Last of Us', 2013, 'Action-Adventure', 'Naughty Dog', 'https://static.posters.cz/image/750/127761.jpg'),
	(23, 'Half-Life 2', 2004, 'FPS', 'Valve', 'https://m.media-amazon.com/images/M/MV5BOGVhMGFhNGYtZWViNC00MzQ0LTg5MTAtYjM4MmMzNjA0YjUyXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg'),
	(24, 'Outer Wilds', 2019, 'Action-Adventure', 'Mobius Digital', 'https://m.media-amazon.com/images/I/61DXQI+hHlL._AC_UF894,1000_QL80_.jpg'),
	(25, 'Sekiro: Shadows Die Twice', 2019, 'Action-Adventure', 'FromSoftware', 'https://m.media-amazon.com/images/M/MV5BMzFiM2Y3NmMtNDY3MC00MThhLWFhNmYtZjIzMDNjZmNhMTdhXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg'),
	(26, 'Doom Eternal', 2020, 'FPS', 'Bethesda', 'https://m.media-amazon.com/images/I/719oFLtlYDL._AC_UF894,1000_QL80_.jpg'),
	(27, 'Dark Souls 3', 2016, 'Souls-Like', 'FromSoftware', 'https://m.media-amazon.com/images/M/MV5BNzQzODQ3YzktNTM1Yy00NmNmLTk3NTItNGVlY2M1MzI4MjQ0XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg'),
	(29, 'The Binding of Isaac', 2011, 'Roguelike', 'Edmund McMiller', 'https://m.media-amazon.com/images/I/71BhioGL34L._AC_UF894,1000_QL80_.jpg');

-- Volcando estructura para tabla gameboxd.reviews
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `rating_text` text DEFAULT NULL,
  `played_hours` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Volcando datos para la tabla gameboxd.reviews: ~7 rows (aproximadamente)
DELETE FROM `reviews`;
INSERT INTO `reviews` (`id`, `user_id`, `game_id`, `rating`, `rating_text`, `played_hours`, `created_at`) VALUES
	(2, 1, 1, 4, 'Esta tela de guapo', 50, '2026-05-04 18:27:05'),
	(5, 1, 26, 4, 'Mata bicho y frenesi, to guapo\r\n', 150, '2026-05-05 14:05:46'),
	(6, 2, 1, 4, 'Absolutely GOTY - 10/10', 150, '2026-05-06 00:06:36'),
	(7, 1, 3, 3, 'Very good fights and history.', 45, '2026-05-06 00:27:58'),
	(8, 1, 12, 5, 'BEST GAME EVER GOODDDDD', 500, '2026-05-06 00:28:18'),
	(9, 1, 27, 4, 'I have literally cried on this game xd. Fuck sister Friede.', 90, '2026-05-06 00:28:59'),
	(11, 2, 3, 3, 'dasdas', 1231, '2026-05-06 11:20:35');

-- Volcando estructura para tabla gameboxd.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Volcando datos para la tabla gameboxd.users: ~3 rows (aproximadamente)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
	(1, 'guerralv', '$2y$10$Q0iNfBap5qD7ttwxA26r5.6ac13jfzI1xEUWq.6GQw7HUBdtpuBW.', 'user'),
	(2, 'admin', '$2y$10$OxqG1ASM34ADYIPr5od9E.sCBetat7C6Tjvr0.sIYEpaqCXbkpI8G', 'admin'),
	(3, 'user1', '$2y$10$aQzZc59uRaPyaFxK8A2LTepueqjKBdh6BG3uyzPlQAe79Cd5Jxxzq', 'user');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
