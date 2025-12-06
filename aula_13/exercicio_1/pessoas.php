<?php 
    class Pessoa {
    private string $nome;
    private string $sobrenome;
    private string $dataNascimento; 
    private string $cpfcnpj;
    private int $tipo;
    
    private Contato $telefone;
    private Endereco $endereco;

    public function inicializaClasse(): void {
        echo "Classe Pessoa inicializada.<br>";
    }

    public function getNomeCompleto(): string {
        return $this->nome . " " . $this->sobrenome;
    }

    public function getIdade(): int {
        if (empty($this->dataNascimento)) return 0;
        
        $dataNasc = new DateTime($this->dataNascimento);
        $hoje = new DateTime();
        $diferenca = $hoje->diff($dataNasc);
        
        return $diferenca->y; 
    }

    public function getNome(): string { return $this->nome; }
    public function setNome(string $nome): void { $this->nome = $nome; }

    public function getSobrenome(): string { return $this->sobrenome; }
    public function setSobrenome(string $sobrenome): void { $this->sobrenome = $sobrenome; }

    public function getDataNascimento(): string { return $this->dataNascimento; }
    public function setDataNascimento(string $data): void { $this->dataNascimento = $data; }

    public function getCpfcnpj(): string { return $this->cpfcnpj; }
    public function setCpfcnpj(string $cpfcnpj): void { $this->cpfcnpj = $cpfcnpj; }

    public function getTipo(): int { return $this->tipo; }
    public function setTipo(int $tipo): void { $this->tipo = $tipo; }

    public function getTelefone(): Contato { return $this->telefone; }
    public function setTelefone(Contato $telefone): void { $this->telefone = $telefone; }

    public function getEndereco(): Endereco { return $this->endereco; }
    public function setEndereco(Endereco $endereco): void { $this->endereco = $endereco; }

    public function toJson() {
        $dados = get_object_vars($this);
        
        if(isset($this->endereco)) {
            $dados['endereco'] = json_decode($this->endereco->toJson());
        }
        if(isset($this->telefone)) {
            $dados['telefone'] = json_decode($this->telefone->toJson());
        }

        return json_encode($dados);
    }
}
?>