
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- sf_guard_user_profile
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_user_profile`;


CREATE TABLE `sf_guard_user_profile`
(
	`user_id` INTEGER  NOT NULL,
	`last_name` VARCHAR(20)  NOT NULL,
	`first_name` VARCHAR(20)  NOT NULL,
	`middle_name` VARCHAR(20),
	`birthday` DATE,
	`gender` CHAR(1) default 'M' NOT NULL,
	`country` CHAR(2) default 'RU' NOT NULL,
	`city_id` SMALLINT,
	`institution` VARCHAR(255),
	`address` VARCHAR(255) default '' NOT NULL,
	`is_address_private` TINYINT default 0 NOT NULL,
	`email` VARCHAR(100) default 'jct@ict.nsc.ru' NOT NULL,
	`phone_home` VARCHAR(40),
	`phone_work` VARCHAR(40),
	`qualification` VARCHAR(30),
	`is_reviewer` TINYINT default 0 NOT NULL,
	PRIMARY KEY (`user_id`),
	KEY `sf_guard_user_profile_I_1`(`last_name`),
	KEY `sf_guard_user_profile_I_2`(`birthday`),
	KEY `sf_guard_user_profile_I_3`(`country`),
	KEY `sf_guard_user_profile_I_4`(`city_id`),
	CONSTRAINT `sf_guard_user_profile_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE,
	CONSTRAINT `sf_guard_user_profile_FK_2`
		FOREIGN KEY (`city_id`)
		REFERENCES `cities` (`id`)
		ON DELETE SET NULL
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- guard_user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `guard_user`;


CREATE TABLE `guard_user`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`last_name` VARCHAR(20)  NOT NULL,
	`first_name` VARCHAR(20)  NOT NULL,
	`middle_name` VARCHAR(20),
	`birthday` DATE,
	`gender` CHAR(1) default 'M' NOT NULL,
	`country` CHAR(2) default 'RU' NOT NULL,
	`city_id` SMALLINT,
	`institution` VARCHAR(255),
	`address` VARCHAR(255) default '' NOT NULL,
	`is_address_private` TINYINT default 0 NOT NULL,
	`email` VARCHAR(100) default 'jct@ict.nsc.ru' NOT NULL,
	`qualification` VARCHAR(30),
	`is_reviewer` TINYINT default 0 NOT NULL,
	`username` VARCHAR(128)  NOT NULL,
	`created_at` DATETIME,
	`last_login` DATETIME,
	`is_active` TINYINT default 1 NOT NULL,
	`is_super_admin` TINYINT default 0 NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `guard_user_U_1` (`username`),
	KEY `guard_user_I_1`(`last_name`),
	KEY `guard_user_I_2`(`birthday`),
	KEY `guard_user_I_3`(`country`),
	KEY `guard_user_I_4`(`city_id`),
	CONSTRAINT `guard_user_FK_1`
		FOREIGN KEY (`city_id`)
		REFERENCES `cities` (`id`)
		ON DELETE SET NULL,
	CONSTRAINT `sf_guard_user`
		FOREIGN KEY (`id`)
		REFERENCES `sf_guard_user` (`id`),
	CONSTRAINT `sf_guard_user_profile`
		FOREIGN KEY (`id`)
		REFERENCES `sf_guard_user_profile` (`user_id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- cities
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `cities`;


CREATE TABLE `cities`
(
	`id` SMALLINT  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(30)  NOT NULL,
	`region_id` SMALLINT,
	`country` CHAR(2) default 'RU' NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `cities_FI_1` (`region_id`),
	CONSTRAINT `cities_FK_1`
		FOREIGN KEY (`region_id`)
		REFERENCES `regions` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- regions
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `regions`;


CREATE TABLE `regions`
(
	`id` SMALLINT  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- regions_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `regions_i18n`;


CREATE TABLE `regions_i18n`
(
	`id` SMALLINT  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	`name` VARCHAR(50),
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `regions_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `regions` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- manuscripts
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `manuscripts`;


CREATE TABLE `manuscripts`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(300)  NOT NULL,
	`status` TINYINT default 0 NOT NULL,
	`pages` TINYINT,
	`city_id` SMALLINT,
	`comment` TEXT,
	`annotation` TEXT  NOT NULL,
	`letter` TEXT  NOT NULL,
	`keywords_freetext` VARCHAR(500),
	`reviewers_request` VARCHAR(1000),
	PRIMARY KEY (`id`),
	KEY `manuscripts_I_1`(`city_id`),
	KEY `title`(`title`(10)),
	KEY `status`(`status`),
	KEY `city`(`city_id`),
	CONSTRAINT `manuscripts_FK_1`
		FOREIGN KEY (`city_id`)
		REFERENCES `cities` (`id`)
		ON DELETE SET NULL
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- publications
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `publications`;


CREATE TABLE `publications`
(
	`manuscript_id` INTEGER  NOT NULL,
	`volume` TINYINT  NOT NULL,
	`number` TINYINT  NOT NULL,
	`first_page` SMALLINT  NOT NULL,
	`last_page` SMALLINT  NOT NULL,
	`year` SMALLINT,
	PRIMARY KEY (`manuscript_id`),
	KEY `publications_I_1`(`volume`),
	KEY `publications_I_2`(`number`),
	CONSTRAINT `publications_FK_1`
		FOREIGN KEY (`manuscript_id`)
		REFERENCES `manuscripts` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- users_manuscripts_ref
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `users_manuscripts_ref`;


CREATE TABLE `users_manuscripts_ref`
(
	`user_id` INTEGER  NOT NULL,
	`manuscript_id` INTEGER  NOT NULL,
	`is_corresponding_author` TINYINT default 0 NOT NULL,
	`author_order` TINYINT default 0 NOT NULL,
	PRIMARY KEY (`user_id`,`manuscript_id`),
	CONSTRAINT `users_manuscripts_ref_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user_profile` (`user_id`)
		ON DELETE CASCADE,
	INDEX `users_manuscripts_ref_FI_2` (`manuscript_id`),
	CONSTRAINT `users_manuscripts_ref_FK_2`
		FOREIGN KEY (`manuscript_id`)
		REFERENCES `manuscripts` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- reviews
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `reviews`;


CREATE TABLE `reviews`
(
	`user_id` INTEGER  NOT NULL,
	`manuscript_id` INTEGER  NOT NULL,
	`contents` TEXT,
	`outcome` TINYINT default 0 NOT NULL,
	`submitted` TIMESTAMP NOT NULL default CURRENT_TIMESTAMP,
	`decision` TINYINT(1),
	PRIMARY KEY (`user_id`,`manuscript_id`),
	KEY `reviews_I_1`(`manuscript_id`),
	KEY `reviews_I_2`(`outcome`),
	KEY `reviews_I_3`(`submitted`),
	CONSTRAINT `reviews_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user_profile` (`user_id`)
		ON DELETE SET NULL,
	CONSTRAINT `reviews_FK_2`
		FOREIGN KEY (`manuscript_id`)
		REFERENCES `manuscripts` (`id`)
		ON DELETE SET NULL
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- actions
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `actions`;


CREATE TABLE `actions`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`manuscript_id` INTEGER  NOT NULL,
	`status_before` TINYINT default 0 NOT NULL,
	`status_after` TINYINT default 0 NOT NULL,
	`datetime` TIMESTAMP NOT NULL default CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`),
	KEY `actions_I_1`(`manuscript_id`),
	KEY `actions_I_2`(`datetime`),
	CONSTRAINT `actions_FK_1`
		FOREIGN KEY (`manuscript_id`)
		REFERENCES `manuscripts` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- keywords
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `keywords`;


CREATE TABLE `keywords`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`keyword` VARCHAR(100)  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `keywords_I_1`(`keyword`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- keywords_manuscripts_ref
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `keywords_manuscripts_ref`;


CREATE TABLE `keywords_manuscripts_ref`
(
	`keyword_id` INTEGER  NOT NULL,
	`manuscript_id` INTEGER  NOT NULL,
	PRIMARY KEY (`keyword_id`,`manuscript_id`),
	CONSTRAINT `keywords_manuscripts_ref_FK_1`
		FOREIGN KEY (`keyword_id`)
		REFERENCES `keywords` (`id`)
		ON DELETE CASCADE,
	INDEX `keywords_manuscripts_ref_FI_2` (`manuscript_id`),
	CONSTRAINT `keywords_manuscripts_ref_FK_2`
		FOREIGN KEY (`manuscript_id`)
		REFERENCES `manuscripts` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- issues
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `issues`;


CREATE TABLE `issues`
(
	`volume` SMALLINT  NOT NULL,
	`num` SMALLINT  NOT NULL,
	`status` TINYINT default 0 NOT NULL,
	`published_date` DATE,
	PRIMARY KEY (`volume`,`num`)
)Type=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;

drop table if exists 'guard_user';

CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `guard_user` AS select `u`.`id` AS `id`,`u`.`username` AS `username`,`u`.`created_at` AS `created_at`,`u`.`last_login` AS `last_login`,`u`.`is_active` AS `is_active`,`u`.`is_super_admin` AS `is_super_admin`,`p`.`last_name` AS `last_name`,`p`.`first_name` AS `first_name`,`p`.`middle_name` AS `middle_name`,`p`.`birthday` AS `birthday`,`p`.`gender` AS `gender`,`p`.`country` AS `country`,`p`.`city_id` AS `city_id`,`p`.`institution` AS `institution`,`p`.`address` AS `address`,`p`.`is_address_private` AS `is_address_private`,`p`.`email` AS `email`,`p`.`qualification` AS `qualification`,`p`.`is_reviewer` AS `is_reviewer` from (`sf_guard_user` `u` join `sf_guard_user_profile` `p`) where (`p`.`user_id` = `u`.`id`)

INSERT INTO `cities` VALUES  (812,'Улан-Уде','RU',2),
 (811,'New York','US',6),
 (810,'Орел','RU',4),
 (809,'Усть-Каменогорск','KZ',5),
 (808,'Кострома','RU',4),
 (807,'Ярославл','RU',4),
 (806,'El Paso','US',6),
 (805,'Улан-Удэ','RU',2),
 (804,'Новокузнецк','RU',2),
 (803,'Пенза','RU',4),
 (802,'Волгоград','RU',4),
 (801,'Зеленоград','RU',3),
 (800,'Kharagpur','IN',6),
 (799,'Трехгорный','RU',4),
 (798,'Kaiserslautern','DE',6),
 (797,'Петрозаводск','RU',4),
 (796,'Одесса','UA',5),
 (795,'Guangzhou','CN',6),
 (794,'Munchen','DE',6),
 (793,'Aachen','DE',6),
 (792,'Ankara','TR',6),
 (791,'Самара','RU',4),
 (790,'Астана','KZ',5),
 (789,'Алма-Ата','KZ',5),
 (788,'Краснодар','RU',4),
 (787,'Dalian','CN',6),
 (786,'Тверь','RU',4),
 (785,'Сургут','RU',2),
 (784,'Рязань','RU',4),
 (783,'Саратов','RU',4),
 (782,'Бийск','RU',2),
 (781,'Yaounde','CM',6),
 (780,'Екатеpинбуpг','RU',4),
 (779,'Баку','AZ',5),
 (778,'Якутск','RU',2),
 (777,'Челябинск','RU',4),
 (776,'Lafayette','US',6),
 (775,'Пермь','RU',4),
 (774,'Darmstadt','DE',6),
 (773,'Севастополь','UA',5),
 (772,'Петропавловск-Камчатский','RU',2),
 (771,'Киев','UA',5),
 (770,'Тюмень','RU',2),
 (769,'Благовещенск','RU',2),
 (768,'Ноовсибирск','RU',1),
 (767,'Ростов-на-Дону','RU',4),
 (766,'Chiangmai','CN',6),
 (765,'Кокшетау','KZ',5),
 (764,'Ташкент','UZ',5),
 (763,'Хабаровск','RU',2),
 (762,'Новоссибирск','RU',1),
 (761,'Томск','RU',2),
 (760,'Новвосибирск','RU',1),
 (759,'Санкт-Петербург','RU',4),
 (758,'Бишкек','KG',5),
 (757,'Барнаул','RU',2),
 (756,'Омск','RU',2),
 (755,'Казань','RU',4),
 (754,'Владивосток','RU',2),
 (753,'Алматы','KZ',5),
 (752,'Екатеринбург','RU',4),
 (751,'Уфа','RU',4),
 (750,'Иркутск','RU',2),
 (749,'Караганда','KZ',5),
 (748,'Кемерово','RU',2),
 (747,'Новосибирск','RU',1),
 (746,'Москва','RU',3),
 (745,'Красноярск','RU',2);
 
 INSERT INTO `regions` VALUES  (1),
 (2),
 (3),
 (4),
 (5),
 (6);
 
 INSERT INTO `regions_i18n` VALUES  (1,'ru','Новосибирск'),
 (2,'ru','Сибирь и Дальний Восток'),
 (3,'ru','Москва'),
 (4,'ru','Урал и Европейская Россия'),
 (5,'ru','Ближнее Зарубежье'),
 (6,'ru','Дальнее Зарубежье'),
 (1,'en','Novosibirsk'),
 (2,'en','Siberia and Far East'),
 (3,'en','Moscow'),
 (4,'en','Urals and European part of Russia'),
 (5,'en','New Independent States'),
 (6,'en','Foreign Countries');