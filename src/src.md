# Docuemntação do diretório `src`

## Arquivos

- `src/database.php`: Guarda a conexão PDO (com prepared statements).
  - Explicação do código:

    ```php
        <?php
        // src/Database.php

        // Criando a classe Database, que será Singleton Pattern, esse é um padrão de projeto que garante que a classe criada tenha apenas uma única instancia durante toda a execução do programa e fornece um ponto global de acesso a esta instancia;
        class Database {
            private static $instance = null; // Responsável por armazenar uma única instância que será compartilhado por todas as chamadas da classe;
            private $pdo; // Armazenará a conexão PDO real com o banco de dados;

            // Construtor privado da classe, semelhante ao (def __init__ em Python);
            // O private torna algo interno e somante usado pelos métodos da classe, isso impede que alguém faça um new Database() fora da classe;
            // O array $config é o que será passado para a classe Database;
            private function __construct(array $config) {
                $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}"; // String de argumentos para conectar ao banco de dados;
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Lança exceções em caso de erro;
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Retorna resultado como array associativo;
                    PDO::ATTR_EMULATE_PREPARES => false, // força prepared statements reais, mais seguro;
                ]; // Opções de configuração da conexão PDO;
                $this->pdo = new PDO($dsn, $config['user'], $config['pass'], $options); // Cria uma conexão Real com o banco de dados usando a classe PDO, passando os parâmetros;
            }

            // Função que retorna uma instância da classe Database, se ela ainda não foi criada;
            // Método estático para garantir que a instância seja compartilhada por todas as chamadas da classe;
            //Uso: Database::getInstance();
            public static function getInstance() {
                if (self::$instance === null) { // Verifica se a instância ainda nao foi criada;
                // Se a instância ainda nao foi criada, cria uma nova instância da classe Database com as configurações do banco de dados;
                    $config = require __DIR__ . '/../config/config.php'; // Carrega as configurações do banco de dados;
                    self::$instance = new Database($config['db_credentials']);// Cria uma nova instância da classe Database com as configurações do banco de dados;
                }
                return self::$instance; // Retorna a instância da classe Database se ela já existir;
            }

            // Retorna a conexão PDO real com o banco de dados para que seja possível executar queries SQL;
            // Uso: $pdo = Database::getInstance()->getConnection();
            // $stmt = $pdo->prepare($sql); Aqui stmt significa statement, que é o nome dado ao objeto que representa uma query preparada para ser executada.
            // $result = $stmt->execute();
            public function getConnection() {
                return $this->pdo; // Retorna a conexão PDO real com o banco de dados;
            }
        }
    ```

- `src/controllers/`: Contém a lógica de receber request e chamar Models.
- `src/models/`: Contém classes que falam diretamente com o DB.
- `src/routes/`: Define endpoints e mapeia para controllers.
- `src/middlewares/`: Para autenticação (JWT), rate-limit, CORS.
- `src/uploads/`: Para arquivos (com .gitignore).
- `src/sql/`: Para backups/povoamento.