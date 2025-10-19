<?php
// src/routes/api.php

// Simulando um roteador simples (você pode usar um pacote como Slim Framework depois)
$requestPath = $path;
$requestMethod = $method;

// Rota padrão
if ($requestPath == '/' && $requestMethod == 'GET') {
    echo json_encode(['message' => 'API MedSuam funcionando!']);
    exit;
}

// Rotas de Pacientes
if ($requestPath == '/pacientes' && $requestMethod == 'GET') {
    $controller = new src\controllers\PacienteController($db);
    $controller->listar();
    exit;
}

if (preg_match('/^\/pacientes\/(\d+)$/', $requestPath, $matches) && $requestMethod == 'GET') {
    $controller = new src\controllers\PacienteController($db);
    $controller->buscarPorId($matches[1]);
    exit;
}

if ($requestPath == '/pacientes' && $requestMethod == 'POST') {
    $controller = new src\controllers\PacienteController($db);
    $controller->criar();
    exit;
}

// Se nenhuma rota for encontrada
http_response_code(404);
echo json_encode(['error' => 'Rota não encontrada']);