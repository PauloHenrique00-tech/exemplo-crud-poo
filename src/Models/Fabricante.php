<?php
namespace ExemploCrud;

use InvalidArgumentExeception;

final class Fabricante {
    private ?int $id;
    private string $nome;

    public function __construct(string $nome, ?int $id = null)
    {
        $this->setNome($nome);
        $this->setId($id);
        $this->validar();
    }

    private function validar():void
    {
        if (empty($this->nome)) {
            throw new InvalidArgumentException("Nome é obrigatório");
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): string {
        return $this->nome;
    }

    private function setId(?int $id): void
    {
        $this->id = $id;
    }

    private function setNome(string $nome): void
    {
        $this->nome = $nome;
    }
}