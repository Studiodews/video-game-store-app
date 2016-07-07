use video_game_store;

create table if not exists platforms (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name varchar(40)
	
);

create table if not exists tcg_brands (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name varchar(20)
	
);

create table if not exists video_games (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	platform_id INT UNSIGNED REFERENCES platforms(id),
	title varchar(50),
	rating varchar(10),
	price DECIMAL(8, 2),
	user_rating INT,
	description TEXT,
	created DATETIME DEFAULT NULL,
	modified DATETIME DEFAULT NULL
);

create table if not exists tcg_games (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	tcg_brand_id INT UNSIGNED REFERENCES tcg_brands(id),
	name varchar(50),
	price DECIMAL(8, 2),
	description TEXT,
	created DATETIME DEFAULT NULL,
	modified DATETIME DEFAULT NULL
);

create table if not exists consoles (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	platform_id INT UNSIGNED REFERENCES platforms(id),
	name varchar(50),
	price DECIMAL(8, 2),
	description TEXT,
	created DATETIME DEFAULT NULL,
	modified DATETIME DEFAULT NULL
);

create table if not exists vg_images(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	video_game_id INT UNSIGNED REFERENCES video_games(id),
	image_url VARCHAR(100)
);

create table if not exists tcg_images(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	tcg_game_id INT UNSIGNED REFERENCES tcg_games(id),
	image_url VARCHAR(100)
);

create table if not exists console_images(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	console_id INT UNSIGNED REFERENCES consoles(id),
	image_url VARCHAR(100)
);

create table if not exists order_items(
    order_id INT UNSIGNED REFERENCES orders(id),
    product_id INT UNSIGNED REFERENCES products(id),
    cost DECIMAL(8,2),
    quantity INT
)
