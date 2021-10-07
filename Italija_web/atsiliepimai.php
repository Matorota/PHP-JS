<!DOCTYPE html>
<html><head>
<meta charset="utf-8">
<title>Atsiliepimai</title>
</head>

<body>
<header>Atsiliepimai</header>
<button type="submit" name="Palikti" value "PaliktiS"><a href="index.php?link=atsiliepimai&atsiliepti">Palikti</a></button>

<?php
include "functionss.php";
?>

<?php
if(isset($_GET['atsiliepti'])) {
	atsiliepimu_forma();
}


if(isset($_POST['nick'])) {
$nick = $_POST['nick'];
$email = $_POST['email'];
$message = $_POST['atsiliepimas'];
$kodas_iv = $_POST['kodas_iv'];
$kodas = $_POST['kodas'];
?><div class = "submenu"><?php
	if(empty($nick) or empty($email) or empty($message)) {
			echo "<p class='klaida'>Prašome užpildyti būtinus laukus.</p>";
			atsiliepimu_forma();
	}

	elseif($kodas_iv != $kodas) {
		echo "<p class='klaida'>Nesutampa kodai.</p>";
			atsiliepimu_forma();
	}
	else {

	$date = date("Y-m-d H:i:s");
		 irasytiMsg($nick, $email, $message, $date); 
	}
}

	 rodytiMsg(); 
	echo "Vietos iškuriu žmonės atvyko ir todėl giriasi arba piktinasi";
echo "<a href='http://localhost/Mano%20darbai/Italija/index.php?link=Uzsakymai'>Spauskite paziureti vietas</a>";?><div class = "straipsnis"><?php
?>

</body>
</html>