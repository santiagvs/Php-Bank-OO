<?php

namespace Alura\Banco\Modelo\Conta;

abstract class Conta
{
  private Titular $titular;
  protected float $saldo;
  private static $numeroDeContas = 0;

  public function __construct(Titular $titular)
  {
    $this->titular = $titular;
    $this->saldo = 0;

    self::$numeroDeContas++;
  }

  public function __destruct()
  {
    self::$numeroDeContas--;
  }

  public function sacar(float $valorASacar)
  {
    $tarifaSaque = $valorASacar * 0.05;
    $valorSaque = $valorASacar + $tarifaSaque;

    if ($valorSaque > $this->saldo) {
      echo 'Saldo indisponível';
      return;
    }

    $this->saldo -= $valorSaque;
  }

  public function depositar(float $valorADepositar)
  {
    $this->saldo += abs($valorADepositar);
  }

  public function extrato(): float
  {
    return $this->saldo;
  }

  public static function getNumeroDeContas()
  {
    return self::$numeroDeContas;
  }

  public function getNomeTitular(): string
  {
    return $this->titular->getNome();
  }

  public function getCpfTitular()
  {
    return $this->titular->getCpf();
  }

  abstract protected function percentualTarifa(): float;
}
