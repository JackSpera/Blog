<?php
	define("DataBaseServer","");
	define("DataBaseUser","");
	define("DataBasePassword","");
	define("DataBaseName","");
	if(isset($_COOKIE)==false){
		die("Cokkie Disabled");
	}
	if($_GET["title"]==NULL){
		die("Not Title Given");
	}
	if($_COOKIE["Like-".$_GET["title"]]==true){
		die("Already Liked");
	}
	setcookie("Like-".$_GET["title"],true,time()+3600*24*365,"/");
	$DB=mysqli_connect(DataBaseServer,DataBaseUser,DataBasePassword,DataBaseName);
	$sql=mysqli_prepare($DB,"UPDATE `Post` SET `MiPiace` = `MiPiace` + 1 WHERE `Titolo`=?;");
	mysqli_stmt_bind_param($sql,"s",$_GET["title"]);
	mysqli_execute($sql);
	echo "Succesfull";
?>