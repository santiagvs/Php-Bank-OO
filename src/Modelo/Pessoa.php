<?php

namespace Alura\Banco\Modelo;

class Pessoa
{
  use AcessoPropriedades;

  protected string $nome;
  protected Cpf $cpf;

  public function __construct(string $nome, Cpf $cpf)
  {
    $this->nome = $nome;
    $this->cpf = $cpf;
  }

  public function getNome(): string
  {
    return  $this->nome . PHP_EOL;
  }

  public function getCpf()
  {
    return $this->cpf->getNumeroCpf() . PHP_EOL;
  }

  protected function validaNome($nome)
  {
    if (strlen($nome) < 5) {
      echo 'Nome precisa ter pelo menos 5 caracteres';
      exit();
    }
  }
}
