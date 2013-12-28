# Structure of table for Links class
#

CREATE TABLE IF NOT EXISTS `Links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL,
  `data` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dataw` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip` varchar(15) NOT NULL DEFAULT '000.000.000.000',
  PRIMARY KEY (`id`),
  KEY `wid` (`wid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;