CREATE DATABASE restaurante;
USE restaurante;

CREATE TABLE IF NOT EXISTS administrador (
id_adm INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
email VARCHAR(30),
senha VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS mesa (
id_mesa INT PRIMARY KEY NOT NULL,
descricao VARCHAR(100),
imagem	VARCHAR(100),
id_adm INT,
FOREIGN KEY (id_adm) REFERENCES administrador (id_adm)
);

CREATE TABLE IF NOT EXISTS pedido (
 id_pedido INT Primary Key AUTO_INCREMENT NOT NULL,
 hora_pedido TIME,
 data_pedido DATE,
 status VARCHAR(100),
 id_mesa INT,
 FOREIGN KEY(id_mesa) REFERENCES mesa (id_mesa)
);
 
 CREATE TABLE IF NOT EXISTS itens (
 id_itens_pedido INT Primary key NOT NULL,
 composicao VARCHAR(270),
 descricao_item VARCHAR(100),
 preco FLOAT(10,2),
 tipo_item VARCHAR(100),
 imagem VARCHAR(100),	
 id_adm INT,
 foreign KEY (id_adm) REFERENCES administrador (id_adm)
 );
 
 CREATE TABLE IF NOT EXISTS pedido_itens (
id INT Primary Key AUTO_INCREMENT NOT NULL,
id_pedido INT,
id_itens_pedido INT,
quantidade INT,
descricao_ponto_lanche VARCHAR(255),
valor_tot_item float(10,2),
 FOREIGN KEY (id_pedido) references pedido (id_pedido),
 FOREIGN KEY (id_itens_pedido) REFERENCES itens (id_itens_pedido)
 );
 
 -- Inserindo um registro na tabela administrador 
 INSERT INTO administrador (email, senha) VALUES ('wise_qrcode@gmail.com',md5('12345'));