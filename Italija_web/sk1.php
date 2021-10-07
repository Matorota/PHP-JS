<?php 
if(!isset($_SESSION['sk'])) {
	$f = fopen('sk1.txt', 'r');
	$sk = fread($f, filesize('sk1.txt'));
	$sk++;
	
	$_SESSION['sk'] = $sk;
	fclose($f);

	$f = fopen('sk1.txt', 'w');
	fwrite($f, $sk);
	fclose($f);
}

echo "    Jus esate ".$_SESSION['sk']." lankytojas musu web";
?>