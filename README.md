# Teste Técnico - CRUD de Pessoas (Magazord)

Este projeto é um sistema de cadastro (CRUD) desenvolvido para o processo seletivo da Magazord, nele é permitido cadastrar, listar, editar e excluir pessoas, utilizando PHP moderno e boas práticas de arquitetura.

## Tecnologias Utilizadas
* **PHP 8.x**
* **Doctrine ORM**: Para persistência e mapeamento de dados.
* **MySQL**: Banco de dados.
* **MVC (Model-View-Controller)**: Padrão de arquitetura.
* **Composer**: Gestão de dependências.


## Como Executar o Projeto
Siga os passos abaixo para configurar o ambiente em sua máquina:

1. Clonar o Repositório
Abra o terminal e execute:

* git clone https://github.com/Manoella-mf/teste-magazord-manoella.git
cd teste-magazord-manoella

2. Instalar Dependências (Essencial)
   
Como a pasta vendor não é enviada ao repositório, você deve instalar as dependências do projeto (Doctrine, etc.) usando o Composer:

* **composer install**

3. Configuração do Banco de Dados
Crie um banco de dados MySQL chamado magazord_teste.

Configure as credenciais de acesso (usuário e senha) no arquivo .env ou diretamente no config/bootstrap.php.

Gerar Tabelas: Para criar a estrutura de pessoas e contatos automaticamente, execute:

* **php vendor/bin/doctrine orm:schema-tool:update --force**

4. Iniciar o Servidor
Na raiz do projeto, utilize o servidor embutido do PHP apontando para a pasta pública:


* **php -S localhost:8000 -t public**

5. Acesso
Abra o seu navegador e acesse: http://localhost:8000
