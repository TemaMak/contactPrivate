CREATE TABLE IF NOT EXISTS `prefix_private_setting` (
  `user_id` int(11) NOT NULL,
  `contact_private_setting` enum('all','registered','friends') NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;