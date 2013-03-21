create table site_activities (
id int(10) unsigned not null primary key auto_increment,
ip_address varchar(20),
user_id int(10) unsigned,
page_to varchar(255),
page_from varchar(255),
created_at datetime not null,
updated_at datetime not null
);