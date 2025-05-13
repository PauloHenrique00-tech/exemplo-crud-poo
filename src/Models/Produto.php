<?php

namespace ExemploCrud\Models;

use InvalidArgumentException;

final class Produto
{
    private ?int $id;
    private string $nome;
    private ?string $descricao;
    private float $preco;
    private int $quantidade;
    private int $fabricanteId;

    public function __construct(
        string $nome,
        float $preco,
        int $quantidade,
        int $fabricanteId,
        ?int $id = null,
        ?string $descricao = null
    ) {

        $this->setNome($nome);
        $this->setPreco($preco);
        $this->setQuantidade($quantidade);
        $this->setDescricao($descricao);
        $this->setFabricanteId($fabricanteId);
        $this->setId($id);

        $this->validar();
    }

    private function validar(): void
    {
        if (empty($this->nome)) {
            throw new InvalidArgumentException("O nome do produto é obrigatório.");
        }
        if ($this->preco <= 0) {
            throw new InvalidArgumentException("O preço deve ser maior que zero.");
        }
        if ($this->quantidade < 0) {
            throw new InvalidArgumentException("A quantidade não pode ser negativa.");
        }
        if ($this->fabricanteId <= 0) {
            throw new InvalidArgumentException("O ID do fabricante deve ser válido.");
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getNome(): string
    {
        return $this->nome;
    }
    public function getDescricao(): ?string
    {
        return $this->descricao;
    }
    public function getPreco(): float
    {
        return $this->preco;
    }
    public function getQuantidade(): int
    {
        return $this->quantidade;
    }
    public function getFabricanteId(): int
    {
        return $this->fabricanteId;
    }

    private function setId(?int $id): void
    {
        $this->id = $id;
    }

    private function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    private function setDescricao(?string $descricao): void
    {
        $this->descricao = $descricao;
    }

    private function setPreco(float $preco): void
    {
        $this->preco = $preco;
    }

    private function setQuantidade(int $quantidade): void
    {
        $this->quantidade = $quantidade;
    }

    private function setFabricanteId(int $fabricanteId): void
    {
        $this->fabricanteId = $fabricanteId;
    }
}
 