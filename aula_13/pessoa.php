<?php 

    class Pessoa{
        private $nome;
        private $sobrenome;

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
    }

    

?>