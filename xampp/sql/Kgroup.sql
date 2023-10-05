DROP TABLE IF EXISTS Kgroup;
CREATE TABLE Kgroup (
    group_id    MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    id          MEDIUMINT UNSIGNED NOT NULL,
    sub_date   	DATETIME,
    grade       VARCHAR(1),
    reason      VARCHAR(700),
    app         VARCHAR(3),
    comment     VARCHAR(700),
    state       DATETIME,     
    app_date    DATETIME,
    auto_delete BOOLEAN,
    PRIMARY KEY(group_id)
);