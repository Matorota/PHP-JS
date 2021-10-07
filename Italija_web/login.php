<?php

if(!isset($_SESSION)){

	session_start;
	
}

if(isset($_POST['registration'])){
	$name = "";
	$surname = "";
	$email = "";
	$age = "";
	registr($name, $surname, $email, $age);

}
elseif(isset($_POST['login'])){
	$email1 = "";
	prisijung($email1);

}
// jeigu vyksta registravimas
if(isset($_POST['reg'])){ 
	$name = $_POST['vardas'];
	$surname = $_POST['pavarde'];
	$email = $_POST['email'];
	$age = $_POST['age'];
	$slapt = $_POST['slapt'];
	$slapt1 = $_POST['slapt1'];
	$conn1 = mysqli_connect("localhost", "root", "", "italija") or die("Negaliu prisijungti prie DB");
	$rez2 = mysqli_query($conn1, "select * from users where email='".$email."';");
	$rez3 = mysqli_fetch_assoc($rez2);
	$error = 0;
	if($name == "" || $surname == "" || $email == "" || $age == "" || $slapt == "" || $slapt1 == ""){
		$error = 1;
	}
	elseif($rez3['email'] == $email){
		$error = 2;
	}
	elseif($slapt !== $slapt1){
		$error = 3;
	}
	if($error != 0){
		if($error == 1){
			echo "<h3 id='error'>Palikote neužpildytų laukų</h3>";
			registr($name, $surname, $email, $age);
		}
		if($error == 2){
			echo "<h3 id='error'>Toks el. paštas jau užregistruotas</h3>";
			registr($name, $surname, $email, $age);
		}
		if($error == 3){
			echo "<h3 id='error'>Slaptažodžiai nesutampa</h3>";
			registr($name, $surname, $email, $age);
		}
	}
	else{
	date_default_timezone_set("Europe/Vilnius");
	$data = date("Y-m-d H:i:s");
	$conn = mysqli_connect('localhost','root','','italija') or die("Duombaze nepasiekiama");
	mysqli_query($conn, "insert into users values(null, '".$name."', '".$slapt."', '".$email."', ".$age.", '".$surname."')");
	echo "<h3 id='error'>Sekmingai prisiregistravote, dabar galite prisijungti</h3>";
	reglog();
	}
}	
elseif(isset($_POST['prisijungti'])){
	$email1 = $_POST['email1'];
	$password1 = $_POST['password1'];
	$error1 = 0;
	$conn = mysqli_connect('localhost','root','','italija') or die("Duombaze nepasiekiama");
	$rez = mysqli_query($conn, "select * from users where email='".$email1."';");
	$rez1 = mysqli_fetch_assoc($rez);		

	if(empty($email1) || empty($password1)){
		$error1 = 4;
	}
	elseif($rez1['email'] == ""){
		$error1 = 5;
	}
	elseif($rez1['password'] !== $password1){
		$error1 = 6;
	}
	if($error1 != 0){
		
			if($error1 == 4){
				echo "<h3 id='error'>Palikote neuzpildytu lauku</h3>";
				prisijung($email1);
			}
			if($error1 == 5){
				echo "<h3 id='error'>Tokio el. pašto nėra</h3>";
				prisijung();
			}
			if($error1 == 6){
				echo "<h3 id='error'>Neteisingas slaptažodis</h3>";
				prisijung($email1);
			}
		}
	else{
		$_SESSION['email'] = $email1;
		$_SESSION['username'] = $rez1['username'];
		
}
}

if(isset($_SESSION['email'])){
	$email = $_SESSION['email'];
	$conn1 = mysqli_connect("localhost", "root", "", "italija") or die("Negaliu prisijungti prie DB");
	$rez = mysqli_query($conn1, "select * from users where email='".$email."';");
	$rez1 =  	mysqli_fetch_assoc($rez);
	$user_id = $rez1['id'];
	logout($user_id);
	echo "<h3 id = 'userinfo' >Vartotojas:".$rez1['username']." ".$rez1['email']."</h3>";
		//echo "Login succesfull";	
	}
	
	else{
	reglog();
}		
if(isset($_POST['atsijungti'])){
		
    unset($_SESSION['email']);
    unset($_SESSION['name']);
    header("Refresh:0");
	}

/*
if(isset($_POST['login'])) {
	$email = $_POST['email1'];
	$slapt = $_POST['password1'];
	$_SESSION['login_user'] = $username;

if ($slapt == "" ||  $email== "")
{
	echo "neuzpildyta";
}// jungiames prie db ir surandame vartotoja su tokiu email
else {
	$conn1 = mysqli_connect("localhost", "root", "", "italija") or die("Negaliu prisijungti prie DB");
	   
            $msg = '';

				echo "<h3 id='userinfo'>Vartotojas: ".$_SESSION['vardas']." ".$_SESSION['email']."</h3>";
               if ($_POST['email1'] == $email && 
                  $_POST['password1'] == '1234') {

                  
                  echo 'gerai suveded';
               }else {
                  $msg = 'blogai';
               }
            }
	
}
	
	if(isset($_POST['atsijungti'])){
    unset($_SESSION['email']);
    unset($_SESSION['username']);
    header("Refresh:0");
}*/

	



