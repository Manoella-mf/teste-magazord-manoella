<?php
namespace App\Controllers;

use App\Models\Pessoa;
use App\Models\Contato; 
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class PessoaController {
    private $entityManager;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function listar() {
        $busca = $_GET['busca'] ?? null;
        $repo = $this->entityManager->getRepository(Pessoa::class);

        if ($busca) {
            $pessoas = $repo->createQueryBuilder('p')
                ->where('p.nome LIKE :nome')
                ->setParameter('nome', '%'.$busca.'%')
                ->getQuery()->getResult();
        } else {
            $pessoas = $repo->findAll();
        }
        require __DIR__ . '/../../views/lista.php';
    }

    public function formulario($id = null) {
        $pessoa = null;
        if ($id) {
            $pessoa = $this->entityManager->find(Pessoa::class, $id);
        }
        require __DIR__ . '/../../views/form.php';
    }

    public function salvar($data) {
        try {
            if (!empty($data['id'])) {
                $pessoa = $this->entityManager->find(Pessoa::class, $data['id']);
                
                foreach ($pessoa->getContatos() as $contato) {
                    $this->entityManager->remove($contato);
                }
                $this->entityManager->flush(); 
            } else {
                $pessoa = new Pessoa();
            }

            $pessoa->setNome($data['nome']);
            $pessoa->setCpf($data['cpf']);

            if (isset($data['contato_tipo']) && is_array($data['contato_tipo'])) {
                foreach ($data['contato_tipo'] as $key => $tipo) {
                    if (!empty($data['contato_descricao'][$key])) {
                        $novoContato = new Contato(); 
                        $novoContato->setTipo($tipo);
                        $novoContato->setDescricao($data['contato_descricao'][$key]);
                        $pessoa->addContato($novoContato);
                    }
                }
            }

            $this->entityManager->persist($pessoa);
            $this->entityManager->flush();

            header('Location: index.php?acao=listar');
            exit;

        } catch (UniqueConstraintViolationException $e) {
            echo "<script>alert('Erro: CPF já cadastrado!'); window.history.back();</script>";
            exit;
        } catch (\Exception $e) {
            die("Erro crítico ao salvar: " . $e->getMessage());
        }
    }

    public function excluir($id) {
        $pessoa = $this->entityManager->find(Pessoa::class, $id);
        if ($pessoa) {
            $this->entityManager->remove($pessoa);
            $this->entityManager->flush();
        }
        header('Location: index.php?acao=listar');
        exit;
    }
}