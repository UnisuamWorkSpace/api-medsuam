<?php
// src/routes/api.php

// Recupera as variáveis vindos de index.php;
$requestPath = $path;
$requestMethod = $method;
$requestData = $data;
$requestGetData = null;

// Recupera os dados da requisição GET;
if ($requestMethod == 'GET') {
    $requestGetData = $_GET;
}

// Rota padrão ou rota vazia mostra que a API funciona;
if ($requestPath == '/' || $requestPath == '' && $requestMethod == 'GET') {
    echo json_encode([
        'status' => 200,
        'error' => false,
        'route' => $requestPath,
        'method' => $requestMethod,
        'data' => $requestGetData,
        'message' => 'API MedSuam funcionando!'
    ]);
    exit;
}

if ($requestMethod == 'GET' && !empty($requestGetData)) {
    // Rotas de Pacientes;
    if ($requestPath == '/pacientes' && $requestMethod == 'GET') {
        echo json_encode([
            'status' => 200,
            'error' => false,
            'route' => $requestPath,
            'method' => $requestMethod,
            'data' => $requestGetData,
            'message' => 'Listagem de pacientes'
        ]);
        exit;
    }

    // Rota de Médicos;
    if ($requestPath == '/medicos' && $requestMethod == 'GET') {
        echo json_encode([
            'status' => 200,
            'error' => false,
            'route' => $requestPath,
            'method' => $requestMethod,
            'data' => $requestGetData,
            'message' => 'Listagem de médicos'
        ]);
        exit;
    }
} else{
    http_response_code(400);
    echo json_encode([
        'status' => 400,
        'error' => true,
        'route' => $requestPath,
        'method' => $requestMethod,
        'data' => $requestGetData,
        'message' => 'Requisição inválida -> sem parâmetros'
    ]);
    exit;
}

// Se nenhuma rota for encontrada
http_response_code(404);
echo json_encode([
    'status' => 404,
    'error' => true,
    'route' => $requestPath,
    'method' => $requestMethod,
    'message' => 'Rota não encontrada'
]);