DROP TABLE IF EXISTS kessyoku;
CREATE TABLE kessyoku (
    kessyoku_id   MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    group_id      MEDIUMINT UNSIGNED NOT NULL,
    id            MEDIUMINT UNSIGNED NOT NULL,
    date          DATETIME,
    bre           BOOLEAN,
    lun           BOOLEAN,
    din           BOOLEAN,
    PRIMARY KEY(kessyoku_id)
);

