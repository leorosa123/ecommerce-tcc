CREATE SCHEMA `newtec-eco`;


CREATE TABLE `newtec-eco`.`usuarios` (
  `id_user` INT NOT NULL AUTO_INCREMENT,
  `user_user` VARCHAR(45) NOT NULL,
  `senha_user` VARCHAR(45) NOT NULL,
  `email_user` VARCHAR(75) NOT NULL,
  `telefone_user` INT NULL,
  `cpf_user` INT NULL,
  PRIMARY KEY (`id_user`));
  
  
  CREATE TABLE `newtec-eco`.`produtos` (
  `id_produto` INT NOT NULL AUTO_INCREMENT,
  `estoque_produto` INT NOT NULL,
  `valor_produto` DOUBLE NOT NULL,
  `desconto` INT NULL DEFAULT 0,
  `num_compra` VARCHAR(45) NULL,
  PRIMARY KEY (`id_produto`));
  
  
  CREATE TABLE `newtec-eco`.`vendas` (
  `id_venda` INT NOT NULL,
  `produto_venda` VARCHAR(45) NOT NULL,
  `quantidade` INT NOT NULL,
  `valor_venda` DOUBLE NULL,
  PRIMARY KEY (`id_venda`));
  
ALTER TABLE `newtec-eco`.`produtos` 
ADD COLUMN `path_produto` VARCHAR(500) NULL AFTER `num_compra`;

ALTER TABLE `newtec-eco`.`produtos` 
ADD COLUMN `nome_produto` VARCHAR(45) NOT NULL AFTER `path_produto`;


ALTER TABLE `newtec-eco`.`produtos` 
ADD COLUMN `categoria` VARCHAR(75) NOT NULL AFTER `nome_produto`;




ALTER TABLE `newtec-eco`.`vendas` 
DROP COLUMN `quantidade`,
DROP COLUMN `produto_venda`,
ADD COLUMN `user_comprador` VARCHAR(45) NOT NULL AFTER `valor_venda`;




ALTER TABLE `newtec-eco`.`vendas` 
ADD COLUMN `num_compra` VARCHAR(45) NOT NULL AFTER `user_comprador`,
CHANGE COLUMN `valor_venda` `valor_venda` VARCHAR(75) NULL DEFAULT NULL ;


ALTER TABLE `newtec-eco`.`vendas` 
CHANGE COLUMN `id_venda` `id_venda` INT(11) NOT NULL AUTO_INCREMENT ;





  
  

