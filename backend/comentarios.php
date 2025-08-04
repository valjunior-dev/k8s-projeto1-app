<?php
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, GET");

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $comentario = trim($_POST['comentario'] ?? '');

    if ($comentario === '') {
        http_response_code(400);
        echo "Comentário é obrigatório.";
        exit;
    }

    $servername = getenv('DB_HOST') ?: 'mysql';
    $username   = getenv('DB_USER') ?: 'dio';
    $password   = getenv('DB_PASS') ?: 'dio';
    $database   = getenv('DB_NAME') ?: 'dio';

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        http_response_code(500);
        echo "Erro de conexão: " . $conn->connect_error;
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO comments (nome, email, comentario) VALUES (?, ?, ?)");
    if (!$stmt) {
        http_response_code(500);
        echo "Erro na preparação da query: " . $conn->error;
        exit;
    }

    $stmt->bind_param("sss", $nome, $email, $comentario);

    if ($stmt->execute()) {
        echo "Comentário enviado com sucesso!";
    } else {
        http_response_code(500);
        echo "Erro ao salvar comentário: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    exit;

} else {
    echo "Backend está ativo. Use POST para enviar comentários.";
}
