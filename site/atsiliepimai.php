<!DOCTYPE html>
<html><head>
<meta charset="utf-8">
<title>Atsiliepimai</title>
</head>

<body>
<header>Atsiliepimai</header>
<a href="index.php?link=atsiliepimai&atsiliepti">Palikti atsiliepimą</a>
<?php
if(isset($_GET['atsiliepti'])) {
	atsiliepimu_forma();
}

//gauname duomenys is formos
if(isset($_POST['nick'])) {
$nick = $_POST['nick'];
$email = $_POST['email'];
$message = $_POST['atsiliepimas'];
$kodas_iv = $_POST['kodas_iv'];
$kodas = $_POST['kodas'];
// kodas_iv ir kodas

	if(empty($nick) or empty($email) or empty($message)) {
			echo "<p class='klaida'>Prašome užpildyti būtinus laukus.</p>";
			atsiliepimu_forma();
	}
	// ar sutampa kodai
	elseif($kodas_iv != $kodas) {
		echo "<p class='klaida'>Nesutampa kodai.</p>";
			atsiliepimu_forma();
	}
	else {
//irasysime duomenys i txt faila (arba DB)
	$date = date("Y-m-d H:i:s");
		irasyti($nick, $email, $message, $date);
	}
}
	
//rodysime paliktus atsiliepimus
	rodyti();
?>

</body>
</html>
