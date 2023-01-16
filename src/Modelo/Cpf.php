<?php

namespace Alura\Banco\Modelo;

class Cpf
{
  private string $cpf;

  public function __construct(string $cpf)
  {
    $this->cpf = $cpf;
    $this->validaCpf();
  }

  public function getNumeroCpf()
  {
    return $this->cpf;
  }

  private function validaCpf()
  {
    $cpfLimpo = $this->limpaCpf();
    $primeiroDigito = $this->validaPrimeiroDigito();
    $segundoDigito = $this->validaSegundoDigito($primeiroDigito);

    $cpfFromInput = preg_replace('/\W/', '', $this->cpf);
    $cpfCompleto = $cpfLimpo . $primeiroDigito . $segundoDigito;

    if ($cpfFromInput != $cpfCompleto) {
      throw new \Exception('CPF inválido');
    } else {
      echo "O cpf $cpfCompleto é válido e correto." . PHP_EOL;
    }
  }

  private function validaPrimeiroDigito()
  {
    $cpfLimpo = $this->limpaCpf();
    $multiplicador = 10;
    return $this->calcularDigito($cpfLimpo, $multiplicador);
  }

  private function validaSegundoDigito($primeiroDigito)
  {
    $cpfLimpo = $this->limpaCpf() . $primeiroDigito;
    $multiplicador = 11;
    return $this->calcularDigito($cpfLimpo, $multiplicador);
  }

  private function calcularDigito($cpfLimpo, $multiplicador)
  {
    $soma = 0;

    for ($i = 0; $i < strlen($cpfLimpo); $i++) {
      $soma += (int)$cpfLimpo[$i] * ($multiplicador--);
    }

    $divisaoResto = $soma % 11;

    if ($divisaoResto < 2) {
      $divisaoResto = 0;
    }

    $digito = 11 - $divisaoResto;

    if ($digito > 10) {
      $digito = 0;
    }

    return $digito;
  }

  private function limpaCpf()
  {
    $this->checarFormatoCpf();
    $cpfSemDigitos = strstr($this->cpf, '-', true);
    $cpfLimpo = preg_replace('/\W/', '', $cpfSemDigitos);

    return $cpfLimpo;
  }

  private function checarFormatoCpf(): bool
  {
    $cpfPadrao = preg_match('/\d{3}\.\d{3}\.\d{3}\-\d{2}/', $this->cpf);

    if (!$cpfPadrao) {
      throw new \Exception("CPF $cpfPadrao se encontra em formato inválido.");
    }

    return true;
  }
}
