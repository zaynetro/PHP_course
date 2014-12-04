CREATE TABLE IF NOT EXISTS `MOVIES` (
  movie_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  title VARCHAR(100) NOT NULL DEFAULT '',
  description TEXT,
  poster_url  VARCHAR(150) NOT NULL DEFAULT '',
  year SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  rating SMALLINT NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (movie_id)
);

CREATE TABLE IF NOT EXISTS `ACTORS` (
  actor_id INT UNSIGNED  NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL DEFAULT '',
  picture_url  VARCHAR(150) NOT NULL DEFAULT '',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (actor_id)
);

CREATE TABLE IF NOT EXISTS `MOVIE_ACTOR_LINKS` (
  movie_id INT UNSIGNED NOT NULL DEFAULT 0,
  actor_id INT UNSIGNED NOT NULL DEFAULT 0,

  FOREIGN KEY (movie_id)
    REFERENCES MOVIES(movie_id)
    ON DELETE CASCADE,

  FOREIGN KEY (actor_id)
    REFERENCES ACTORS(actor_id)
    ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `USERS` (
  user_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL DEFAULT '',
  hash VARCHAR(100) NOT NULL DEFAULT '',
  privilege TINYINT NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (user_id)
);

CREATE TABLE IF NOT EXISTS `REVIEWS` (
  review_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  movie_id INT UNSIGNED NOT NULL DEFAULT 0,
  user_id INT UNSIGNED NOT NULL DEFAULT 0,
  review TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (review_id),

  FOREIGN KEY (movie_id)
    REFERENCES MOVIES(movie_id)
    ON DELETE CASCADE,

  FOREIGN KEY (user_id)
    REFERENCES USERS(user_id)
    ON DELETE CASCADE
);
