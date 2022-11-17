CREATE DATABASE loja;
USE loja;

CREATE TABLE IF NOT EXISTS itens
(
    codigo      int unsigned not null primary key auto_increment,
    nome        varchar(255) not null,
    preco       decimal not null,
    oferta      decimal null,
    imagem      varchar(255) not null
);