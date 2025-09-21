<?php
session_start();

// Conexão com o banco
$conn = new mysqli("localhost", "root", "", "academia");
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Captura os dados do formulário
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

// Verifica se o email existe
$stmt = $conn->prepare("SELECT id, nome, senha, nivel FROM alunos WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $alunos = $result->fetch_assoc();

    // Verifica a senha
    if (password_verify($senha, $alunos['senha'])) {
        $_SESSION['id'] = $alunos['id'];
        $_SESSION['nome'] = $alunos['nome'];
        $_SESSION['nivel'] = $alunos['nivel'];

        // Normaliza o nível para evitar erros de acentuação ou capitalização
        $nivel = strtolower(trim($alunos['nivel']));
        $nivelLimpo = preg_replace('/[áàâã]/', 'a', $nivel);
        $nivelLimpo = preg_replace('/[éèê]/', 'e', $nivelLimpo);
        $nivelLimpo = preg_replace('/[íìî]/', 'i', $nivelLimpo);
        $nivelLimpo = preg_replace('/[óòôõ]/', 'o', $nivelLimpo);
        $nivelLimpo = preg_replace('/[úùû]/', 'u', $nivelLimpo);

        // Redireciona para o formulário de anamnese com o nível como parâmetro
       header("Location: formulario.html?nivel=" . urlencode($nivelLimpo));
        exit;
    } else {
        echo "<p>❌ Senha incorreta.</p>";
    }
} else {
    echo "<p>❌ Email não encontrado.</p>";
}

$stmt->close();
$conn->close();
?>