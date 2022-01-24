| users | CREATE TABLE `users` (
  `id` varchar(100) CHARACTER SET utf8 NOT NULL,
  `hashed_pass` varchar(61) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 |
