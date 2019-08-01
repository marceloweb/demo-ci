USE twitter;

CREATE TABLE ranking (
id int(11) not null auto_increment primary key,
name varchar(100) not null,
screen_name varchar(100) not null,
followers_count int(5) not null
);
