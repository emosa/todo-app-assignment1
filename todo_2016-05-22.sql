# Dump of table files
# ------------------------------------------------------------

DROP TABLE IF EXISTS `files`;

CREATE TABLE `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;

INSERT INTO `files` (`id`, `filename`, `title`)
VALUES
	(12,'Resume.docx','Resume'),
	(14,'morales_santiago_elimarie_UML1.xlsx','Excell Report');

/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table lists
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lists`;

CREATE TABLE `lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `list_name` varchar(255) NOT NULL,
  `list_body` text NOT NULL,
  `list_user_id` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

LOCK TABLES `lists` WRITE;
/*!40000 ALTER TABLE `lists` DISABLE KEYS */;

INSERT INTO `lists` (`id`, `list_name`, `list_body`, `list_user_id`, `create_date`)
VALUES
	(1,'Travel','Remember to save $100 every week!','1','2016-05-11 22:24:09'),
	(3,'Daily','','2','2016-05-13 16:03:37'),
	(4,'Daily','','2','2016-05-13 16:03:37'),
	(6,'Family','','1','2016-05-14 22:56:39'),
	(7,'Personal','','1','2016-05-14 22:56:47'),
	(8,'Hobby','','1','2016-05-14 22:57:04'),
	(9,'Work','','1','2016-05-15 15:04:11');

/*!40000 ALTER TABLE `lists` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tasks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tasks`;

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `task_body` text CHARACTER SET utf8 NOT NULL,
  `list_id` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_complete` tinyint(1) NOT NULL DEFAULT '0',
  `file_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;

INSERT INTO `tasks` (`id`, `task_name`, `task_body`, `list_id`, `due_date`, `create_date`, `is_complete`, `file_id`)
VALUES
	(12,'Job Interview','Google employment',7,'2016-05-31','2016-05-22 16:56:46',0,12),
	(14,'Week Expense','Report',6,'2016-05-31','2016-05-22 17:00:51',0,14);

/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `username`, `password`, `register_date`)
VALUES
	(1,'Elimarie','Morales','iglitzi@gmail.com','iglitzi','b5daad026c455353ac627db60dbb91f1','2016-05-11 21:59:19'),
	(2,'Jane','Doe','ig@gmail.com','joeli','725b54dd388a13cc059e15daa9d00fdc','2016-05-13 16:03:04'),
	(4,'Joe','Doe','jd@gmail.com','jdoe','e10adc3949ba59abbe56e057f20f883e','2016-05-21 17:04:41');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
