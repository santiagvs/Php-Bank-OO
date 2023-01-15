<?php

namespace Alura\Banco\Modelo\Funcionario;

class Gerente extends Funcionario
{
  public function calcularBonificacao(): float
  {
    return $this->getSalario();
  }
}
