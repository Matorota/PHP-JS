<header>Straipsniai</header>
<?php

$conn = @mysqli_connect("localhost", "root", "", "italija") or die("Negaliu prisijungti prie DB");
mysqli_set_charset($conn, "utf8");
$sql = "select * from straipsniai";
$albumas = 'Images';
$rez = mysqli_query($conn, $sql) or die("Negaliu rasti irasu");
$kiek = mysqli_num_rows($rez);		
	if(mysqli_num_rows($rez) != 0) {
		?>
<?php
		
		if(isset($_GET['str'])) {
            $ID = $_GET['str'];
            $query2 = "select * from straipsniai where Id=".$ID;
            $rez2 = mysqli_query($conn, $query2);
            $eil2 = mysqli_fetch_assoc($rez2);
            ?><div class="straipsnis2"> 
			

			<?PHP
            echo "<p><img class='foto2' src='Images/".$eil2['nuotrauka']."' style='width:900px"."'></p><h1>".$eil2['Pavadinimas']."</h1><p>".$eil2['mini_tekstas']."</p><p>".$eil2['text']."</p><br>".$eil2['data']."<br> patiko: ".$eil2['patiko']."<br>nepatiko:" .$eil2['neptaiko'];
			 ?>
			 <form method="POST" >
			 <input type="hidden" name="Id" value="<?php echo $eil2['Id']; ?>">
			<input type = "submit" class="buttonclass" name ="patiko" id ="patiko" value="like">		 
			</form>
			
			
			<form  method="POST">
			<input type="hidden" name="Id" value="<?php echo $eil2['Id']; ?>">
			<input type = "submit" class="buttonclass" name ="neptaiko" id ="neptaiko" value="dislike">
			</form>
			
			<?PHP
			// patiko
		if(isset($_POST['patiko']))
		{
			$ID = $_POST['Id'];
			$conn = mysqli_connect('localhost','root','','italija') or die("KLAIDA");
			 $query = "update straipsniai set patiko= patiko + 1  where Id=".$ID."";
			mysqli_query($conn, $query) or die("<p>klIDOS.2<br>Pamėginkite vėliau</p>");
				echo "<meta http-equiv='refresh' content='0'>";
		}
		
		// nepatiko
		if(isset($_POST['neptaiko']))
		{
			$ID = $_POST['Id'];
			$conn = mysqli_connect('localhost','root','','italija') or die("KLAIDA");
			 $query = "update straipsniai set neptaiko= neptaiko + 1  where Id=".$ID."";
			mysqli_query($conn, $query) or die("<p>klIDOS.2<br>Pamėginkite vėliau</p>");
				echo "<meta http-equiv='refresh' content='0'>";
		}
			

            ?> </div> <?PHP

	$con = mysqli_connect('localhost','root','','italija');

	$posts = mysqli_query($con, "SELECT * FROM posts");
        }

	
	
	for($i = 0; $i < mysqli_num_rows($rez); $i++) {
            $eil = mysqli_fetch_assoc($rez);
            ?>
			<div class="straipsnis "> 
			<?PHP
            echo "<a href='?link=straipsniai&str=".$eil['Id']."'><p><img src='Images/".$eil['nuotrauka']."' style='width:200px"."'></p><h3>".$eil['Pavadinimas']."</h3></a><br>".substr($eil['mini_tekstas'], 0, 100)."<br>".$eil['data']."<br> patiko: ".$eil['patiko']."<br>nepatiko:" .$eil['neptaiko'];
            ?> 
			</div>
			<?PHP
        }
		}
?>