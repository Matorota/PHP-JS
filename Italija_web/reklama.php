
<div class = "reklamu">
<?php $randomdir = dir('reklamas');
$count = 1;
$pattern="/(gif|jpg|jpeg|png)/";
while($file = $randomdir->read()) {
	$ext = pathinfo($file, PATHINFO_EXTENSION);
	if (preg_match($pattern, $ext)) {
		$imagearray[$count] = $file;
		$count++;
	}
}
$random = mt_rand(1, $count - 1); 
echo '<img src="reklamas/'.$imagearray[$random].'" alt />';
?>
<?php $randomdir = dir('reklamas');
$count = 1;
$pattern="/(gif|jpg|jpeg|png)/";
while($file = $randomdir->read()) {
	$ext = pathinfo($file, PATHINFO_EXTENSION);
	if (preg_match($pattern, $ext)) {
		$imagearray[$count] = $file;
		$count++;
	}
}
$random = mt_rand(1, $count - 1); 
echo '<img src="reklamas/'.$imagearray[$random].'" alt />';
?>
<?php $randomdir = dir('reklamas');
$count = 1;
$pattern="/(gif|jpg|jpeg|png)/";
while($file = $randomdir->read()) {
	$ext = pathinfo($file, PATHINFO_EXTENSION);
	if (preg_match($pattern, $ext)) {
		$imagearray[$count] = $file;
		$count++;
	}
}
$random = mt_rand(1, $count - 1); 
echo '<img src="reklamas/'.$imagearray[$random].'" alt />';
?>





