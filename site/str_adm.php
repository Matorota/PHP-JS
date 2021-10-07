<!DOCTYPE HTML>
<html> <head>
 <title>Straipsniu administravimas</title>
	<meta charset="utf-8">	
<link rel="stylesheet" href="style.css">
 </head>
 <body class="admin">
	    <h1>Administravimas</h1>
		<?php 
require "functions2.php";

//---- rodome viena is formu  REDAGAVIMA, arba TRINIMA arba PAPILDYMA, arba visa lentele, jeigu nebuvo pasirinkta valdymo funkcija 

		if(isset($_POST['Redag'])){
		 //echo $_POST['Redag'];
			taisyti($_POST['Redag']);
			//taisyti($Id);
		 }
		elseif(isset($_POST['Tr'])) {
                 // trinti irasa
            ar_trinti($_POST['Tr']);
        }
		elseif(isset($_POST['Papildyti'])) { 
			papildyti(); 
		}
		else { lentele(); }
		//==============================================
// tikriname, kokia administravimo funkcija buvo pasirinkta

			/* irasymas */
if(isset($_POST["Irasyti"]))
{	// surinkti duomenis is formos patikrinti ar netuscia
	//suformuoti dabartine data ir viska paduoti visus duomenis funkcijai irasyti
	$pav = $_POST["Pav"];
	$st = $_POST["ST"];
	$t = $_POST["T"];
	$f = $_FILES["failas"];  // nuotrauka turime patikrinti
	date_default_timezone_set('Europe/Vilnius');
	$data = date("Y-m-d H:i:s");
	if($pav =="" || $st == "" || $t=="")
	{		


	
		echo "Neuzpildytas";
		papildyti();
	}
	else 
	{
	//print_r ($_FILES['failas']);
	$kelias = "img/";
	$failas = $kelias.basename($_FILES['failas']['name']);
	$failo_tipas = strtolower(pathinfo($failas, PATHINFO_EXTENSION));
	//echo $failo_tipas;
	$klaida = 0;
	
	// ar tikrai grafinis
	echo $_FILES['failas']['tmp_name'];
	$ar_tikras = @getimagesize($_FILES['failas']['tmp_name']);
	if($ar_tikras === false) {	// geras failas
		$klaida = 1;
		echo "Netinkamas failo tipas";
	}
	// ar tinka formatas
	else if($failo_tipas != "jpg" && $failo_tipas != "jpeg" && $failo_tipas != "png" && $failo_tipas != "gif") {
		$klaida = 2; 	// blogas failo formatas
		echo "Netinkamas failo formatas";
		die();
	}
	else {
		if(file_exists($failas)) {
			echo "Toks failas yra";
		}
		else if(move_uploaded_file($_FILES['failas']['tmp_name'], $failas)) {
			echo "failas irasytas";
		irasyti($pav, $st, $t, $data, $f['name']);	// IRASOME I DB (! be kelio tik basename($_FILES['failas']['name']))
		echo "<meta http-equiv='refresh' content='0'>";
		}
		else {
			echo "Krovimo klaida";
		}
	}

	
	}
	
}

		  
  
		if(isset($_POST['ne'])) {
          echo "Nieko nebuvo istrinta!";
                    }
        if(isset($_POST['taip'])) {
		$ID = $_POST['taip'];
		trinti($ID);
        echo "<meta http-equiv='refresh' content='0'>";
                }
				
				
			if(isset($_POST['Keisti']))
			{
				$pav = $_POST['Pav'];
				$st = $_POST['ST'];
				$t = $_POST['T'];
				$B = $_POST['B'];
				$ID = $_POST['Id'];
				$data = $_POST['L'];
				
                redagavimas($ID, $pav, $B, $st, $t, $data);
                echo "<meta http-equiv='refresh' content='0'>";
			}
		  	  
		  //==============================================
		?>
 </body></html>