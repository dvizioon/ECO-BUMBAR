<?php
class ConexaoMySQLi
{
    private $conexao;

    public function __construct()
    {
        // Define as credenciais
        define('DB_HOST', 'localhost');
        define('DB_USER', 'Daniel');
        define('DB_PASS', '12345678');
        define('DB_NAME', 'ecobumbar');

        // Criar conexão com o banco de dados
        $this->conexao = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // Verificar conexão
        if ($this->conexao->connect_error) {
            die('Conexão falhou: ' . $this->conexao->connect_error);
        }
    }

    public function getConexao()
    {
        return $this->conexao;
    }
}

// Exemplo de uso:
// $conexao = new ConexaoMySQLi();
// $db = $conexao->getConexao();

// Agora você pode usar a variável $db para executar consultas SQL
// Exemplo: $result = $db->query('SELECT * FROM tabela');
