/* 
	SQL - pizzaria
	DB para um aplicativo de pizzaria
	@author Felipe Galvão Canalli
*/

create database dbpizzaria;
use dbpizzaria;

create table tbendereco(
	idendereco INT AUTO_INCREMENT PRIMARY KEY ,
    identificador VARCHAR(20) NOT NULL,
    tipo VARCHAR(20) NOT NULL,
    logradouro VARCHAR(100) NOT NULL,
	numero VARCHAR(10) NOT NULL, -- varchar pois pode conter letra
    complemento VARCHAR(20),
    bairro VARCHAR(50) NOT NULL, 
    cep VARCHAR(14) NOT NULL,
    referencia VARCHAR(50)
)ENGINE INNODB;

create table tbcontato(
	idcontato INT AUTO_INCREMENT PRIMARY KEY,
    telefone VARCHAR(18),
    celular VARCHAR(18) NOT NULL,
    email VARCHAR(100)
)ENGINE INNODB;

create table tbcliente(
	idcliente INT AUTO_INCREMENT PRIMARY KEY,
    nomecli VARCHAR(100) NOT NULL,
    cpf VARCHAR (14) NOT NULL,
    idcontato INT NOT NULL,
    idendereco INT NOT NULL
)ENGINE INNODB;

create table tbproduto(
	idproduto INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR (20) NOT NULL,
    nomeproduto VARCHAR(50) NOT NULL,
    descricao VARCHAR (100) ,
    preco DECIMAL(10 , 2 ) NOT NULL
)ENGINE INNODB;

create table tbpedido(
	idpedido INT AUTO_INCREMENT PRIMARY KEY,
	datapedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	idcliente INT NOT NULL,
	idendereco INT NOT NULL,
    recebimento VARCHAR (20) NOT NULL,
    situacao VARCHAR (50) NOT NULL
)ENGINE INNODB;

create table tbitenspedido(
	iditens INT AUTO_INCREMENT PRIMARY KEY,
    idpedido INT NOT NULL,
    idproduto INT NOT NULL,
    quantidade INT DEFAULT 1 NOT NULL, -- por padrão 1
	observacao1 text,
    metade VARCHAR (50),
	observacao2 text,
    adicionais VARCHAR (50)
)ENGINE INNODB;

create table tbpagamento(
	idpagamento INT AUTO_INCREMENT PRIMARY KEY,
    idpedido INT NOT NULL,
    forma VARCHAR (8) NOT NULL,
    bandeira VARCHAR (20),
    total DECIMAL(10 , 2 ) NOT NULL, 
	troco DECIMAL(10 , 2 )
)ENGINE INNODB;

-- Setando as chaves estrangeiras

-- tbcliente
ALTER TABLE `dbpizzaria`.`tbcliente` 
ADD CONSTRAINT `FK_cliente_PK_contato`
  FOREIGN KEY (`idcontato`)
  REFERENCES `dbpizzaria`.`tbcontato` (`idcontato`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
ALTER TABLE `dbpizzaria`.`tbcliente` 
ADD CONSTRAINT `FK_cliente_PK_endereco`
  FOREIGN KEY (`idendereco`)
  REFERENCES `dbpizzaria`.`tbendereco` (`idendereco`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

  -- tbpedido
  ALTER TABLE `dbpizzaria`.`tbpedido` 
ADD CONSTRAINT `FK_pedido_PK_cliente`
  FOREIGN KEY (`idcliente`)
  REFERENCES `dbpizzaria`.`tbcliente` (`idcliente`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

  ALTER TABLE `dbpizzaria`.`tbpedido` 
ADD CONSTRAINT `FK_pedido_PK_endereco`
  FOREIGN KEY (`idendereco`)
  REFERENCES `dbpizzaria`.`tbendereco` (`idendereco`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

  -- tbitenspedido
  ALTER TABLE `dbpizzaria`.`tbitenspedido` 
ADD CONSTRAINT `FK_itenspedido_PK_pedido`
  FOREIGN KEY (`idpedido`)
  REFERENCES `dbpizzaria`.`tbpedido` (`idpedido`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
  ALTER TABLE `dbpizzaria`.`tbitenspedido` 
ADD CONSTRAINT `FK_itenspedido_PK_produto`
  FOREIGN KEY (`idproduto`)
  REFERENCES `dbpizzaria`.`tbproduto` (`idproduto`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
    -- tbpagamento
  ALTER TABLE `dbpizzaria`.`tbpagamento` 
ADD CONSTRAINT `FK_pagamento_PK_pedido`
  FOREIGN KEY (`idpedido`)
  REFERENCES `dbpizzaria`.`tbpedido` (`idpedido`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
   -- inserindo dados nas tabelas manualmente para teste de funcionalidade e relacionamentos
   
 -- tbendereco
 INSERT into tbendereco (identificador, tipo, logradouro, numero, complemento, bairro, cep, referencia) 
 VALUES('Casa','Rua','Comendador','900','casa dos fundos','Ponte Rasa','02313-100','Esquina do posto' );
 
 INSERT into tbendereco (identificador, tipo, logradouro, numero, complemento, bairro, cep, referencia) 
 VALUES('Minha casa','Av','Mercador filho','131','casa 1','Jd Banana','13567-500','' );
 select * from tbendereco;
 
  -- tbcontato
 INSERT into tbcontato (telefone,celular,email) VALUES('2320-1356','11 99837-1111','rogeriolimao@hotmail.com');
 INSERT into tbcontato (telefone,celular,email) VALUES('11 2301-3455','11 91111-1222','felipegoibada@gmail.com');
 select * from tbcontato;
  
 -- tbcliente
 INSERT into tbcliente (nomecli,cpf,idcontato,idendereco) VALUES('Rogerio Limão da Silva','444.233.442-11','1','1');
 INSERT into tbcliente (nomecli,cpf,idcontato,idendereco) VALUES('Felipe Galvão Canalli','554.111.512-13','2','2'); 
 select * from tbcliente;

 -- tbproduto
 INSERT into tbproduto (tipo,nomeproduto,descricao,preco) VALUES('Pizza salgada','Bacon I','Bacon, mussarela','27.00');
 INSERT into tbproduto (tipo,nomeproduto,descricao,preco) VALUES('Pizza salgada','Bacon II','Bacon, Catupiry','27.00');
 INSERT into tbproduto (tipo,nomeproduto,descricao,preco) VALUES('Bebida','Dolly 2L','Refrigerante Dolly 2 litros gelado','7.00');
 INSERT into tbproduto (tipo,nomeproduto,descricao,preco) VALUES('Bebida','Itubaina 2L','Refrigerante Itubaina 2 litros gelado ','7.00');
  select * from tbproduto;

 -- tbpedido
 INSERT into tbpedido (idcliente,idendereco,recebimento,situacao) VALUES('2','2','Entrega','Em andamento');
 select * from tbpedido;
 
  -- tbpedido
 INSERT into tbpedido (idcliente,idendereco,recebimento,situacao) VALUES('2','2','Entrega','Em andamento');
 select * from tbpedido;

  -- tbitenspedido
 INSERT into tbitenspedido (idpedido,idproduto,quantidade,observacao1) VALUES('1','2','1','Sem azeitona');
 select * from tbitenspedido;
 
   -- tbpagamento
  INSERT into tbpagamento (idpedido,forma,total,troco) VALUES('1','dinheiro','27','3');
  select * from tbpagamento;
 







