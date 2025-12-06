<?php 
    class Calculadora{
        private $operador_1;
        private $operador_2;
        
        public function somar(){
            $resultado = $this->operador_1 + $this->operador_2;
            return $resultado;
        }

        public function subtrair(){
            $resultado = $this->operador_1 - $this->operador_2;
            return $resultado;
        }

        public function dividir(){
            if($this->operador_2 <=0){
                echo "Não é possível realozar a divisão por um número menor que zero!";
            }else{
                $resultado = $this->operador_1 / $this->operador_2;
                return $resultado;
            }
        }

        public function multiplicar(){
            $resultado = $this->operador_1 * $this->operador_2;
            return $resultado;
        }

        public function getOperador1(){
            return $this->operador_1;
        }

        public function setOperador1($operador_1){
            $this->operador_1 = $operador_1;
        }

        public function getOperador2(){
            return $this->operador_2;
        }

        public function setOperador2($operador_2){
            $this->operador_2 = $operador_2;
        }
    }

    $calculo = new Calculadora();
    $calculo->setOperador1(2);
    $calculo->setOperador2(10);
    echo $calculo->multiplicar();
?>