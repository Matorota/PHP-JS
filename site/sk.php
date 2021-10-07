<?php 
if(!isset($_SESSION['sk'])) {
	$f = fopen('sk.txt', 'r');
	$sk = fread($f, filesize('sk.txt'));
	$sk++;
	
	$_SESSION['sk'] = $sk;
	fclose($f);

	$f = fopen('sk.txt', 'w');
	fwrite($f, $sk);
	fclose($f);
}

echo "Esate ".$_SESSION['sk']." lankytojas";
?>