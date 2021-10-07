<?php


if (isset($_POST['ok']))
{
	$apr = $_POST['aprasymas'];
	$f = $_FILES["failas"];  // duomenu apie faila masyvas
	
	$path = "img/";
	
	//print_r($f);
	$failo_pav = $_FILES["failas"]["name"];
	$failas = $path.$failo_pav;

	$failo_tipas = strtolower(pathinfo($failas, PATHINFO_EXTENSION)); //AR tinka pleinys
	$klaida = 0;

	//echo $failo_tipas;
	//pilnas kelias iki failo
	
	// ar tikrai failas paveiks
	$ar_tikra = getimagesize($_FILES["failas"]["tmp_name"]);
	if($ar_tikra !== false)
	{
		$klaida = 0; // failas garas
	}
	else 
	{
		$klaida = 1; //netikras paveikslelis
	}
	
	// ar tinkamas formatas - jpg. gif. png. jpeg.
	if($failo_tipas != "gif" && $failo_tipas != "jpg"&& $failo_tipas != "jpeg" && $failo_tipas != "png")
	{
	$klaida = 2;  // netinkamas formatas	
	}
	if($klaida ==1)
	{
		echo ("Netinkamas failo tipas");
	}
	else if($klaida ==2)
	{
				echo ("Netinkamas failo formatas");
	}
		else
	{
	if(file_exists($failas)){
		echo ("toks failas jau yra");
	}
	elseif(move_uploaded_file($_FILES['failas']['tmp_name'], $failas))
	{
		echo "failas ikeltas";

		// galiu rasyti i DB 
	}
	else{// del kazkokiu priezasciu failas neisikelia itinkama vieta
		echo "yvyko klaida: Failas neikeltas";
		
	}
				
	}
	
	// ar nera tokio failo
	
	
}


?>


<form enctype="multipart/form-data" method = "post">
<p><input type ='text' name="aprasymas" placeholder = "Failo Aprasymas"></p>
<p><input type ='file' name="failas"></p>
<p><input type ='submit' name= "ok"value="ikelti faila"></p>
</form>

