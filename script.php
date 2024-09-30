<?php
// Dados de conexão
$nomeServer = "localhost";
$nomeUsuario = "root";
$senha = "";
$nomeBd = "bd_artistas";

// Criando conexão
$conexao = new mysqli($nomeServer, $nomeUsuario, $senha, $nomeBd);

// Verificando conexão
if ($conexao->connect_error) {
    die("A conexão falhou: " . $conexao->connect_error);
}
echo "Conectado com sucesso.<br>";

// Função para executar e verificar o SQL
function executarSql($conexao, $sql, $mensagemSucesso) {
    if ($conexao->query($sql) === TRUE) {
        echo $mensagemSucesso . "<br>";
    } else {
        echo "Erro: " . $conexao->error . "<br>";
    }
}

// SQL para criar tabela de artistas
$sql = "CREATE TABLE IF NOT EXISTS artistas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    nacionalidade VARCHAR(50),
    data_nascimento DATE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

executarSql($conexao, $sql, "Tabela 'artistas' criada com sucesso.");

// Verifique se a tabela 'artistas' foi criada antes de criar as outras
$sql = "CREATE TABLE IF NOT EXISTS livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    autor_id INT,
    FOREIGN KEY (autor_id) REFERENCES artistas(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

executarSql($conexao, $sql, "Tabela 'livros' criada com sucesso.");

// SQL para criar tabela de discos
$sql = "CREATE TABLE IF NOT EXISTS discos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    artista_id INT,
    FOREIGN KEY (artista_id) REFERENCES artistas(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

executarSql($conexao, $sql, "Tabela 'discos' criada com sucesso.");

// Fechando a conexão
$conexao->close();
?>