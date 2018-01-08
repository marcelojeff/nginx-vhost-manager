CREATE TABLE `Users` (
	`id`	INTEGER PRIMARY KEY AUTOINCREMENT,
	`name`	TEXT,
	`username`	TEXT UNIQUE,
	`password`	TEXT,
	`roles` TEXT
);
