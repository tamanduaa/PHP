
CREATE TABLE `mysqlcrud` (
  `id` int(11) NOT NULL,
  `name` varchar(20) default NULL,
  `email` varchar(40) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into `mysqlcrud` values 
 ('1','Changed!','this@wasinsert.ed'),
 ('2','Name 2','this@wasinsert.ed'),
 ('3','Name 3','this@wasinsert.ed');

