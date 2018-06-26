
<?php 


$as = 'a=1&b=2';

$cv = explode('&', $as);
print_r($cv);
foreach($cv as $v){
	// print_r($v);
	$cccc = explode('=',$v);
	echo "<br/>";
	print_r($cccc);
}

 ?>