-- Sctript SQL de Criação (DDL) e população (DML) do Banco de dados
drop database if exists estacionamento;
create database estacionamento;
use estacionamento;
create table registro
(
    id_registro int primary key auto_increment,
    tipo varchar(10) not null,
    placa varchar(8) not null,
    entrada time not null,
    saida time,
    valor decimal(8,2),
    data_registro date
);

/*insert into registro
VALUES
    (DEFAULT, "moto","AAA1111", curtime(), curtime()+interval 1 hour, 10, curdate()),

    (DEFAULT, "moto","AAA2222", curtime()+interval -5 hour,curtime()+interval -3 hour, 10, curdate()),

    (DEFAULT, "moto", "AAA3333", now()-3, now()-2, 5, curdate()),

    (DEFAULT, "moto","AAA4444", now()-2, now()-1, 5, curdate()),

    (DEFAULT, "carro","AAA5555", now()-1, now(), 5, curdate()),

    (DEFAULT, "carro", "AAA6666", now(), null, 5, curdate()),

    (DEFAULT, "carro","AAA7777", now(), null, 10, curdate());*/
    

select * from registro;