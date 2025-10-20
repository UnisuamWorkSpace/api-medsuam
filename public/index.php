<?php
// public/index.php

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Lidar com preflight requests (CORS);
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}
try {
    // Tenta recuperar o método da requisição e o path(URL) da requisição;
    $method = $_SERVER['REQUEST_METHOD'];
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $path = str_replace('/api-medsuam', '', $path);
    $path = str_replace('/public', '', $path);
    $path = str_replace('/index.php', '', $path);

    // Tenta recuperar os dados da requisição, ou seja o JSON enviado no corpo da requisição pelo front-end;
    $json = file_get_contents('php://input', true);
    // Tenta converter o JSON em um array associativo;
    $data = json_decode($json, true);
    // Verificando se o método da requisição não for GET e se o Array está vazio;
    if (!$data && $method != 'GET') {
        http_response_code(400);
        echo json_encode([
            'status' => 400,
            'error' => 'JSON inválido ou vazio'
        ]);
        exit();
    } else {
        require_once __DIR__ . '/../src/routes/api.php';
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Erro interno do servidor',
        'message' => $e->getMessage()
    ]);
}
?>