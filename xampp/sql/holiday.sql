DROP TABLE IF EXISTS holiday;
CREATE TABLE holiday (
    id       MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,       
    name     VARCHAR(100),
    date     DATETIME,
    PRIMARY KEY (id)
);