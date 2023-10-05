DROP TABLE IF EXISTS caterer;
CREATE TABLE caterer (
    id          MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    username   	VARCHAR(50),
    password   	VARCHAR(128),
    PRIMARY KEY (id)
);

INSERT  INTO caterer (username, password) VALUES(  'caterer', '$2y$10$Qf2L/ZbP1a.PqzJcz8cZLOiP4LBSieGmFzc2gkPrBCXIS0LV7xS8a');