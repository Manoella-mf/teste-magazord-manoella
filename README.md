# Teste Técnico - CRUD de Pessoas (Magazord)

Este projeto é um sistema de cadastro (CRUD) desenvolvido para o processo seletivo da Magazord, nele é permitido cadastrar, listar, editar e excluir pessoas, utilizando PHP moderno e boas práticas de arquitetura.

## Tecnologias Utilizadas
* **PHP 8.x**
* **Doctrine ORM**: Para persistência e mapeamento de dados.
* **MySQL**: Banco de dados.
* **MVC (Model-View-Controller)**: Padrão de arquitetura.
* **Composer**: Gestão de dependências.


## Como Executar o Projeto

1. **Clonar o Repositório**:
   ```bash
    git clone [https://github.com/Manoella-mf/teste-magazord-manoella.git](https://github.com/Manoella-mf/teste-magazord-manoella.git)
   cd teste-magazord-manoella
Instalar Dependências:
Execute o Composer para baixar as pastas do Doctrine e outras bibliotecas:

Bash
composer install
Configuração do Banco de Dados:

Crie um banco de dados chamado magazord_teste.

Configure as credenciais de acesso no arquivo .env (ou no bootstrap.php, dependendo de onde você colocou a conexão).

Importante: Para criar as tabelas, execute o comando:

Bash
php vendor/bin/doctrine orm:schema-tool:update --force
(Caso o comando cli falhe, utilize o script SQL contido na pasta /sql ou execute manualmente o CREATE TABLE das entidades).

Iniciar Servidor Local:
Na raiz do projeto, utilize o servidor embutido do PHP apontando para a pasta public:

Bash
php -S localhost:8000 -t public
Acesso:
Abra o navegador em: http://localhost:8000
