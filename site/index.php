<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>PHP BLOG</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php
	include "functions.php";
?>

<header>
<div class="top">
		<div class="logo"><p class="transform"> MY<span>&copy;<span></p>
		</div>
		<div class="date"><?php // include "date.php"; ?></div>
	<div class="prisijunk">
	
<!-- prisijungimui 
	<?php include "login.php"; ?>
-->
	</div>  
</div>  
	<h2>PHP BLOG</h2> 
	
	<div class="menu shadow">
	<nav>
	<ul>
		<li><a href="index.php?link=naujienos">Naujienos</a></li>
		<li><a href="index.php?link=straipsniai">Straipsniai</a></li>
		<li><a href="index.php?link=fotoalbumas">Fotoalbumas</a></li>
		<li><a href="index.php?link=atsiliepimai">Atsiliepimai</a></li>
		</ul>
	</nav>
	</div>
	
</header>
<div id="container">

	<aside class="col_25 right box shadow center">
	
	
	<?php

	//reklama
	include "reklama.php";    
   
	?>


	</aside>
	
	<article  class="col_70 left box shadow">
	<section>
<?php
//gauname $_GET kintamaji ir tikriname, kas perduodama
		if(isset($_GET['link'])) {
		  $link = $_GET['link'];
			//echo $link;
			
			if($link == 'naujienos') { include 'naujienos.php';}
			elseif($link == 'straipsniai') {include 'straipsniai.php';}
			elseif($link == 'fotoalbumas') {include 'fotoalbumas.php';}
			elseif($link == 'atsiliepimai') {include 'atsiliepimai.php';}
		}
		else { include 'naujienos.php'; }
	
?>	
	</section>

	</article>
	
</div>
	<div class="clear"></div>
<footer><p>REKVIZITAI</p>
<p> <?php include "sk.php" ; ?> </p>

</footer>

</body>
</html>
