DROP TABLE IF EXISTS `#__helloworld`;
 
CREATE TABLE `#__helloworld` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`asset_id` INT(10)     NOT NULL DEFAULT '0',
	`greeting` VARCHAR(25) NOT NULL,
	`published` tinyint(4) NOT NULL DEFAULT '1',
	`catid`	    INT(11)    NOT NULL DEFAULT '0',
	`params`   VARCHAR(1024) NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;
 
INSERT INTO `#__helloworld` (`greeting`) VALUES
('Hello World!'),
('Good bye World!');