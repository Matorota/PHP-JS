<?php
function add_people_form() {
?>
<form method="post">
<p><input type="text" name="vardas" placeholder="Jūsų vardas">*</p>
<p><input type="text" name="pavarde" placeholder="Jūsų pavardė">*</p>
<p><input type="password" name="slapt" placeholder="Slaptažodis">*</p>
<p><input type="password" name="slapt2" placeholder="Pakartoti slaptažodį">*</p>
<p><input type="email" name="email" placeholder="Jūsų email">*</p>
<p>Jūsų amžius: <input type="number" min="0" max="120" name="amzius" size="4">*</p>
<p><select name='miestai'>
<?php
	$conn = mysqli_connect("localhost", "root", "", "mano");
	$sql = "select * from miestai";
	$rez = mysqli_query($conn, $sql);
	if(mysqli_num_rows($rez) != 0) {
		for($i = 0; $i < mysqli_num_rows($rez); $i++) {
			$eil = mysqli_fetch_assoc($rez);
			echo "<option value='".$eil['Kodas']."'>".$eil['Miestas']."</option>";
		}
	}
?>
</select>
</p>
<input type="submit" name="new_person" value="Įrašyti">
</form>
<?php
}
function add_city_form() {
?>	
<form method="post">
	<p><input type="text" name="Miestas" placeholder="Miestas">*</p>
	<input type="submit" name="add_city" value="Įrašyti">
</form>
<?php	
}
?>
