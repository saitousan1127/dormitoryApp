DROP TABLE IF EXISTS system;
CREATE TABLE system (
    id          MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    username   	VARCHAR(50),
    password   	VARCHAR(128),
    maint       BOOLEAN,
    maint_time  DATETIME,
    PRIMARY KEY (id)
);

INSERT  INTO system (username, password, maint) VALUES(  'system', '$2y$10$J8YctN9DYzM/Y/dJBuiqzux0i4YvcQ06PAWEeKSlUJnWVr.Q5NqBi', FALSE);