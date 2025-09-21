
<?php
// Exibir erros para depuração
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "alunos_db");

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Dados do aluno (exemplo fixo)
$nome = "Teste";
$email = "teste@example.com";
$senha = password_hash("123456", PASSWORD_DEFAULT);

// Prepara a instrução SQL para evitar SQL Injection
$stmt = $conn->prepare("INSERT INTO alunos (nome, email, senha) VALUES (?, ?, ?)");

if ($stmt) {
    $stmt->bind_param("sss", $nome, $email, $senha);

    if ($stmt->execute()) {
        echo "✅ Inserção de teste realizada com sucesso!";
    } else {
        echo "❌ Erro ao executar: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "❌ Erro ao preparar a query: " . $conn->error;
}

$conn->close();
?>