DROP TABLE IF EXISTS ryoukanlog;
CREATE TABLE ryoukanlog (
    ryoukan_id  MEDIUMINT UNSIGNED NOT NULL,
    login_date  DATETIME,
    invalid     BOOLEAN
);