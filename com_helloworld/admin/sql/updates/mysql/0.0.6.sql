DROP TABLE IF EXISTS `#__helloworld`;

CREATE TABLE `#__helloworld` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `greeting` varchar(255) NOT NULL,
  `published` tinyint(2) NOT NULL,
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
   PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
INSERT INTO `#__helloworld` VALUES(0,'Hello World',0,1,0,0);