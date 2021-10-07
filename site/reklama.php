<?php

$reklama = array('20358629.jpg','20994130.jpg','22605644.png','21833514.jpg','21718362.jpg');
if(!isset($_SESSION['reklama'])) {
$rekl = rand(0, count($reklama)-1);
$_SESSION['reklama'] = $reklama[$rekl];
}

?>

<img src='reklamas/<?php echo $_SESSION['reklama']; ?>' class='reklama_img'>
<img src='reklamas/<?php echo $_SESSION['reklama']; ?>' class='reklama_img'>
<img src='reklamas/<?php echo $_SESSION['reklama']; ?>' class='reklama_img'>

