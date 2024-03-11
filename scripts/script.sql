CREATE TABLE usuario (
id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(255) NOT NULL UNIQUE,
senha VARCHAR(255) NOT NULL
);

INSERT INTO usuario (email,senha) VALUES('admin@gmail.com','admin123');