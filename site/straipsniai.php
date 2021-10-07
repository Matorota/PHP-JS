<header>Straipsniai</header>
<?php

$conn = @mysqli_connect("localhost", "root", "", "site") or die("Negaliu prisijungti prie DB");
mysqli_set_charset($conn, "utf8");
$sql = "select * from straipsniai";
$albumas = 'img';
$rez = mysqli_query($conn, $sql) or die("Negaliu rasti irasu");
$kiek = mysqli_num_rows($rez);		
	if(mysqli_num_rows($rez) != 0) {
		?>
		
		<style>
		.straipsnis
		{
			
	width:30%;
    float:left;
    border:solid 1px #ccc;  
	margin:1%;
	Heigth:200px;
		}
		</style>

<?php
		
		if(isset($_GET['str'])) {
            $ID = $_GET['str'];
            $query2 = "select * from straipsniai where ID=".$ID;
            $rez2 = mysqli_query($conn, $query2);
            $eil2 = mysqli_fetch_assoc($rez2);
            ?><div class="straipsnis2"> 
			

			<?PHP
            echo "<p><img class='foto2' src='img/".$eil2['nuotrauka']."' style='width:900px"."'></p><h1>".$eil2['Pavadinimas']."</h1><p>".$eil2['mini_tekstas']."</p><p>".$eil2['text']."</p><br>".$eil2['data']."<br> patiko: ".$eil2['patiko']."<br>nepatiko:" .$eil2['nepatiko'];
			 ?>
			 <form method="POST" >
			 <input type="hidden" name="Id" value="<?php echo $eil2['Id']; ?>">
			<input type = "submit" class="buttonclass" name ="patiko" id ="patiko" value="like">		 
			</form>
			
			
			<form  method="POST">
			<input type="hidden" name="Id" value="<?php echo $eil2['Id']; ?>">
			<input type = "submit" class="buttonclass" name ="nepatiko" id ="nepatiko" value="dislike">
			</form>
			
			<?PHP
			// patiko
		if(isset($_POST['patiko']))
		{
			$ID = $_POST['Id'];
			$conn = mysqli_connect('localhost','root','','site') or die("KLAIDA");
			 $query = "update straipsniai set patiko= patiko + 1  where Id=".$ID."";
			mysqli_query($conn, $query) or die("<p>klIDOS.2<br>Pamėginkite vėliau</p>");
				echo "<meta http-equiv='refresh' content='0'>";
		}
		
		// nepatiko
		if(isset($_POST['nepatiko']))
		{
			$ID = $_POST['Id'];
			$conn = mysqli_connect('localhost','root','','site') or die("KLAIDA");
			 $query = "update straipsniai set nepatiko= nepatiko + 1  where Id=".$ID."";
			mysqli_query($conn, $query) or die("<p>klIDOS.2<br>Pamėginkite vėliau</p>");
				echo "<meta http-equiv='refresh' content='0'>";
		}
			
			/*
	if ($_GET['rating'] == "patiko or nepatiko")		{
$darbas = $_GET['Rating'];
    $postLike = $postData['patiko'];
    $postDislike = $postData['nepatiko'];
    
    $postDislike = $postData['dislike_num'];
echo "<a href='index.php?link=straipsniai&Rating=patiko&ID=".$eil2['ID']."'>";
	}
	   if($_POST['rating'] == 1){
        $like_num = ($postLike + 1);
        $upData = array(
            'like_num' => $like_num
        );
        $return_count = $like_num;
    }else{
        $dislike_num = ($postDislike + 1);
        $upData = array(
            'dislike_num' => $dislike_num
        );
        $return_count = $dislike_num;
    }

    $condition = array('ID' => $_POST['ID']);
    $update = $post->update($upData, $condition);


*/
            ?> </div> <?PHP

	$con = mysqli_connect('localhost','root','','site');
/*
	if (isset($_POST['patiko'])) {
		$postid = $_POST['postid'];
		$result = mysqli_query($con, "SELECT * FROM posts WHERE id=$postid");
		$row = mysqli_fetch_array($result);
		$n = $row['patiko'];

		mysqli_query($con, "INSERT INTO patiko (userid, postid) VALUES (1, $postid)");
		mysqli_query($con, "UPDATE posts SET patiko=$n+1 WHERE id=$postid");

		echo $n+1;
	}*//*
	if (isset($_POST['nepatiko'])) {
		$postid = $_POST['postid'];
		$result = mysqli_query($con, "SELECT * FROM posts WHERE id=$postid");
		$row = mysqli_fetch_array($result);
		$n = $row['nepatiko'];

		mysqli_query($con, "DELETE FROM nepatiko WHERE nepatiko=$postid AND userid=1");
		mysqli_query($con, "UPDATE posts SET nepatiko=$n-1 WHERE id=$postid");
		
		echo $n-1;

	}*/

	// Retrieve posts from the database
	$posts = mysqli_query($con, "SELECT * FROM posts");
        }

	
	
	for($i = 0; $i < mysqli_num_rows($rez); $i++) {
            $eil = mysqli_fetch_assoc($rez);
            ?>
			<div class="straipsnis"> 
			<?PHP
            echo "<a href='?link=straipsniai&str=".$eil['Id']."'><p><img src='img/".$eil['nuotrauka']."' style='width:200px"."'></p><h3>".$eil['Pavadinimas']."</h3></a><br>".substr($eil['mini_tekstas'], 20)."<br>".$eil['data']."<br> patiko: ".$eil['patiko']."<br>nepatiko:" .$eil['nepatiko'];
            ?> 
			</div>
			<?PHP
        }
		}
?>

