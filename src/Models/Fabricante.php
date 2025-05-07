<?php
namespace ExemploCrud;

final class Fabricante {
    private ?int $id;
    private string $nome;

    public function __construct(string $nome, ?int $id = null)
    {
        $this->setNome($nome);
        $this->setId($id);
        $this->validar();
    }
}