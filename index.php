<!DOCTYPE html>
<html>
<head>
	<?php
		define("DataBaseServer","");
		define("DataBaseUser","");
		define("DataBasePassword","");
		define("DataBaseName","");
	?>
	<title>Il Blog Di JackSpera</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<style>
		body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
		@keyframes post {
			from  {opacity:0;}
			to {opacity:1;}
		}
		.loader {
			border: 10px solid #f3f3f3; /* Light grey */
			border-top: 10px solid #3498db; /* Blue */
			border-radius: 50%;
			width: 60px;
			height: 60px;
			animation: spin 2s linear infinite;
		}

		@keyframes spin{
			0% { transform: rotate(0deg); }
			100% { transform: rotate(360deg); }
		}
		@keyframes heartbeat{
		  0%{
		    transform: scale(1);
		    color:pink;
		  }
		  50%{
		    transform: scale(3);
		    color: rgb(255, 0, 0);
		  }
		  100%{
		    transform: scale(2);
		    color: rgb(255, 0, 0);
		  }
		}
	</style>
	<script>
		function expand(Titolo){
		  var box=document.getElementById(Titolo);
		  box.innerHTML='<h6 style="position:relative;left: 50%;display:block;">Caricamento<div class="loader"></div></h6>';
		  var req = new XMLHttpRequest();
		  req.onreadystatechange = function() {
			if (req.readyState == 4 && req.status == 200) {
			  res=req.responseText;
			  box.innerHTML='<div class="w3-animate-left w3-large">'+req.responseText+'<br></div>';
			  box.style.animationName="post";
			  box.style.animationDuration="4s";
			}
		  };
		  req.open("GET","getText.php?title="+Titolo,true);
		  req.send();
		}

		function like(title){
		  var heart=document.getElementById("LIKE-"+title);
		  var error=document.getElementById("LikeErrore-Text");

		  var req = new XMLHttpRequest();
		  req.onreadystatechange = function() {
			if (req.readyState == 4 && req.status == 200) {
			  res=req.responseText;
			  switch(res){
			  	case "Succesfull":
			  		heart.style.animationName="heartbeat";
			  		heart.style.animationDuration="1s";
			  		heart.style.color="rgb(255, 0, 0)";
			  		break;
			  	case "Already Liked":
			  		error.innerHTML="Hai gia messo mi piace a questo elemento.";
			  		document.getElementById('LikeError').style.display='block';
			  		break;
			  	case "Not Title Given":
			  		error.innerHTML="Errore chiama un amministratore del sito.";
			  		document.getElementById('LikeError').style.display='block';
			  		break;
			  	case "Cokkie Disabled":
			  		error.innerHTML="Non puoi commentare se hai i Cookie disabilitati.";
			  		document.getElementById('LikeError').style.display='block';
			  		break;			  
			  	}
			}
		  };
		  req.open("GET","like.php?title="+title,true);
		  req.send();
		}
		function ready(){
			setTimeout(function(){
				window.scrollTo(1,1);
			});
		}
	</script>
</head>
<body class="w3-light-grey" onLoad="ready();">
<div id="LikeError" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('LikeError').style.display='none'" class="w3-closebtn">&times;</span>
      <p id="LikeErrore-Text">
      	General Error
      </p>
    </div>
  </div>
</div>
<!-- w3-content defines a container for fixed size centered content,
and is wrapped around the whole page content, except for the footer in this example -->
<div class="w3-content" style="max-width:1400px">

<!-- Header -->
<div class="w3-container w3-center w3-padding-32">
  <h1><b>Il mio BLOG</b></h1>
  <p>Il Blog di <span class="w3-tag">JackSpera</span></p>
</div>

<!-- About Card on medium screens -->
<div class="w3-hide-large w3-hide-small w3-margin-top w3-margin-bottom">
    <div class="w3-container w3-white w3-padding-32">
    <img src="Logo.png" alt="Me" style="width:150px" class="w3-left w3-round-large w3-margin-right">
      <h4><b>JackSpera</b></h4>
      <p>
		Un semplice ragazzo italiano a cui curioso dell'informatica<br>
		Conosco diversi linguaggi di programmazione come C++,Java,PHP e molti altri
	  </p>  </div>
</div>

<!-- About Card on small screens -->
<div class="w3-hide-large w3-hide-medium w3-margin-top w3-margin-bottom">
  <img src="Logo.png" style="width:100%" alt="Me">
  <div class="w3-container w3-white">
	<h4><b>JackSpera</b></h4>
	<p>
		Un semplice ragazzo italiano a cui curioso dell'informatica<br>
		Conosco diversi linguaggi di programmazione come C++,Java,PHP e molti altri
	</p>
  </div>
</div>

<!-- Grid -->
<div class="w3-row">

<!-- Blog entries-->
<div class="w3-col l8 s12">
  <!-- Blog entry 
  <div class="w3-card-4 w3-margin w3-white">
  <img src="img_woods.jpg" alt="Nature" style="width:100%">
    <div class="w3-container w3-padding-8">
      <h3><b>TITLE HEADING</b></h3>
      <h5>Title description, <span class="w3-opacity">April 7, 2014</span></h5>
    </div>

    <div class="w3-container">
      <p>Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at. Phasellus sed ultricies mi non congue ullam corper. Praesent tincidunt sed
        tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
      <div class="w3-row">
        <div class="w3-col m8 s12">
          <p><button class="w3-btn w3-padding-large w3-white w3-border w3-hover-border-black"><b>READ MORE »</b></button></p>
        </div>
        <div class="w3-col m4 w3-hide-small">
          <p><span class="w3-padding-large w3-right"><b>Comments  </b> <span class="w3-tag">0</span></span></p>
        </div>
      </div>
    </div>
  </div>
  <hr>
  -->
  <?php
  	$DB=mysqli_connect(DataBaseServer,DataBaseUser,DataBasePassword,DataBaseName);
	$res=mysqli_query($DB,"SELECT * FROM Post");
	$nil=true;
	while($row = mysqli_fetch_array($res)){
		$img=NULL;
		$imgSrc=$row["ImageSrc"];
		$title=$row["Titolo"];
		$desc=$row["Descrizione"];
		$LongDesc=$row["LongDesc"];
		$data=$row["Data"];
		$commenti=$row["NCommenti"];
		$MiPiace=$row["MiPiace"];
		$visite=$row["Visualizzazioni"];
		foreach(explode(";",$row["Tag"]) as $value){
			$Tag[]=$value;
		}
		if($imgSrc)
			$img='<img src="'.$imgSrc.'" alt="'.$title.'" style="width:100%;padding:10px;">';
		if(($_GET["tag"]&&strpos($row["Tag"],$_GET["tag"])!==false) or isset($_GET["tag"])==false){
			$nil=false;
			echo'
		  <!-- Blog entry -->
		  <div class="w3-card-4 w3-margin w3-white"  id="'.$title.'-TAG">
			'.$img.'
			<div class="w3-container w3-padding-8">
			  <h3><b>'.$title.'</b></h3>
			  <h5>'.$desc.',<span class="w3-opacity">'.$data.'</span></h5>
			</div>

			<div class="w3-container"style="height:auto;">
			<div id="'.$title.'">
			  <p>'.$LongDesc.'</p>
			  <div class="w3-row">
				<div class="w3-col m8 s12">
				  <p><button onClick="expand(\''.$title.'\')" class="w3-btn w3-padding-large w3-white w3-border w3-hover-border-black"><b>Continua a Leggere &gt;&gt;</b></button></p>
				</div>
			  <div class="w3-col m4 w3-hide-small">
				<p><span class="w3-padding-large w3-right" style="display:flex;"><span class="w3-tag">'.$visite.'</span><b style="padding-right:10px;">Visite</b><span class="w3-tag">'.$commenti.'</span><b style="padding-right:10px;">Commenti</b><span class="w3-tag">'.$MiPiace.'</span><b>MiPiace</b></span></p>
			  </div>
			  </div>
			</div>
			</div>
		  </div>
		  <hr>
		  ';
		}
	}
	if($nil){
		echo '
		<div class="w3-card-4 w3-margin w3-white">
			<div class="w3-container w3-padding-8">
			  <h3><b>Non ci sono ancora Post con questo tag</b></h3>
			</div>
		  </div>
		  <hr>';
	}
  ?>
<!-- END BLOG ENTRIES -->
</div>

<!-- Introduction menu -->
<div class="w3-col l4 w3-hide-medium w3-hide-small">
  <!-- About Card -->
  <div class="w3-card-2 w3-margin w3-margin-top">
  <!-- <img src="Logo.png" style="width:100%"> -->
  <div style="width: 100%; height: 350px; padding-bottom: 5px;">
	<script src="http://cdn.tagul.com/embed/qj511mw70i32"></script>
  </div>

    <div class="w3-container w3-white">
      <h4><b>JackSpera</b></h4>
      <p>
		Un semplice ragazzo italiano a cui curioso dell'informatica<br>
		Conosco diversi linguaggi di programmazione come C++,Java,PHP e molti altri
	  </p>
    </div>
  </div><hr>
  
  <!-- Posts -->
  <div class="w3-card-2 w3-margin">
    <div class="w3-container w3-padding">
      <h4>Post Popolari</h4>
    </div>
    <ul class="w3-ul w3-hoverable w3-white">
	  <?php
		$DB=mysqli_connect(DataBaseServer,DataBaseUser,DataBasePassword,DataBaseName);
		$res=mysqli_query($DB,"SELECT * FROM Post ORDER BY Visualizzazioni * 1 DESC LIMIT 3");
		while($row = mysqli_fetch_array($res)){
			$img=NULL;
			$title=$row["Titolo"];
			$imgSrc=$row["ImageSrc"];
			if($imgSrc)
				$img='<img src="'.$imgSrc.'" alt="'.$title.'" style="width:100%;padding:10px;">';
			 echo'
				<li class="w3-padding-16">
					<a href="#'.$title.'-TAG" style="text-decoration:none;display:block">
					'.$img.'
					<span class="w3-large">'.$row["Titolo"].'</span><br>
					<span>'.$row["Descrizione"].'</span>
					</a>
				</li>';
		}
	  ?>
    </ul>
  </div>
  <hr>
 
  <!-- Labels / tags -->
  <div class="w3-card-2 w3-margin">
    <div class="w3-container w3-padding">
      <h4>Tags</h4>
    </div>
    <div class="w3-container w3-white">
    <p>
	<?php
		$Tag=get_defined_vars()["Tag"];
		$Tag=array_unique($Tag);
		//var_dump($Tag);
		foreach($Tag as $tag){
			if($tag)
			 echo '<a href="?tag='.$tag.'" class="w3-btn w3-light-grey w3-small w3-margin-bottom JS-TAG">'.$tag.'</a> ';
		}
	?>
    </p>
    </div>
  </div>
  
<!-- END Introduction Menu -->
</div>

<!-- END GRID -->
</div><br>

<!-- END w3-content -->
</div>

<!-- Footer -->
<footer class="w3-container w3-dark-grey w3-padding-32 w3-margin-top" style="text-align:center;">
  <p>Powered by <a href="http://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
  <p>Powered by <a href="http://tagul.com/">Tagul.com</a></p>
</footer>

</body>
</html>

