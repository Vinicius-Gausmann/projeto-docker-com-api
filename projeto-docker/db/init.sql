CREATE TABLE games (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    genero VARCHAR(50),
    plataforma VARCHAR(50),
    ano INT
);

INSERT INTO games (nome, genero, plataforma, ano) VALUES
('The Witcher 3', 'RPG', 'PC', 2015),
('Hollow Knight', 'Metroidvania', 'PC', 2017);