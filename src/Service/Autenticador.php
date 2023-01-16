<?php

namespace Alura\Banco\Service;

use Alura\Banco\Modelo\Autenticavel;

class Autenticador
{
  public function tentaLogin(Autenticavel $autenticavel, string $senha): void
  {
    if ($autenticavel->podeAutenticar($senha)) {
      echo 'Ok, logado com sucesso' . PHP_EOL;
    } else {
      echo 'Ops, a senha está incorreta' . PHP_EOL;
    }
  }
}
