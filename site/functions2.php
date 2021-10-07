<?php

//---------------- straipsniu papildymas --------------------
function papildyti(){?>
<form enctype="multipart/form-data" method="POST">
<p>Pavadinimas 
<br><input type="text" size="50" name="Pav"></p>
<p>Trumpas tekstas 
<br><textarea name="ST" cols="50" rows="3"></textarea></p>
<p>Tekstas 
<br><textarea name="T" cols="50" rows="5"></textarea></p>
<p><input type ='file' name="failas"></p>
<input type="submit" value="Įrašyti..." name="Irasyti"></p>
</form>
<?php }
//------------------- straipsniu taisymas -------------------
function taisyti($Id){
$conn = mysqli_connect('localhost','root','','site') or die("Negaliu prisijungti prie DB");
$query = "select * from straipsniai where Id=".$Id."";
$rez1 = mysqli_query($conn, $query);
$e = mysqli_fetch_assoc($rez1);
?>
<form method="POST">
<p>Pavadinimas 
<br><input type="text" size="50" name="Pav" value="<?php echo $e['Pavadinimas']; ?>"></p>
<p>Trumpas tekstas 
<br><textarea name="ST" cols="50" rows="3" ><?php echo $e['mini_tekstas']; ?></textarea></p>
<p>Tekstas 
<br><textarea name="T" cols="50" rows="5"><?php echo $e['text']; ?></textarea></p>
<p>Būsena 
<br><select name="B">
 <option value="taip">Taip</option>
 <option value="ne">Ne</option>
 </select>
 </p>
<?php echo $e['nuotrauka']; ?></textarea></p>
<br><input type="text" size="50" name="L" value='<?php echo $e['data']; ?>'></p>
<p><input type="hidden" name="Id" value="<?php echo $e['Id']; ?>"><input type="submit" value="Atnaujinti" name="Keisti"></p>
</form>
<?php 
}

function redagavimas($Id, $pav, $B, $st, $t, $data) {
    $conn = mysqli_connect('localhost','root','','site') or die("KLAIDA");
    $query = "update straipsniai set Pavadinimas='".$pav."', busena='".$B."', mini_tekstas='".$st."', text='".$t."', data='".$data."' where Id=".$Id."";
    mysqli_query($conn, $query) or die("<p>klIDOS.2<br>Pamėginkite vėliau</p>");


}

// --------------------

//function atnaujinti_str(...){}
/*function atnaujinti_str($Ids)
{
	
	
}*/
/*function taisyti($ID)
{
	$conn = mysqli_connect('localhost','root','','site') or die ("neveikia");

	
}*/

function ar_trinti($Id){

    echo "Ar tikrai nori istrinti sita straipsni? Id=".$Id."";

    echo "<form method='post'>
    <input type='hidden'  name='taip' value='".$Id."'>
    <input type='submit' value='Taip, istrinti' name='Trinti'></form>

    <form method='post'>
    <input type='submit' value='Ne, neistrinti' name='netrinti'></form>";

}
function trinti($Id) {
	
		$conn = mysqli_connect('localhost','root','','site') or die ("neveikia");
		$rez2 =  "delete from straipsniai where Id=".$Id."";
		mysqli_query($conn,$rez2) or die ("kazkas negerai cia");
}
function irasyti($pav, $st, $t, $data, $nuotrauka) 
{
		$conn = mysqli_connect('localhost','root','','site');
		$rez2 = mysqli_query($conn, "insert into straipsniai values(null,'".$pav."','Taip','".$st."','".$t."','".$nuotrauka."','".$data."', 0, 0)") or die("Nepavyko"); 
	}
//------------------------------------------------------------
function lentele(){
$conn = mysqli_connect('localhost','root','','site') or die("Negaliu prisijungti prie DB");
mysqli_set_charset($conn, "utf8");
$query = "select * from straipsniai";
$rez=mysqli_query($conn, $query) or die("<p>Sistemos klaida...<br>Pamėginkite vėliau</p>");
$kiek=mysqli_num_rows($rez);
echo '<form method="post" class="center"><input type="submit" value="Naujas straipsnis" name="Papildyti"></form>';
echo '<table border="1">';
echo '<tr><th>Id</th><th>Būsena</th><th>Pavadinimas</th><th>Sutrumpintas text</th> <th>text</th><th>Laikas</th><th>Veiksmai</th></tr>';
for($i=0; $i<$kiek; $i++){
	   $e=mysqli_fetch_assoc($rez);
	   if ($e['busena']=='Taip'){$b='publikuojamas';}
	    else{$b='nepublikuojamas';}
	   echo '<tr><td valign="top">'.$e['Id'].'</td>';
	   echo '<td valign="top">'.$b.'</td>';
	   echo '<td valign="top">'.$e['Pavadinimas'].'</td>';
	   echo '<td valign="top">'.substr($e['mini_tekstas'], 0, 200).'...</td>';
	   echo '<td valign="top">'.substr($e['text'],0, 600).'...</td>';
	   echo '<td valign="top">'.$e['data'].'</td>';
	   echo '<td valign="top">
	   <form method="post"><input type="hidden" name="Redag" value="'.$e['Id'].'"><input type="image" src="images/edit_icon.png" title="Redaguoti"></form>
	   <form method="post"><input type="hidden" name="Tr" value="'.$e['Id'].'"><input type="image" src="images/trash.png" title="Trinti"></form></td>';
	     }
echo '</tr></table>';		 

}

?>	