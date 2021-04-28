<?php


 function dinheiro($valor,$tipo,$precisao = 2) {
    	if($tipo == 'db'){
    		$valor = str_replace('.','',$valor);
    		$valor = str_replace(',','.',$valor);
    		$valor = str_replace("R$",'',$valor);
    		$valor = str_replace(" ",'',$valor);
    		return $valor;
    	}elseif($tipo == 'web'){

    		$valor = round($valor,$precisao);
    		if(strpos($valor,'.') === false){
    			$tamanho = 0;
    		}else{
    			$valor2 = explode('.',$valor);
                $tamanho = strlen($valor2[1]);
            }
                $zeros = '';
                for($x = 1; $x <= $precisao - $tamanho; $x++)
                    $zeros .= '0';
    			if($tamanho == 0)
    				return str_replace(".",',',$valor).",".$zeros;
    			else
    				return str_replace(".",',',$valor).$zeros;
    		
    	}
    }


$x = 8.30;
$z = 6 ;// Tamanho da barra lateral
$y = 4 ;// Tamanho do circulo
$j = 5 ;// Espaçamento minimo
$x = str_replace(",",".",$x);
$z = str_replace(",",".",$z);
$y = str_replace(",",".",$y);
$j = str_replace(",",".",$j);
$z = ($z*2)/100;
$y = $y/100;
$j = $j/100;

$m1 = $x - $z;
do{
	$m = $j;
	$m2 = $m1/($y+$m);
	$m2 = (int) $m2;
	$m3 = ($m2 * ($y+$m)) - $m;
	$m4 = $m1 - $m3;

	$j = $m + 0.01;
	$j2 = $m1/($y+$j);
	$j2 = (int) $j2;
	$j3 = ($j2 * ($y+$j)) - $j;
	$j4 = $m1 - $j3;

	
} while(($j4 < $m4 and $j4 > 0) or ($m2 % 2 > 0));

print 'Tamanho: '.dinheiro($x,'web')." - Quantidade: $m2";


$aumentar = 400;
$x2 = 1;
$arr = [];
$ultimo = ($m2 / 2);
while((($m + ($m4)) > ($m + 0.02)) or $x2 == 1){
	
	if($x2 == 1){
		for($x1 = 1; $x1 <= ($m2/2) ; $x1++){
			if($x1 == 1)
				$arr[$x1] = $z/2;
			else
				$arr[$x1] = $m;
		}
	}else{
		$m4 -= 0.02;
		$arr[$ultimo] += 0.01;
		if($ultimo == 2)
			$ultimo = $m2/2;
		else
			$ultimo--;
	}
	$x2++;
}
print "<div style='max-width:1000px; border: 1px solid #000'>";
foreach($arr as $valor){
	print $valor."<div style='width:".($y * $aumentar)."px; height:".($y * $aumentar)."px; border: 1px solid #000; border-radius:50%; display: -moz-inline-grid; display:-webkit-inline-box;;'></div>";
}
print "<b>".round(($m + ($m4)),2)."</b>";
for($x4 = count($arr); $x4 >= 1; $x4--){
		print "<div style='width:".($y * $aumentar)."px; height:".($y * $aumentar)."px; border: 1px solid #000; border-radius:50%; display: -moz-inline-grid; display: -webkit-inline-box;;'></div>".$arr[$x4];
	
}
print "</div><hr>";