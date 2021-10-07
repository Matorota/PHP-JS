<header>Uzsakymai</header>

<?php

$conn = @mysqli_connect("localhost", "root", "", "italija") or die("Negaliu prisijungti prie DB");
mysqli_set_charset($conn, "utf8");
$sql = "select * from uzsakymas";
$albumas = 'Images';
$rez = mysqli_query($conn, $sql) or die("Negaliu rasti irasu");
	if(mysqli_num_rows($rez) != 0) {
		
		for ($i = 0; $i < mysqli_num_rows($rez); $i++) {
		$eil = mysqli_fetch_assoc($rez);
		    echo "<div class='straipsnis container'> <a href='?link=uzsakymas&Uzs=".$eil['Id']."'><p><img src='Images/".$eil['Nuotrauka']."' style='width:200px"."'></p><h3>".$eil['Pavadinimas']."</h3></a><br>".$eil['Tekstas']."<br>Kaina eurais:".$eil['Kaina']."<br> Uzsakyta: ".$eil['Uzsakyta'];
			echo "<br>Šeimos pakas yra visada 3 asmenimis <br>";			
			echo "Jei norite daugiau ar mažiau kreipkitės pas mus:";
		
			
			?>
			<form method="POST" >
			<input type="hidden" name="Id" value="<?php echo $eil['Id']; ?>">
			<input type="submit" class="buttonclass" name="Uzsakyta" id="Uzsakyta" value="Order">		 
			</form>
				</div>
			<?php
		}	
	}
	?>

	<?php
	//jeigu buvo uzsakyta
			if(isset($_POST['Uzsakyta']))
		{
			$ID = $_POST['Id'];
			$query1 = "select Uzsakyta from uzsakymas where Id=".$ID."";  
			$rez1 = mysqli_query($conn, $query1) or die("<p>klIDOS.1<br>Pamėginkite vėliau</p>");
			if(mysqli_num_rows($rez1) != 0)
			{
				
			$e = mysqli_fetch_assoc($rez1);
				if($e['Uzsakyta'] < 35)
				{
				 $query = "update uzsakymas set Uzsakyta= Uzsakyta + 1 where Id=".$ID."";
				 mysqli_query($conn, $query) or die("<p>klIDOS.2<br>Pamėginkite vėliau</p>");
				 echo "<meta http-equiv='refresh' content='0'>";
				}
				else {
					//jei virsija 35
					echo"Jūs viršijat užsakymo kiekį";
				}
			}
			
		}
		
		
?>
