<?php

namespace Alura\Banco\Modelo;

trait AcessoPropriedades // funciona como módulo
{
  public function __get(string $nomeAtributo)
  {
    $metodo = 'get' . ucfirst($nomeAtributo);
    return $this->$metodo();
  }
}
