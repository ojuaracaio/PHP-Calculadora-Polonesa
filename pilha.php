<?php
class Pilha {
    private $pilha;

    public function __construct() {
        $this->pilha = array();
    }

    public function empilhar($item) {
        array_unshift($this->pilha, $item);
    }

    public function desempilhar() {
        if (count($this->pilha) == 0) {
          throw new Exception('A pilha está vazia!');
      } else {
            return array_shift($this->pilha);
        }
    }
    public function tamanho() {
        return count($this->pilha);
    }
};


?>