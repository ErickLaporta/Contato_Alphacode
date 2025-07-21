CREATE DATABASE IF NOT EXISTS contatos_db ;

USE contatos_db;

CREATE TABLE IF NOT EXISTS contatos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    celular VARCHAR(20) NOT NULL,
    profissao VARCHAR(255) NOT NULL,
    nascimento DATE NOT NULL,
    whatsapp TINYINT(1) DEFAULT 0,
    sms TINYINT(1) DEFAULT 0,
    notificarEmail TINYINT(1) DEFAULT 0
);