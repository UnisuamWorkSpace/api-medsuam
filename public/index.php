<?php
// public/index.php

require_once __DIR__ . '/../vendor/autoload.php';

// Carrega as variáveis de ambiente
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Configurações iniciais
header('Content-Type: application/json; charset=utf-8'); // Define o tipo de conteúdo como JSON UTF-8;
header('Access-Control-Allow-Origin: *'); // Permite o acesso de qualquer origem (CORS);
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS'); // Define os métodos permitidos (CORS);
header('Access-Control-Allow-Headers: Content-Type, Authorization'); // Define os cabeçalhos permitidos (CORS);

// Lidar com preflight requests (CORS)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}
try {
    // Obtém o método e path da requisição
    $method = $_SERVER['REQUEST_METHOD'];
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $path = str_replace('/api-medsuam', '', $path); // Remove o base path se necessário

    // Responde com o método e path da requisição;
    echo json_encode([
        'message' => 'Requisição recebida',
        'status' => 200,
        'method' => $method,
        'path' => $path,
    ]);

    // A partir daqui, implementarei as rotas e os methodos para que funcione a API;
    if ($method == 'GET' && $path == '/pacientes') {
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Erro interno do servidor',
        'message' => $e->getMessage()
    ]);
}
?>