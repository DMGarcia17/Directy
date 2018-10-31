CREATE DATABASE foodapp;

USE foodapp;

CREATE TABLE admin (
  username VARCHAR(20)  NOT NULL,
  passwd   VARCHAR(100) NOT NULL,
  names    VARCHAR(100) NOT NULL,
  lnames   VARCHAR(100) NOT NULL,
  PRIMARY KEY (username)
)
  engine = InnoDB
  default charset = utf8;

CREATE TABLE users (
  username    VARCHAR(20)  NOT NULL,
  passwd      VARCHAR(100) NOT NULL,
  c_name      VARCHAR(500) NOT NULL,
  ubication   VARCHAR(900) NOT NULL,
  logo        VARCHAR(200) NOT NULL,
  description VARCHAR(700) NOT NULL,
  tel	      VARCHAR(15)  NOT NULL,
  PRIMARY KEY (username)
)
  engine = InnoDB
  default charset = utf8;

CREATE INDEX users_idx
  ON users (username);

delete from products;

CREATE TABLE products (
  id_pro      INT          NOT NULL AUTO_INCREMENT,
  name        VARCHAR(200) NOT NULL,
  description VARCHAR(500) NOT NULL,
  price       VARCHAR(15)  NOT NULL,
  img         VARCHAR(200) NOT NULL,
  company     VARCHAR(20)  NOT NULL,
  PRIMARY KEY (id_pro),
  CONSTRAINT fk_product FOREIGN KEY (company) REFERENCES users (username)
)
  engine = InnoDB
  default charset = utf8;

CREATE TABLE login_log (
  username  VARCHAR(20) NOT NULL,
  time_date DATETIME    NOT NULL,
  CONSTRAINT fk_log FOREIGN KEY (username) REFERENCES users (username)
)
  engine = InnoDB
  default charset = utf8;


select *
from users;
