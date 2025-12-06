<?php 
    require_once('jogadores.php');
    class Time{
        private $nome;
        private $anoFundacao;
        private $jogadores;

        public function __construct()
        {
            $this->jogadores = array();
        }

        public function escrever(){
            echo $this->nome . "<br>";
            echo $this->anoFundacao;
            echo "<br>";
            foreach ($this->jogadores as $jogador) {
                echo " - " . $jogador->getNomeJogador();
                echo " (" . $jogador->getPosicao() . ")<br>";
            }
        }

        public function addJogador(Jogador $jogador){
            $this->jogadores[]=$jogador;
        }

        public function  getAnoFundacao(){
            return $this->anoFundacao;
        }

        public function setAnoFundacao($anoFundacao){
            $this->anoFundacao = $anoFundacao;
        }

        public function getNome(){
            return $this->nome;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }
    }

?>