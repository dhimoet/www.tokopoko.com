CREATE TABLE `user_instagram` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `uid` bigint(10) unsigned DEFAULT NULL,
  `auth_code` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
);
alter table user_posts add column source varchar(15) not null default 'facebook' after location;
alter table user_posts modify column page_url varchar(255) null;