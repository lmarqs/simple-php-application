create database spa character set utf8;
-- GRANT ALL PRIVILEGES ON *.* TO 'root'@'%'  WITH GRANT OPTION;

create table contact (
	id int not null auto_increment,
	name varchar(128),
	phone varchar(32),
	email varchar(32),
	birthday date,
	primary key (id)
);

insert into contact (id, name, phone, email, birthday) values (1, 'Andrea Delwater', '+46 (639) 293-5124', 'adelwater0@buzzfeed.com', '1990-12-15');
insert into contact (id, name, phone, email, birthday) values (2, 'Enrika Tweed', '+86 (844) 872-5513', 'etweed1@abc.net.au', '1990-08-03');
insert into contact (id, name, phone, email, birthday) values (3, 'Sibella Stilgo', '+55 (898) 340-5179', 'sstilgo2@auda.org.au', '1990-08-13');
insert into contact (id, name, phone, email, birthday) values (4, 'Jaymee Leverington', '+7 (379) 299-4519', 'jleverington3@ovh.net', '1990-06-10');
insert into contact (id, name, phone, email, birthday) values (5, 'Casper Gristwood', '+351 (170) 233-5967', 'cgristwood4@java.com', '1990-01-28');