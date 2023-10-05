DROP TABLE IF EXISTS premember;
CREATE TABLE premember (
    id          MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    username   	VARCHAR(50),
    password   	VARCHAR(256),
    last_name  	VARCHAR(50),
    first_name 	VARCHAR(50),
    h_last_name VARCHAR(50),
    h_first_name VARCHAR(50),
    k_last_name VARCHAR(50),
    k_first_name VARCHAR(50),
    class       VARCHAR(3),
    roomnum     VARCHAR(6),
    birthday   	CHAR(8),
    link_pass   VARCHAR(128),
    reg_date   	DATETIME,
    PRIMARY KEY (id)
);


