<header>Fotoalbumas</header>
		<style>
		.imge{
			width:100%;
		}
				</style>
<?php

 ?>
 <div class="polaroid container">

	<div class="submenu">
	 <a  href='?link=fotoalbumas&alb=siaures'>Šiaures italija</a>
	 <a href='?link=fotoalbumas&alb=vidurine'>Vidurio italija</a>
	 <a href='?link=fotoalbumas&alb=pietus'>Pietine italija</a>
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
 ?>
 <div class= "img">
 <?php 
 $eil = explode("**",$nuotr[$foto]);
 echo "<div class='foto'><img src='".$albumas."/".$eil[0]."' alt='".$eil[1]."'><p>".$eil[1]."</p></div>";
 
?>
 </div>
 </div>