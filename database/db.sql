create database pet_shop
use pet_shop;

create table usuarios (
    id int auto_increment primary key,
    nome varchar(100) not null,
    email varchar(150) not null unique
);

create table animal (
    id int auto_increment primary key,
    usuario_id int not null,
    nome varchar(100) not null,
    descricao text not null,
    preco decimal(10,2) not null,
    categoria varchar(100) not null

    constraint fk_animal_usuarios
        foreign key (usuario_id)
        references usuarios(id)
);