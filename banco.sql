CREATE DATABASE IF NOT EXISTS gestao_brinquedos;
USE gestao_brinquedos;

CREATE TABLE IF NOT EXISTS brinquedos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    faixa_etaria VARCHAR(30) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    estoque INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO brinquedos (nome, categoria, faixa_etaria, preco, estoque) VALUES
('Carrinho de Controle', 'Veículos', '5 anos+', 89.90, 12),
('Boneca de Pano', 'Bonecas', '3 anos+', 45.50, 20),
('Quebra-Cabeça 100 Peças', 'Jogos', '7 anos+', 32.00, 18),
('Pula-Pula Infantil', 'Esportes', '4 anos+', 150.00, 6);
