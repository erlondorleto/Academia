<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Seu código começa aqui...
// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Inclui a conexão com o banco de dados
    include __DIR__ . '/conexao.php';

    // Captura os dados do formulário
    $nome  = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $nivel = $_POST['nivel'] ?? '';

    // Validação dos campos
    if (empty($nome) || empty($email) || empty($senha) || empty($nivel)) {
        echo "<p>❌ Todos os campos são obrigatórios.</p>";
        exit;
    }

    // Criptografar a senha
    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

    // Preparar a query para evitar SQL Injection
    $stmt = $conn->prepare("INSERT INTO alunos (nome, email, senha, nivel) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nome, $email, $senhaCriptografada, $nivel);

    // Executar e verificar resultado
    if ($stmt->execute()) {
        // Redireciona para o formulário de anamnese com o nível como parâmetro
        header("Location: anamnese.html?nivel=" . urlencode($nivel));
        exit;
    } else {
        echo "<p>❌ Erro ao cadastrar: " . $stmt->error . "</p>";
    }

    // Fechar conexões
    $stmt->close();
    $conn->close();

} else {
    echo "<p>Erro: método de envio inválido.</p>";
}
?>