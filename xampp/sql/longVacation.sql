DROP TABLE IF EXISTS longVacation;
CREATE TABLE longVacation (
    id             MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name           VARCHAR(100),
    first_date     DATETIME,
    last_date      DATETIME,
    PRIMARY KEY (id)
);