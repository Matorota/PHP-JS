<?php
function atsiliepimu_forma() {
?>
<form name="form1" method="post" action=""  class = "straipsnis " >
    <p><input name="nick" type="text" id="textfield" size="25" placeholder="Nickname">*</p>
    <p><input name="email" type="email" id="textfield2" size="25" placeholder="E-mail">*</p>
    <p><textarea name="atsiliepimas" id="textarea" cols="25" rows="3" placeholder="Atsiliepimas"></textarea>*</p>
    <p><label for="kodas_iv">Įveskite kodą:* <b><?php $kodas = kodas(); echo $kodas;?></b></label> 
	<p><input name="kodas_iv" type="text" id="textfield3" size="25"></p>
	<input name="kodas" type="hidden" value="<?php echo $kodas; ?>">
    <p><input type="submit" name="button" id="button" value="Įrašyti">
      <input type="reset" name="button2" id="button2" value="Išvalyti"></p>
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
//------------- atsiliepimu irasymas
function irasytiMsg($nick, $email, $message, $date) {
	$f = fopen("atsiliepimai.txt","a");
	$info = $nick."**".$email."**".$message."**".$date."\n";
	fwrite($f, $info);
	fclose($f);
}

//-------- atsiliepimu atvaizdavimas

function rodytiMsg(){
	$eil = file("atsiliepimai.txt");
	// nuskaityti eil ir visas pateikti
	// nick, nuoroda i email; date; <p>message</p>
	for($i = count($eil)-1; $i >= 0; $i--) {
		$e = explode("**", $eil[$i]);
		echo "<div class='atsiliepimas'><a href='mailto:".$e[1]."'>".$e[0]."</a> <span class='data'>[".$e[2]."]</span><p class='pranesimas'>".$e[3]."</p></div>";
	}
}


?>
