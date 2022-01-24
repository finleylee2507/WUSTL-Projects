| comments | CREATE TABLE `comments` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(128) CHARACTER SET utf8 NOT NULL,
  `date` datetime NOT NULL,
  `message` text CHARACTER SET utf8 NOT NULL,
  `sid` tinyint(4) unsigned NOT NULL,
  PRIMARY KEY (`cid`),
  KEY `sid` (`sid`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `stories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 |