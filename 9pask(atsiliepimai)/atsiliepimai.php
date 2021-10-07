<!DOCTYPE html>
<html><head>
<meta charset="utf-8">
<title>Atsiliepimai</title>
<style type="text/css">
body {
	font-family:Georgia, "Times New Roman", Times, serif;
}
.atsiliepimu {
	width:40%;
	margin:auto;
}
.atsiliepimu > label, .atsiliepimu > input {
	display: block;
}
input[type="submit"], input[type="reset"] {
	display: inline-block;
}
.nick {
	background-color:#CCC;
}
.data {
	font-size:80%;
}
.atsiliepimas {
	font-style:italic;
}
.pranesimas {
	background:#eeeefe;
	width:600px;
	padding:10px;
	margin-bottom:8px;
}
.border {
	border-bottom:dotted 2px #003399;
	width:12em;
}
</style>
</head>

<body>
<?php
require "functions.php";
//gauname duomenys is formos
if(isset($_POST['nick'])) {
	$nick = $_POST['nick'];
    $email = $_POST['email'];
    $message = $_POST['atsiliepimas'];
	// kodas iv ir kodas 
 //   $code = $_POST['kodas_iv'];
 
    if(empty($nick) or empty($email) or empty($message))
		{
			echo "<p class='klaida'>Prasome uzpildyti butinus laukus. </p>";
			atsiliepimu_forma();
			
		}	
		//else if sutampa kodai
//irasysime duomenys i txt faila (arba DB)	
else{
	$date = date("Y-m-d H:i:s");
	irasyti($nick, $email, $message, $date);
	
	
}
	}
else {
	atsiliepimu_forma();
}

//rodysime paliktus atsiliepimus

rodyti();

?>

</body>
</html>
