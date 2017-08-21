CREATE TABLE `contact_messages` (
  `id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `message` text NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `clients` (
  `id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `company` varchar(128) NOT NULL,
  `logo` varchar(500) NOT NULL,
  `default_billing_address` text,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
);