# Documentação do diretório `public`

## Arquivos

- `public/index.php`: É o front controller, é o único ponto público que carrega tudo. Facilita na segurança da API. (O Resto não é assecível via Web.)
    1. O código:

        ```php
            <?php
            // public/index.php

            require_once __DIR__ . '/../vendor/autoload.php';

            // Carrega as variáveis de ambiente
            $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
            $dotenv->load();

            // Configurações iniciais de cabeçalhos de retorno para o cliente;
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


                // Recuperar os dados da requisição;
                $json = file_get_contents('php://input', true); // Obtem o corpo da requisição;
                $data = json_decode($json, true); // Decodifica o corpo da requisição em um array associativo;
                if (!$data){ // Verifica se o JSON está vazio ou inválido;
                    http_response_code(400); // Define o código de status da resposta como 400 Bad Request;
                    echo json_encode(['error' => 'JSON inválido ou vazio']); // Retorna uma mensagem de erro;
                    exit(); // Encerra a execução do script;
                }

                // A partir daqui, implementarei as rotas e os methodos para que funcione a API;
                if ($method == 'POST') {
                    // Passo 1 do CRUD que é criar usuarios;
                }
                if ($method == 'GET') {
                    // Passo 2 do CRUD que é listar usuarios;
                }
                if ($method == 'PUT') {
                    // Passo 3 do CRUD que é atualizar usuarios;
                }
                if ($method == 'DELETE') {
                    // Passo 4 do CRUD que é deletar usuarios;
                }

            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode([
                    'error' => 'Erro interno do servidor',
                    'message' => $e->getMessage()
                ]);
            }
            ?>
        ```
