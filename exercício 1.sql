CREATE DATABASE vendas;
USE vendas;

CREATE TABLE Produto (
    Codigo INT PRIMARY KEY AUTO_INCREMENT, 
    Codigo_Produto INTEGER,
    Descricao_Produto VARCHAR(30),
    Preco_produto FLOAT
);

CREATE TABLE Nota_fiscal (
    Codigo INT PRIMARY KEY AUTO_INCREMENT,
    Numero_NF INTEGER,
    Data_NF DATE,
    Valor_NF FLOAT
);

CREATE TABLE Itens (
    Codigo INT PRIMARY KEY AUTO_INCREMENT,
    Produto_Codigo_Produto INTEGER,
    Nota_Fiscal_Numero_NF INTEGER,
    Num_Item INTEGER,
    Qtde_Item INTEGER
);

ALTER TABLE Produto
MODIFY COLUMN Descricao_Produto VARCHAR(50);

ALTER TABLE Nota_fiscal 
ADD COLUMN ICMS DECIMAL(10, 2) AFTER Numero_NF;

ALTER TABLE Produto 
ADD COLUMN Peso DECIMAL(10, 2);





SHOW CREATE TABLE Produto;

SHOW CREATE TABLE Nota_fiscal;

ALTER TABLE Nota_fiscal CHANGE Valor_NF Valor_Total_NF DECIMAL(10, 2);

ALTER TABLE Nota_fiscal DROP COLUMN Data_NF;

DROP TABLE Itens;

ALTER TABLE Nota_fiscal RENAME TO Venda;
