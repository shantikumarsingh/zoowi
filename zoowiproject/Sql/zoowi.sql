CREATE DATABASE ZOOWI;
USE DATABASE ZOOWI 

DROP TABLE IF EXISTS `zoowi`.`user`;
CREATE TABLE  `zoowi`.`user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobileno` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `createdon` int(11) NOT NULL,
  `updatedon` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
