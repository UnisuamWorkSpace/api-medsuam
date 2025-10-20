# Documentação do diretório `public`

## Arquivos

- `public/index.php`: É o front controller, é o único ponto público que carrega tudo. Facilita na segurança da API. (O Resto não é assecível via Web.)
    1. O código:

        ```php
            require_once __DIR__ . '/vendor/autoload.php';
        ```
