<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? '';

    if (!empty($email)) {
        ?>
        <!DOCTYPE html>
        <html lang="pt-PT">
        <head>
            <meta charset="UTF-8">
            <title>Recuperação enviada</title>
            <link rel="stylesheet" href="index.css">
        </head>
        <body>
            <div class="login-container">
                <h2>✅ Instruções de recuperação foram enviadas para:</h2>
                <p><?php echo htmlspecialchars($email); ?></p>
                <a href="recuperar_senha.html">Voltar</a>
            </div>
            <div class="left">
      <img src="placa.png" class="placa" alt="Logo">
    </div>
        </body>
        </html>
        <?php
    } else {
        echo "❌ E-mail não fornecido.";
    }
} else {
    echo "❌ Método de acesso inválido.";
}
?>