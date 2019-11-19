# DB: place

## Table: pixels
    - id [type INT(11)]
    - x [type INT(6)](PRIMARY KEY)
    - y [type INT(6)](PRIMARY KEY)
    - color [type VARCHAR(6)]
    - last_update [type INT(11)]

## Table: pixel_archive
    - id [type INT(11)]
    - x [type INT(6)]
    - y [type INT(6)]
    - color [type VARCHAR(6)]
    - timestamp [type INT(11)]
