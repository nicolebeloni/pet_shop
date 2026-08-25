create database pet_shop;
use pet_shop;

create table usuarios (
    id int auto_increment primary key,
    nome varchar(100) not null,
    email varchar(150) not null unique
);

create table animal (
    id int auto_increment primary key,
    nome varchar(100) not null,
    especie varchar(100) not null,
    raca varchar(100) not null,
    idade int not null,

    usuario_id int not null,
    foreign key (usuario_id) references usuarios(id)
);