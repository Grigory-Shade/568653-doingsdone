CREATE DATABASE doingsdone
 DEFAULT CHARACTER SET utf8
 DEFAULT COLLATE utf8_general_ci;

USE doingsdone;

CREATE TABLE users (
id       INT AUTO_INCREMENT PRIMARY KEY,
date_add DATE,
email    CHAR(128) NOT NULL UNIQUE,
name     CHAR(128) NOT NULL,
password CHAR(64) NOT NULL
);

CREATE TABLE categories (
id       INT AUTO_INCREMENT PRIMARY KEY,
name     CHAR(128) NOT NULL,
user_id INT(10)
);

CREATE TABLE projects (
id       INT AUTO_INCREMENT PRIMARY KEY,
date_add DATE,
date_end DATE,
status   TINYINT(1) DEFAULT 0,
name     CHAR(128),
file     CHAR(255),
period   DATE,
user_id INT(10),
category_id INT(10)
);


