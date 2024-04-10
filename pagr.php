<?php
require_once 'klase.php';
require_once 'htmlas.html';

$suma = 0; 
$kartai = 0;
$it = 1; 
$max = []; 
$n = 0; 
$itermasyvas = [];  
$kiekis; 

$tempobj = new Skaicius();
$sumobj = new Skaicius();
$maxobj = new Skaicius();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	if (!empty($_POST['pirmasis']) && !empty($_POST['paskutinysis']) && !empty($_POST['narys'])){
		$sk1 = $_POST['pirmasis'];
		$sk2 = $_POST['paskutinysis'];
		$pasirink = $_POST['narys']; 
		
		echo "Intervalas yra: ", "nuo ", $sk1, " iki ", $sk2, "<br>";

		for ($i = $sk1; $i <= $sk2; $i++){ 
			$temp = $i; 
			$max[$n] = $temp; 
			
			if ($pasirink > $kartai){ 
				$sumobj->progres_gauti($suma, $temp);
				$suma = $sumobj->arit_gavimas();
				$kartai += 1;
			}
	
			while ($temp > 1){
				$tempobj->vieno_skaiciavimas($temp); 
				$temp = $tempobj->skaiciaus_gavimas(); 
				
				$it += 1;
				
				$maxobj->dydis($max[$n], $temp);
				$max[$n] = $maxobj->didziausio_gavimas();
			}
			
			$itarr[$n] = $it;
			$it = 1;
			$n += 1;
}

$kiekis = $sk2 - $sk1 + 1; 
$histograma = []; 
$histogramos_daznis[0] = 1;
$histograma[0] = $itarr[0];
$histos_daznis[0] = 1;
$hisobj = new Papildyti();
$skirt = 0; 

for ($i = 1; $i < $kiekis; $i++){ 
	$ar_buvo = 0; 
	for ($j = 0; $j < $skirt + 1; $j++){
		$hisobj->histograma($itarr[$i], $histograma[$j]);
		$laik = $hisobj->histogramai_gauti();
		
		
		if ($laik == 1){
			$histogramos_daznis[$j] += 1;
			$ar_buvo = 1;
		}
	}
	if ($ar_buvo == 0){
		$histograma[$skirt+1] = $itarr[$i];
		$histogramos_daznis[$skirt+1] = 1;
		$skirt += 1;
	}
}


$MAX = $max[0]; 
$MAXi = $itarr[0]; 
$MINi = $itarr[0]; 

$MAXobj = new skaicius(); // laikinas
$MAXiOBJ = new skaicius(); // laikinas
$MINiOBJ = new skaicius(); // laikinas

for ($i = 0; $i < $n; $i++){ 
	$MAXobj->dydis($MAX, $max[$i]); 
	$MAX = $MAXobj->didziausio_gavimas(); 
	
	$MAXiOBJ->dydis($MAXi, $itarr[$i]); 
	$MAXi = $MAXiOBJ->didziausio_gavimas(); 
	
	$MINiOBJ->maziausias($MINi, $itarr[$i]); 
	$MINi = $MINiOBJ->maziausio_gavimas(); 
}

echo "Rezultatai yra tokie: <br>";

for ($i = 0; $i < $n; $i++){
	if ($MAX == $max[$i]){
		echo "Didziausia reiksme pasiekta ", $sk1 + $i, ", kuri yra ", $max[$i], "<br>";
	}
	if ($MAXi == $itarr[$i]){
		echo "Didziausia iteraciju kieki pasieke skaicius ", $sk1 + $i, ", kuris yra ", $itarr[$i], "<br>";
	}
	if ($MINi == $itarr[$i]){
		echo "Maziausia iter. kieki pasiekie skaicius ", $sk1 + $i, ", kuris yra ", $MINi, "<br>";
	}
}
echo "Progresijos ", $pasirink, " nario dydis yra: ", $suma, "<br>";

for ($i = 0; $i < $skirt + 1; $i++){
	$hisobj->histos_spausdinimas($histograma[$i], $histogramos_daznis[$i]);
}
}
}
?>