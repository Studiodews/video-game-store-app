USE blogs;

DROP TABLE IF EXISTS posts;

CREATE TABLE posts(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(50),
	body TEXT,
	created DATETIME DEFAULT NULL,
	modified DATETIME DEFAULT NULL
);


INSERT INTO posts (title, body, created) VALUES('the title', 'this is the post body.',NOW());
INSERT INTO posts (title, body, created) VALUES('a title once aagin', 'and the post body follows', NOW());
INSERT INTO posts (title, body, created) VALUES('title strikes back', 'this is really exiting! Not.', NOW());
