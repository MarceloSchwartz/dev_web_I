<?php 
    class Jogador{
        private $nome_jogador;
        private $posicao;
        private $dataNascimento;

        public function getNomeJogador(){
            return $this->nome_jogador;
        }

        public function setNomeJogador($nome_jogador){
            $this->nome_jogador = $nome_jogador;
        }

        public function getPosicao(){
            return $this->posicao;
        }

        public function setPosicao($posicao){
            $this->posicao = $posicao;
        }

        public function getDataNasc(){
            return $this->dataNascimento;
        }

        public function setDataNasc($dataNascimento){
            $this->dataNascimento = $dataNascimento;
        }
    }

?>