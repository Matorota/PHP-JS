<?php
function atsiliepimu_forma() {
?>
<header>Atsiliepimai</header>
<form name="form1" method="post" action="">
    <label for="nick">Nick:* </label>
    <input name="nick" type="text" id="textfield" size="25">
    <label for="email">E-mail:* </label>
    <input name="email" type="email" id="textfield2" size="25">
    <label for="atsiliepimas">Atsiliepimas:* </label>
    <textarea name="atsiliepimas" id="textarea" cols="25" rows="3">
	</textarea>
    <label for="kodas_iv">Įveskite kodą:* <b><?php 
	$kodas = kodas();
	echo $kodas;
	?> </b></label> 
	<input name="kodas_iv" type="text" id="textfield3" size="25">
		<input name="kodas" type="hidden" value="<?php 
		echo $kodas;?>" size="25">
    <p><input type="submit" name="button" id="button" value="Įrašyti">
      <input type="reset" name="button2" id="button2" value="Išvalyti"><p>
</form>
</fieldset>
<?php
}
//------------ kodo generavimas
function kodas() {
$simb = array('A','B','C','D','E','F','G','H','I','Y','J','K','L','M','N','O','P','R','S','T','U','V','W','X','Y','Z', 0,1,2,3,4,5,6,7,8,9);
	$kodas_g = "";
	for($i = 0; $i < 4; $i++) {
		$sk = rand(0, count($simb)-1);
		$kodas_g .= $simb[$sk];
		}
		return $kodas_g;
}
//

function irasyti($nick, $email, $message, $date) {
    $f = fopen("komentarai.txt", "a+");
    $info =  $nick."**".$email."**".$message."**".$date."\n";
	fwrite($f, $info);
	fclose($f);
}

//


function rodyti()
{
	$eil = file("komentarai.txt");
	
	
	for($i = count($eil)-1; $i >= 0; $i--)
	{
		$e = explode("**", $eil[$i]);
	echo"<div class = 'atsiliepimas'><a href='mailto:".$e[1]."'>".$e[0]."</a> [".$e[3]."]<p>".$e[2]."</p></div>";
	}
	
}
?>
