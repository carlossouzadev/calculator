<?php

class Calculator {

    public $parameter = '';
    public $number1 = '';
    public $number2 = '';

    public function setParameter($parameter) {
        $this->parameter = $parameter;
    }

    public function setNumbers($number1, $number2) {
        $this->number1 = $number1;
        $this->number2 = $number2;
    }

    public function getResult() {
        return $this->result();
    }

    protected function result() {
        switch ($this->parameter) {
            case '+':
                return $this->number1 + $this->number2;

                break;
            case '-':
                return $this->number1 - $this->number2;

                break;

            case '*':
                return $this->number1 * $this->number2;

                break;

            case '/':
                return $this->number1 / $this->number2;

                break;
        }
    }

}
