<?php
/*
file_exists("a.jpg");	
is_writable("a.txt");
is_readable();
is_dir();			// ar tai directory
is_file();			// ar tai failas
is_executable(); 	// ar tai .exe

clearstatcache();	// isvalyti cache, nes visos sitos function kešuoja rezultata

print_r(getimagesize($failas));		// info !tik apie img faila

unlink("a.jpg");	// istrinti faila

// kai per forma siunciame faila, gauname $_FILES associative  masyva:
 
$_FILES['failas']

failo tipas (jpg, jpeg, gif, png), gali buti ir didziosiomis raidemis
pathinfo($failas, PATHINFO_EXTENSION);		// info apie faila (array)

PATHINFO_DIRNAME - tik folder
PATHINFO_BASENAME - pavadinimas.pletinis (test.txt)
PATHINFO_EXTENSION - pletinis (txt)
PATHINFO_FILENAME - tik pavadinimas (test)

getimagesize($_FILES['failas']['tmp_name']);

if ($_FILES["failas"]["size"] > 500000) {
  echo "Failas per didelis";
}

*/

if(isset($_POST["ikelti"])) {
	//print_r ($_FILES['failas']);
	$kelias = "img/";
	$failas = $kelias.basename($_FILES['failas']['name']);
	$failo_tipas = strtolower(pathinfo($failas, PATHINFO_EXTENSION));
	//echo $failo_tipas;
	$klaida = 0;
	
	// ar tikrai grafinis
	$ar_tikras = @getimagesize($_FILES['failas']['tmp_name']); 
	if($ar_tikras !== false) {	// geras failas
		$klaida = 0;
	}
	else {
		$klaida = 1; 	// netikras paveikslelis
	}
	// ar tinka formatas
	if($failo_tipas != "jpg" && $failo_tipas != "jpeg" && $failo_tipas != "png" && $failo_tipas != "gif") {
		$klaida = 2; 	// blogas failo formatas
	}
	
	if($klaida == 1){
		echo "Netinkamas failo tipas";
		die();
	}
	else if($klaida == 2) {
		echo "Netinkamas failo formatas";
		die();
	}
	else {
		if(file_exists($failas)) {
			echo "Toks failas yra";
		}
		else if(move_uploaded_file($_FILES['failas']['tmp_name'], $failas)) {
			echo "failas irasytas";
			// IRASOME I DB (! be kelio tik basename($_FILES['failas']['name']))
		}
		else {
			echo "Krovimo klaida";
		}
	}
}
?>
<form enctype="multipart/form-data" method="post" action="">
<input type="file" name="failas">
<input type="submit" name="ikelti">
</form>