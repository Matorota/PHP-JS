<?php 
/*
file_exists($file)  // ar egzistuoja
is_writable($file)  // ar redaguojamas
is_readable($file)  // ar nuskaitomas

is_file($file)      // ar failas
is_dir($file)		// ar directorija

is_executable   //ar vygdomasis failas 

clearstatcache() //isvalyti cache

getimagesize($file)  

unlink($file);  // istrina faila
*/

$file = "text.txt";   // su abribotomis teisemis
//$file = "EU4-4.jpg";
$dir = "b";

if(file_exists($file))
{
	unlink($file) or die ("negaliu istringti");
}



/*
print_r (getimagesize($file)); 
print_r (getimagesize($file)['mime']); // konkretus masyvo elementas




if (echo is_file($file)) {
	echo "$dir yra failas";
}
else {echo "$dir nera failas";}
*/

//echo is_dir($file);

/*
if(file_exists($file)){
	echo "Failas yra";
	
}
else 
{
	echo "Failas nera";
}




if(is_writable($file))
{
	echo "Failas Redaguotas";
}
else {
	echo "<p>Failas neredaguojamas";
}


if(is_readable($file))
{
	echo "Failas nuskaitomas";
}
else {
	echo "<p>Failas nenuskaitomas";
}
*/



?>