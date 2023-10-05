DROP TABLE IF EXISTS tpl;
CREATE TABLE tpl (
    id          MEDIUMINT UNSIGNED NOT NULL,
    psCode1     VARCHAR(3),
    psCode2     VARCHAR(4),
    address     VARCHAR(128),
    last_name2  VARCHAR(50),
    first_name2 VARCHAR(50),
    tel         VARCHAR(16),
    reason      VARCHAR(4),
    riyuu       VARCHAR(700),
    PRIMARY KEY (id)
);