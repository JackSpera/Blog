<head>
	<?php
		define("DataBaseServer","");
		define("DataBaseUser","");
		define("DataBasePassword","");
		define("DataBaseName","");
	?>
	<style type="text/css">
		.container{
			height:500px;
			width:100%;
			padding:0px;
			margin:0px;
		}
	</style>
</head>
<?php
	$title=$_GET["title"];
  	$DB=mysqli_connect(DataBaseServer,DataBaseUser,DataBasePassword,DataBaseName);
	$res=mysqli_query($DB,"SELECT Titolo,Testo FROM Post");
	while($row = mysqli_fetch_array($res)){
		if($title==$row["Titolo"]){
			mysqli_query($DB,"UPDATE `Post` SET `Visualizzazioni` = `Visualizzazioni` + 1 WHERE `Titolo`='".$row["Titolo"]."';");
			echo str_replace("\n","<br>",$row["Testo"]);
			echo '<br><a href="javascript:like(\''.$title.'\');"><i class="fa fa-heart like" style="color:pink;" id="LIKE-'.$title.'"></i>Mi Piace<br></a><fieldset style="height:100%;width:100%;margin:0;padding:0;margin-bottom:5px;"><legend style="margin:-17px;"><h3>Commenti:</h3></legend><div class="container"><iframe style="display:block;height:100%;width:100%;border:0px" src="commenti.php?title='.$title.'"></div></fieldset>';
		}
	}
?>