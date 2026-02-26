<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$autoload = __DIR__ . '/../vendor/autoload.php';
$bootstrap = __DIR__ . '/../config/bootstrap.php';

if (!file_exists($autoload)) {
    die("ERRO: O arquivo vendor/autoload.php não foi encontrado. Rode 'composer install'.");
}

require_once $autoload;

if (!file_exists($bootstrap)) {
    die("ERRO: O arquivo config/bootstrap.php não foi encontrado.");
}

$entityManager = require_once $bootstrap;

use App\Controllers\PessoaController;

$controller = new PessoaController($entityManager);

$acao = $_GET['acao'] ?? 'listar';
$id = $_GET['id'] ?? null;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Cadastro - Magazord</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php
    switch ($acao) {
        case 'listar':
            $controller->listar();
            break;
        case 'novo':
            $controller->formulario();
            break;
        case 'editar':
            $controller->formulario($id);
            break;
        case 'salvar':
            $controller->salvar($_POST);
            break;
        case 'excluir':
            $controller->excluir($id);
            break;
        default:
            $controller->listar();
            break;
    }
    ?>

</body>
</html>