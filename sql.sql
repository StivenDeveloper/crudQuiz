create database crudsystem;
use crudsystem;
create table crudtable(
    id int not null auto_increment primary key,
    name varchar(30),
    lastName varchar(30),
    email varchar (45),
    pass varchar(20)
);

insert into crudtable(name,lastName,email,pass)values('evert','rivera','evert@gmail.com','123');