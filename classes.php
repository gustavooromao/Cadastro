<?php


abstract class Pessoa {
    public $nome;
    public $cpf;

    public function __construct($nome, $cpf) {
        $this->nome = htmlspecialchars($nome);
        $this->cpf = htmlspecialchars($cpf);
    }

    abstract public function exibirDados();
}


class Estudante extends Pessoa {
    public $curso;

    public function __construct($nome, $cpf, $curso) {
        parent::__construct($nome, $cpf);
        $this->curso = htmlspecialchars($curso);
    }

    public function exibirDados() {
        return "<strong>Tipo:</strong> Estudante | <strong>Nome:</strong> {$this->nome} | <strong>CPF:</strong> {$this->cpf} | <strong>Curso:</strong> {$this->curso}";
    }
}

abstract class Funcionario extends Pessoa {
    public $funcao;
    public $salario;

    public function __construct($nome, $cpf, $funcao, $salario) {
        parent::__construct($nome, $cpf);
        $this->funcao = htmlspecialchars($funcao);
        $this->salario = (float)$salario;
    }
}

class Professor extends Funcionario {
    public function exibirDados() {
        return "<strong>Tipo:</strong> Professor | <strong>Nome:</strong> {$this->nome} | <strong>Função:</strong> {$this->funcao} | <strong>Salário:</strong> R$ " . number_format($this->salario, 2, ',', '.');
    }
}


class Servidor extends Funcionario {
    public function exibirDados() {
        return "<strong>Tipo:</strong> Servidor | <strong>Nome:</strong> {$this->nome} | <strong>Setor/Função:</strong> {$this->funcao} | <strong>Salário:</strong> R$ " . number_format($this->salario, 2, ',', '.');
    }
}


class Visitante extends Pessoa {
    public function exibirDados() {
        return "<strong>Tipo:</strong> Visitante | <strong>Nome:</strong> {$this->nome} | <strong>CPF:</strong> {$this->cpf} (Acesso para controle de visitas)";
    }
}
?>