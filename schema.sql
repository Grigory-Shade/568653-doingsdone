CREATE DATABASE doingsdone
 DEFAULT CHARACTER SET utf8
 DEFAULT COLLATE utf8_general_ci;

USE doingsdone;

CREATE TABLE users (
id       INT AUTO_INCREMENT PRIMARY KEY,
date_add DATETIME DEFAULT CURRENT_TIMESTAMP,
email    CHAR(128) NOT NULL UNIQUE,
name     CHAR(128) NOT NULL,
password CHAR(64) NOT NULL
);

CREATE TABLE categories (
id       INT AUTO_INCREMENT PRIMARY KEY,
name     CHAR(128) NOT NULL,
users_id INT
);

CREATE TABLE projects (
id       INT AUTO_INCREMENT PRIMARY KEY,
date_add DATETIME DEFAULT CURRENT_TIMESTAMP,
date_end DATE,
status   TINYINT(1) DEFAULT 0,
name     CHAR(128),
file     CHAR,
period   DATE,
users_id INT,
categories_id INT
);


