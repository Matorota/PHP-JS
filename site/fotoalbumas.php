<header>Fotoalbumas</header>
<?php
/*  nuskaityti .txt
	kiek nuotrauku, tiek turi buti numeriuku
	atvaizduoti 1-ma nuotrauka ir jos aprasyma
	suformuoti nuorodas i atitinkama nuotrauka
	priklausant nuo nuorodos pakrauti tinkama nuotrauka
 */
 /*   pasirinkti fotoalbuma  */
 ?>
 <div class="center">
	<div class="submenu">
	 <a href='?link=fotoalbumas&alb=lietuva'>Lietuva</a>
	 <a href='?link=fotoalbumas&alb=gamta'>Gamta</a>
	 <a href='?link=fotoalbumas&alb=geles'>Gėlės</a>
	</div>
 <?php
 //kuris albumas
 if(isset($_GET['alb'])) {
	$albumas = $_GET['alb']; 
 }
 else { $albumas = 'lietuva';}
 
 $nuotr = file($albumas.".txt");
 //echo count($nuotr);
 for($i = 0; $i < count($nuotr); $i++) {
	 echo "<a href='?link=fotoalbumas&alb=".$albumas."&foto=".$i."'>".($i+1)."</a> | ";
 }
 if(isset($_GET['foto']) && $_GET['foto'] > 0 && $_GET['foto'] < count($nuotr) && is_numeric($_GET['foto'])) {
	  $foto = $_GET['foto'];
 }
 else {
	 $foto = 0;	
 }
 $eil = explode("**",$nuotr[$foto]);
 echo "<div class='foto'><img src='".$albumas."/".$eil[0]."' alt='".$eil[1]."'><p>".$eil[1]."</p></div>";
 
?>

 </div>