/* 
This SQL script creates the database and tables for the GameBoxd application.
Tables:
1. users: Stores user information including username, password (hashed), and role.
2. games: Stores game information including title, release year, genre, developer, and image URL.
3. reviews: Stores reviews made by users for games, including rating, review text, played hours.
*/  

CREATE DATABASE IF NOT EXISTS gameboxd CHARACTER SET utf8mb4;
USE gameboxd;

CREATE TABLE IF NOT EXISTS users (
  id       INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,          
  role     VARCHAR(50)  NOT NULL DEFAULT 'user'
);

CREATE TABLE IF NOT EXISTS games (
  id           INT AUTO_INCREMENT PRIMARY KEY,
  title        VARCHAR(255) NOT NULL,
  release_year INT NOT NULL,
  genre        VARCHAR(50)  NOT NULL,
  developer    VARCHAR(50),
  image_url    VARCHAR(500),
  -- A remaster or remake shares its title with the original, so the title alone
  -- is not unique. Title plus release year is what identifies a game.
  CONSTRAINT uq_games_title_release_year UNIQUE (title, release_year)
);

CREATE TABLE IF NOT EXISTS reviews (
  id           INT AUTO_INCREMENT PRIMARY KEY,
  user_id      INT NOT NULL,
  game_id      INT NOT NULL,
  rating       INT NOT NULL CHECK (rating BETWEEN 1 AND 5),
  rating_text  TEXT,
  played_hours INT,
  created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (game_id) REFERENCES games(id) ON DELETE CASCADE
);