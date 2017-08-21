CREATE TABLE `contact_messages` (
  `id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `message` text NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
);