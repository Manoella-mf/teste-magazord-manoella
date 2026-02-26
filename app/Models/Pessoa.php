<?php
namespace App\Models;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: "pessoas")]
class Pessoa {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\Column(type: "string", length: 150)]
    private $nome;

    #[ORM\Column(type: "string", length: 14, unique: true)]
    private $cpf;

    #[ORM\OneToMany(mappedBy: "pessoa", targetEntity: Contato::class, cascade: ["all"], orphanRemoval: true)]
    private Collection $contatos;

    public function __construct() {
        $this->contatos = new ArrayCollection();
    }

    public function getId() { return $this->id; }
    
    public function getNome() { return $this->nome; }
    public function setNome($nome) { $this->nome = $nome; }
    
    public function getCpf() { return $this->cpf; }
    public function setCpf($cpf) { $this->cpf = $cpf; }

    /** @return Collection|Contato[] */
    public function getContatos(): Collection {
        return $this->contatos;
    }

    public function addContato(Contato $contato): self {
        if (!$this->contatos->contains($contato)) {
            $this->contatos[] = $contato;
            $contato->setPessoa($this);
        }
        return $this;
    }

    public function removeContato(Contato $contato): self {
        if ($this->contatos->removeElement($contato)) {
            if ($contato->getPessoa() === $this) {
                $contato->setPessoa(null);
            }
        }
        return $this;
    }
}