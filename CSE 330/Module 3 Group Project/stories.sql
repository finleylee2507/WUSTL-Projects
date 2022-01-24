| stories | CREATE TABLE `stories` (
  `id` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(128) CHARACTER SET utf8 NOT NULL,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `link` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 |