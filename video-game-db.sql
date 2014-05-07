use video-game-store-db;

create table if not exists platforms {
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name varchar(40),
	
}

create table if not exists tcg_brands {
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name varchar(20),
	
}

create table if not exists video_games {
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	platform_id INT UNSIGNED REFERENCES platforms(id),
	title varchar(50),
	rating varchar(10),
	price DECIMAL(8, 2),
	user_rating INT,
	description TEXT,
	created DATETIME DEFAULT NULL,
	modified DATETIME DEFAULT NULL
}

create table if not exists tcg_games {
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	tcg_brand_id INT UNSIGNED REFERENCES tcg_brands(id),
	name varchar(50),
	price DECIMAL(8, 2),
	description TEXT,
	created DATETIME DEFAULT NULL,
	modified DATETIME DEFAULT NULL
}

create table if not exists consoles{
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	platform_id INT UNSIGNED REFERENCES platforms(id),
	name varchar(50),
	price DECIMAL(8, 2),
	description TEXT,
	created DATETIME DEFAULT NULL,
	modified DATETIME DEFAULT NULL
}