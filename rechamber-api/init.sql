ALTER USER 'app_user'@'%' IDENTIFIED WITH mysql_native_password BY 'app_pass';
use rechamberdb;
create table users (id int, username varchar(255), email varchar(255), password varchar(255));
insert into users values (1,'mega', 'a@aol.com', 'sec');
insert into users values (2,'oli', 'b@aol.com', 'secsec');
