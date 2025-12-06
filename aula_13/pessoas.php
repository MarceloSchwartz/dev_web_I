<?php 

    class Pessoa{
        private $nome;
        private $sobrenome;
        private $dataNascimento;
        private $cpfcnpj;
        private $tipo;
        private $telefone;
        private $endereco;
        private $dataInstancia;

        public function __construct(){
            $this->tipo = 1;
            $this->dataInstancia = new DateTime();
        }

        public function getDataInstancia(){
            return $this->dataInstancia->format('d/m/Y/ H:i:s');
        }

        public function getNomeCompleto(){
            return $this->nome . " " . $this->sobrenome;
        }

        public function getNome(){
            return $this->nome;
        }

        public function getSobreNome(){
            return $this->sobrenome;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }

        public function setSobreNome($sobrenome){
            $this->sobrenome = $sobrenome;
        }

        public function getIdade(){
            $dataAtual = new DateTime();
        }

        private function inicializaClasse(){

        }
    }



?>