DROP TABLE IF EXISTS `#__com_countries`;

CREATE TABLE `#__com_countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` text NOT NULL,
  `country_flag` text NOT NULL,
  `country_area` int(11) NOT NULL,
  `land_area` int(11) NOT NULL,
  `forest_area` int(11) NOT NULL,
  `map_of_country` text NOT NULL,
  `summary_description` text NOT NULL,
  `usefulll_links` text NOT NULL,
  `social_media_link` text NOT NULL,
  `fcpf_participating` text NOT NULL,
  `published` tinyint(2) NOT NULL,
  `checked_out` int(11) NOT NULL,
  `checked_out_time` DATETIME NOT NULL,
   PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;


