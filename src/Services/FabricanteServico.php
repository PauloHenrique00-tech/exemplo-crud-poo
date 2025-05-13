<?php

namespace ExemploCrud\Services;

use Exception;
use ExemploCrud\Database\ConexaoBD;
use ExemploCrud\Models\Fabricante;
use PDO;
use Throwable;

final class FabricanteServico
{
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = ConexaoBD::getConexao();
    }

    public function listarTodos(): array
    {
        $sql = "SELECT * FROM fabricantes ORDER BY nome";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $erro) {
            throw new Exception("Erro ao carregar fabricantes: " . $erro->getMessage());
        }
    }

    public function inserir(Fabricante $fabricante): void
    {
        $sql = "INSERT INTO fabricantes(nome) VALUES(:nome)";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $fabricante->getNome(), PDO::PARAM_STR);
            $consulta->execute();
        } catch (Throwable $erro) {
            throw new Exception("Erro ao inserir: " . $erro->getMessage());
        }
    }

    public function buscarPorId(int $id): ?array
    {
        $sql = "SELECT * FROM fabricantes WHERE id = :id";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            $consulta->execute();

            /* Guardamos o resultado da operação fetch em uma variável */
            //$resultado = $consulta->fetch(PDO::FETCH_ASSOC);

            /* Se o resultado for verdadeiro, retornamos ele. Senão, retornamos null */
            //return $resultado ? $resultado : null;

            // Versão usando ternário simplificado usando 'elvis operator'
            return $consulta->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (Throwable $erro) {
           throw new Exception("Erro ao carregar fabricante: " . $erro->getMessage());
        }
    }
} // final da classe