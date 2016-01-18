DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS acccessLevel;

CREATE TABLE accessLevel (
  accessLevelId TINYINT UNSIGNED NOT NULL,
  description VARCHAR(32) NOT NULL,
  PRIMARY KEY(accessLevelId)
);

CREATE TABLE user (
    userId INT UNSIGNED AUTO_INCREMENT NOT NULL,
    accessLevelId TINYINT UNSIGNED NOT NULL,
    email VARCHAR(128) NOT NULL,
    firstName VARCHAR(32) NOT NULL,
    hash CHAR(128) NOT NULL,
    lastName VARCHAR(32) NOT NULL,
    phone VARCHAR(32) NOT NULL,
    profilePath VARCHAR(255) NOT NULL,
    salt CHAR(64) NOT NULL,
    PRIMARY KEY(userId),
    FOREIGN KEY(accessLevelId) REFERENCES accessLevel(accessLevelId)

);

