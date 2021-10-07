<?php
/* modulis mysqli
1. prisijungti prie DB, 
2. suformuoti ir atlikti uzklausa i DB
3. apdoroti gauta uzklausos rezultata
4. atlikti veiksmus su DB duomenimis (atvaizduoti, modifikuoti ir pan.)
5. atsijungti nuo DB
*/

// 1.
require "function_DB.php";


$conn = @mysqli_connect("localhost", "root", "", "mano") or die("Negaliu prisijungti prie DB");
/*
$sql = "select * from vartotojai";	// 2
$rez = mysqli_query($conn, $sql);	// 2 gauname iraso pavydalu

// 3. 
echo "DB yra ".mysqli_num_rows($rez)." irasu";
$kiek = mysqli_num_rows($rez);		// kiek irasu gavome pagal uzklausa

// 4.
for($i = 0; $i < $kiek; $i++) {
	$eil = mysqli_fetch_assoc($rez); 	// gauname associative masyva
	echo "<br>".$eil['vardas']." ".$eil['pavarde']." ".$eil['amzius'];
}	
*/	
// 	pateikti DB miestu sarasa
$sql = "select * from miestai";
$rez = mysqli_query($conn, $sql) or die("Negaliu rasti irasu");
$kiek = mysqli_num_rows($rez);		// kiek irasu gavome
?>
<h2>Ieškoti pagal miestą</h2>
<form method="post">
<p><select name="miestai">
<?php 
	if($kiek != 0) {		// jei gavome irasus pagal uzklausa
		for($i = 0; $i < $kiek; $i++) {
		$eil = mysqli_fetch_assoc($rez); 
			echo "<option>".$eil['Miestas']."</option>";
		}
	}
?>
</select>
<input type="submit" name="ieskoti" value="Ieškoti">
</p>
</form>
<?php

// ----- patikrinti, ar buvo patvirtinta forma
	if(isset($_POST["ieskoti"])) {
		$Miestas = $_POST["miestai"];
		// echo "Jus pasirinkote: $Miestas";
		$sql2 = "select * from vartotojai, miestai where vartotojai.miesto_id=miestai.Kodas and miestai.Miestas='".$Miestas."'";
		$rez2 = mysqli_query($conn, $sql2);
		$kiek2 = mysqli_num_rows($rez2);
		echo "Jus pasirinkote: $Miestas";
		for($i = 0; $i < $kiek; $i++) {
			$eil = mysqli_fetch_assoc($rez2);
			echo "<p>".$eil['vardas']." ".$eil['pavarde']."</p>";
		}
	}



?>
<a href = "?new_city">Naujas miestas</a>
<a href = "?new_person">Naujas zmogus</a>
<?php

// Duomenu irasymas



if(isset($_GET['new_city'])){	
add_city_form();
}
if(isset($_GET['new_person']))
{
add_people_form();
}

if(isset($_POST['new_person']))
{
	$vardas = $_POST['vardas'];
	$pavarde = $_POST['pavarde'];
	$slaptazodis = $_POST['slapt'];
	$slaptazodis2 = $_POST['slapt2'];
	$email = $_POST['email'];
	$amzius = $_POST['amzius'];
	$miesto_id = $_POST['miestai'];
	echo  $vardas.$pavarde.$slaptazodis.$slaptazodis2.$email.$amzius.$miesto_id ;

	if(empty($vardas)|| empty($pavarde)|| empty($slaptazodis) || empty ($slaptazodis2) || empty($miesto_id)  || empty($email)|| empty($amzius))
	{
		echo "neuzpildyta";
	}
	elseif($slaptazodis !=  $slaptazodis2)
	{
		echo "nesutampa slaptazodziai";
	}
	else // geri formos duomenys
	{
		//ar nera tokio vartotojo
		//$conn = mysqli_connect("localhost", "root", "", "mano") or die ("Negaliu vugd");
		$sql = "select * from vartotojai where vardas='".$vardas."' and pavarde='".$pavarde."' and email='".$email."'";
		mysqli_query($conn, $sql) or die ("negali indentifikuoti");
		if(mysqli_num_rows($rez1) != 0) 
		{
		echo "toks vartotojas jau yra";	
		}
		else//jei nera irasome
		{
			$sql = "insert into vartotojai values(null, '".$vardas."', '".$pavarde."', '".$slaptazodis."', '".$email."', $amzius , 	$miesto_id, null)";
			mysqli_query($conn, $sql) or die ("negaliu irasyti");
			header("Refresh:0;url=sql.php");
		}
}
}
/*
if(isset($_GET['new_person']))
{

	$vardas = $_POST['vardas'];
	$pavarde = $_POST['pavarde'];
	$slaptazodis = $_POST['slaptazodis'];
	$email = $_POST['email'];
	$amzius = $_POST['amzius'];
	if(empty($vardas)or empty($pavarde)or empty($slaptazodis)or empty($email)or empty($amzius)) {
		echo "iveskite pavadinimas";
		echo "iveskite pavarde";
		echo "iveskite slaptazodis";
		echo "iveskite email";
		echo "iveskite amzius";
		}
	else{		
		echo $vardas;
		$conn = mysqli_connect("localhost", "root", "", "mano") or die ("Negaliu vugd");
	$sq5 = "select * from vartotojai where vardas = '".$vardas."'";
	$sq5 = "select * from vartotojai where pavarde = '".$pavarde."'";
	$sq5 = "select * from vartotojai where email = '".$email."'";
	$rez1 = mysqli_query($conn, $sq5) or die ("Negaliu vugd");
	if(mysqli_num_rows($rez1) == 0) 
	{
	$sq5 = "insert into vartotojai values(null, '".$vardas."".$pavarde."".$email."')";
	mysqli_query($conn, $sq5) or die ("Negaliu vugd");
	header("Refresh:0;url=sql.php");
	}
	else 
{
	echo "<p>toks VARTOTOJAS JAU YRA</p>";
	
}
	}
}*/



if(isset($_POST['add_city']))
{
	$miestas = $_POST['Miestas'];
	if(empty($miestas)) {echo "iveskite pavadinimas";}
	else{		// jeigu miestas uzpildytas
		echo $miestas;
		$conn = mysqli_connect("localhost", "root", "", "mano") or die ("Negaliu vugd");
	$sql3 = "select * from miestai where Miestas = '".$miestas."'";
	$rez = mysqli_query($conn, $sql3) or die ("Negaliu vugd");
	if(mysqli_num_rows($rez) == 0) 
	{
	$sql3 = "insert into miestai values(null, '".$miestas."')";
	mysqli_query($conn, $sql3) or die ("Negaliu vugd");
	header("Refresh:0;url=sql.php");
	}
	else 
{
	echo "<p>toks miestas jau yra</p>";
	
}
	}
}


// jei patvirtinta forma, gauname miesto pavadinima ir tikriname ar toks jau yra 
// i DB kreiptis su select * from miestai where ... kai pavadinimai sutampa, jei Miestas yra - kiekis nelygu 0 ir mes negalime rasyti, kitaip - galime irasyneti
// insert into...
	
	
// 5.
mysqli_close($conn);	

?>
