CREATE TABLE `sed_guestbook` (
`gb_id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
`gb_author` VARCHAR( 24 ) NOT NULL ,
`gb_authorid` INT( 11 ) ,
`gb_text` TEXT NOT NULL ,
`gb_date` INT( 11 ) NOT NULL ,
`gb_email` VARCHAR( 64 ) NOT NULL ,
`gb_website` VARCHAR( 128 ) NOT NULL ,
PRIMARY KEY ( `gb_id` )
);
