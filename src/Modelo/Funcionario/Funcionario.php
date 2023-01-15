<?php

namespace Alura\Banco\Modelo\Funcionario;

use Alura\Banco\Modelo\Cpf;
use Alura\Banco\Modelo\Pessoa;

abstract class Funcionario extends Pessoa
{
  private string $cargo;
  private float $salario;

  public function __construct(string $nome, Cpf $cpf, float $salario)
  {
    parent::__construct($nome, $cpf);
    $this->salario = $salario;
  }

  public function setNome(string $nome): void
  {
    $this->validaNomeTitular($nome);
    $this->nome = $nome;
  }

  public function receberAumento(float $valorAumento): void
  {
    if ($valorAumento < 0) {
      echo 'Aumento deve ser positivo';
      return;
    }

    $this->salario += $valorAumento;
  }

  public function getSalario(): float
  {
    return $this->salario;
  }
}
