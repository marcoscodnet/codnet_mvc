CREATE TABLE `jasper_datasource` (
`cd_datasource` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`ds_datasource` VARCHAR( 50 ) NOT NULL ,
`ds_uri` VARCHAR( 255 ) NOT NULL
) ENGINE = innodb CHARACTER SET utf8 COLLATE utf8_unicode_ci;
