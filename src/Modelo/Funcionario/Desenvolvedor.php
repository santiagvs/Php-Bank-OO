<?php

namespace Alura\Banco\Modelo\Funcionario;

class Desenvolvedor extends Funcionario
{
  public function sobeDeNivel()
  {
    $this->receberAumento($this->getSalario() * 0.75);
  }

  public function calcularBonificacao(): float
  {
    return 500.0;
  }
}
