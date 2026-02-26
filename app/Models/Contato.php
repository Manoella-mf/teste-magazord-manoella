<?php
namespace App\Models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "contatos")]
class Contato {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\Column(type: "string", length: 20)]
    private $tipo; 

    #[ORM\Column(type: "string", length: 255)]
    private $descricao;

    #[ORM\ManyToOne(targetEntity: Pessoa::class, inversedBy: "contatos")]
    #[ORM\JoinColumn(name: "pessoa_id", referencedColumnName: "id", nullable: false, onDelete: "CASCADE")]
    private ?Pessoa $pessoa;

    public function getId() { return $this->id; }

    public function getTipo() { return $this->tipo; }
    public function setTipo($tipo) { $this->tipo = $tipo; }

    public function getDescricao() { return $this->descricao; }
    public function setDescricao($descricao) { $this->descricao = $descricao; }

    public function getPessoa(): ?Pessoa { return $this->pessoa; }
    public function setPessoa(?Pessoa $pessoa) { $this->pessoa = $pessoa; }
}