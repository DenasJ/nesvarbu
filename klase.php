<?php
class Skaicius{
    public $sk;
    public $a;
    public $b1;
    public $b;
    public $a1; 
    public $suma;
    public $skaic;

    public function vieno_skaiciavimas($sk){
        $this->sk = $sk;
        if ($this->sk % 2 == 0){
            $this->sk = $this->sk / 2;
        }
        else {
            $this->sk = 3 * $this->sk + 1;
        }
    }
    
    public function skaiciaus_gavimas() {
        return $this->sk;
    }
    
    public function dydis($a, $b){
        $this->a = $a;
        $this->b = $b;
    
        if ($this->a < $this->b){
            $this->a = $this->b;
        }
    }
    
    public function didziausio_gavimas() {
        return $this->a;
    }
    
    public function maziausias($a1, $b1){
        $this->a1 = $a1;
        $this->b1 = $b1;
    
        if ($this->a1 > $this->b1){
            $this->a1 = $this->b1;
        }
    }
    
    public function maziausio_gavimas() {
        return $this->a1;
    }
    
    public function progres_gauti($suma, $skaic){
        $this->suma = $suma;
        $this->skaic = $skaic;
    
        $this->suma = $this->suma + $this->skaic;
    }
    
    public function arit_gavimas() {
        return $this->suma;
    }
}

class Papildyti extends Skaicius{
    public $kint;
    public $skaicius;
    
    public function histograma($a, $b){
        $this->a = $a;
        $this->b = $b;
        
        if ($a == $b){
            $this->a = 1;
        }
    }
    
    public function histogramai_gauti() {
        return $this->a;
    }
    
    public function histos_spausdinimas($kint, $skaicius){
        $this->kint = $kint;
        $this->skaicius = $skaicius;
        
        echo "Iteracijos dydis: ", $kint, ", ir jos daznis: ", $skaicius, "<br>";
    }
}
?>
