DROP DATABASE  php_test; #for local development purpuses, i've re-run this script a few times, mostly because i added a few insert statements to this script
CREATE DATABASE php_test;
USE php_test;

CREATE TABLE users(
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE advertisements (
    id int NOT NULL AUTO_INCREMENT,
    userid int,
    title varchar(255),
    FOREIGN KEY (userid) REFERENCES users (id),
    PRIMARY KEY (id)
);

INSERT INTO users (name) VALUES ('BÉLA');
INSERT INTO users (name) VALUES ('JÓZSI');
INSERT INTO users (name) VALUES ('SANYI');

#Assuming the database starts incrementing from 1
#I dont want to make a mistake, and create a faulty table by using a non existing foreign key
INSERT INTO advertisements (userid,title) VALUES (1,'The all new Apple Vision Pro');
INSERT INTO advertisements (userid,title) VALUES (2,'Listen to Utopia by Travis Scott!');
INSERT INTO advertisements (userid,title) VALUES (1,'Pink Floyd concert in Wien with a 3 day all inclusive holiday, just now for $399 + tax.');
