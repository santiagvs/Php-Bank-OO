<?php

namespace Alura\Banco\Modelo;

class Cpf
{
  private string $cpf;

  // Inicializando a classe

  public function __construct(string $cpf)
  {
    $this->cpf = $cpf;
    $this->validaCpf();
  }

  // Convertendo o CPF para string depois da execução

  public function getNumeroCpf()
  {
    return $this->cpf;
  }

  // A mágica acontece aqui:

  private function validaCpf()
  {
    $cpfLimpo = $this->limpaCpf();
    $primeiroDigito = $this->validaPrimeiroDigito();
    $segundoDigito = $this->validaSegundoDigito($primeiroDigito);

    $cpfOriginal = preg_replace('/\W/', '', $this->cpf);
    $cpfCompleto = $cpfLimpo . $primeiroDigito . $segundoDigito; // Concatenando o CPF incompleto com os dígitos.

    if ($cpfOriginal != $cpfCompleto) { // Verificando se o CPF validado é idêntico ao do input
      throw new \Exception('CPF inválido'); // Exceção e erro em caso de CPF inválido
    } else {
      echo 'O CPF é válido!' . PHP_EOL;
    }
  }

  // Separando responsabilidades: um método para cada um dos dois dígitos

  private function validaPrimeiroDigito()
  {
    $cpfLimpo = $this->limpaCpf();
    $multiplicador = 10;
    return $this->calcularDigito($cpfLimpo, $multiplicador);
  }

  private function validaSegundoDigito($primeiroDigito)
  {
    $cpfLimpo = $this->limpaCpf() . $primeiroDigito; // Concatena o primeiro dígito calculado para realizar o segundo cálculo
    $multiplicador = 11;
    return $this->calcularDigito($cpfLimpo, $multiplicador);
  }

  // Calcula o dígito verificador do CPF.

  private function calcularDigito($cpfLimpo, $multiplicador)
  {
    $soma = 0;

    for ($i = 0; $i < strlen($cpfLimpo); $i++) {
      $soma += (int)$cpfLimpo[$i] * ($multiplicador--);
    }

    $digito = 11 - ($soma % 11);

    if ($digito > 10) {
      $digito = 0;                          // Caso o resto da divisão seja maior que 10, é atribuído o valor 0
    }

    return $digito;
  }

  private function limpaCpf()
  {
    $cpfSemDigitos = strstr($this->cpf, '-', true); // Retirando os dígitos verificadores
    $cpfLimpo = preg_replace('/\W/', '', $cpfSemDigitos); // Retirando pontos e qualquer outro caractere especial do input

    return $cpfLimpo;
  }
}

// ^\d{3}\.\d{3}\.\d{3}\-\d{2}$ matches Cpf
