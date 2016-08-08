<head>
	<?php
		define("DataBaseServer","");
		define("DataBaseUser","");
		define("DataBasePassword","");
		define("DataBaseName","");
	?>
	<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
	<style type="text/css">
		body{
			margin:1px;
		}
		h3,h4{
			font-family: "Comic Sans MS", cursive, sans-serif;
			display:inline;
		}
		#ComBox input,textarea{
			background-color: rgba(0,0,0,0);
			font-size: 15px;
			height:30px;
			border:0px;
			border-bottom: 1px blue solid;
			width: 150px;
			margin-top:20px;
			margin-right: 5px;
		}
		#ComBOX button{
			height:30px;
			padding:1px;
		}
		#ComBOX textarea{
			vertical-align: top;
		}
		#ComBox input:hover,textarea:hover{
			background-color: rgb(153, 179, 255);
		}
		::-webkit-scrollbar {
		  width: 3px;
		  height: 3px;
		}
		::-webkit-scrollbar-button {
		  width: 0px;
		  height: 0px;
		}
		::-webkit-scrollbar-thumb {
		  background: #0016dd;
		  border: 0px solid #6b85fe;
		  border-radius: 100px;
		}
		::-webkit-scrollbar-thumb:hover {
		  background: #ffffff;
		}
		::-webkit-scrollbar-thumb:active {
		  background: #000000;
		}
		::-webkit-scrollbar-track {
		  background: #333333;
		  border: 0px none #ffffff;
		  border-radius: 100px;
		}
		::-webkit-scrollbar-track:hover {
		  background: #333333;
		}
		::-webkit-scrollbar-track:active {
		  background: #333333;
		}
		::-webkit-scrollbar-corner {
		  background: transparent;
		}
	</style>
	<script>
		function startTextArea(element){
			setInterval(autoGrowTextArea(element),100);
		}
		function autoGrowTextArea(element) {
		    element.style.height = "5px";
		    element.style.height = (element.scrollHeight)+"px";
		}
  	</script>
</head>
<body>
<div id="ComBOX">
	<form method="POST">
		<input type="hidden" name='<?$title=$_GET["title"];if($title==NULL){$title=$_POST["title"];}?>'>
		<input type="text" name="nick" placeholder="Nickname">
		<textarea rows="1" onkeydown="startTextArea(this);" placeholder="Commento" name="data"></textarea>
		<button class="w3-btn w3-padding-small w3-white w3-border w3-hover-border-black">Inserisci il commento</button><br>
	</form>
</div>
<?php
	$title=$_GET["title"];
	if($title==NULL){
		$title=$_POST["title"];
	}
	if($_POST["nick"]!=NULL&&$_POST["data"]!=NULL&&$title){
		$DB=mysqli_connect(DataBaseServer,DataBaseUser,DataBasePassword,DataBaseName);
		$sql=mysqli_prepare($DB,"SELECT `Commenti` FROM Post WHERE `Titolo`=?");
		mysqli_stmt_bind_param($sql,"s",$title);
		mysqli_execute($sql);
		mysqli_stmt_bind_result($sql,$comm);
		mysqli_stmt_fetch($sql);
		if(strpos($_POST["nick"],"#")!=false){
			$nick=explode("#",$_POST["nick"]);
			$Atrip=crypt($nick[0],"\$1\$ABCDEFGHILMNOPQRST".$nick[1]);
			$trip="!";
			for($i=12;$i<strlen($Atrip);$i++){
				$trip.=$Atrip[$i];
			}
			$nick=$nick[0].$trip;
		}else{
			$nick=$_POST["nick"];
		}
		$comm=json_decode($comm,true);
		array_unshift($comm,["nick"=>$nick,"data"=>$_POST["data"]]);
		//$comm[]=["nick"=>$nick,"data"=>$_POST["data"]];
		$comm=json_encode($comm);

		$DB=mysqli_connect(DataBaseServer,DataBaseUser,DataBasePassword,DataBaseName);
		$sql=mysqli_prepare($DB,"UPDATE Post SET `Commenti`=? WHERE `Titolo`=?");
		mysqli_stmt_bind_param($sql,"ss",$comm,$title);
		mysqli_execute($sql);
		$update=mysqli_prepare($DB,"UPDATE `Post` SET `NCommenti` = `NCommenti` + 1 WHERE `Titolo`=?;");
		mysqli_stmt_bind_param($update,"s",$title);
		mysqli_execute($update);
	}
	if ($title) {
		$DB=mysqli_connect(DataBaseServer,DataBaseUser,DataBasePassword,DataBaseName);
		$sql=mysqli_prepare($DB,"SELECT `Commenti` FROM Post WHERE `Titolo`=?");
		mysqli_stmt_bind_param($sql,"s",$title);
		mysqli_execute($sql);
		mysqli_stmt_bind_result($sql,$comm);
		mysqli_stmt_fetch($sql);
		$comm=json_decode($comm,true);
		for($i=0;$i<sizeof($comm);$i++){
			echo "<h4>{$comm[$i]['nick']}:</h4><br> \\-{$comm[$i]['data']}<br>";
		}
	}
?>