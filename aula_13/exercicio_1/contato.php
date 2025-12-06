<?php 
    class Contato {
    private int $tipo;
    private string $nome;
    private string $valor;

    public function getTipo(): int { return $this->tipo; }
    public function setTipo(int $tipo): void { $this->tipo = $tipo; }

    public function getNome(): string { return $this->nome; }
    public function setNome(string $nome): void { $this->nome = $nome; }

    public function getValor(): string { return $this->valor; }
    public function setValor(string $valor): void { $this->valor = $valor; }

    public function toJson() {
        return json_encode(get_object_vars($this));
    }  
}
?>