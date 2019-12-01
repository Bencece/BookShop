<!doctype html>
<html lang="hu">
<head>
<meta charset="utf-8">
<title>Könyvesbolt</title>
<link rel="stylesheet" href="style.css"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="jumbotron col-sm-10 mx-auto" id="doboz">
  <div class="row">
    <h1 style="color:rgba(255,255,255,1.00); font-size:6vw">Könyvesbolt</h1>
  </div>

<?php
include 'connection.php';
include 'menu.php';
$id=$_POST["konyv"];
$scuccok;   
$redundancia=substr($id, -1);
$id=substr_replace($id, "", -1);

if($redundancia=="z"){
   $stid = odbc_exec($conn, "SELECT ZENE.NEV AS Cím, KONYVKIADO.NEV AS Kiadó, ZENE.AR AS Ár FROM ZENE,KONYVKIADO WHERE ZENE_ID=".$id." AND KONYVKIADO.KIADO_ID=ZENE.KIADO_ID");
}else{
	$stid = odbc_exec($conn, "SELECT FILM.NEV AS Cím, KONYVKIADO.NEV, FILM.AR, FILM.HOSSZ FROM FILM, KONYVKIADO WHERE FILM_ID=".$id." AND KONYVKIADO.KIADO_ID=FILM.KIADO_ID");
}
	
	
			
 $szamlalo=1;
 while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$scuccok[$szamlalo]=$item;
		$szamlalo=$szamlalo+1;
    }
 }
echo '<h2 align="center">'.$scuccok[1].'</h2>';
if($redundancia=="z"){
 $src="pictures/zene/";
}else{
$src="pictures/film/";
}	
		echo '
<div class="row">
	<img class="col-sm-3" src="'.$src.''.$id.'.jpg" width="100%"/>
	<div class="col-sm-9" id="vasaroldmeg">
		<h2>Vásárold meg most, kedvező áron!</h2>
	<h2>Ár: '.$scuccok[3].' Ft</h2>
	';
	if(isset($_COOKIE["felhasznalo"])){
		$id=$id.$redundancia;
		echo '<form action="rendelesl.php" method="post">';
	echo '<button type="submit" class="btn" value='.$id.' name="konyvid"><span class="navbar-toggler-icon"><img src="pictures/kosar.png" width="100%"/></span>Kosárba</button>';
	echo '</form>';
	}
	echo'</div>
	</div>
<table class="table table-striped table-bordered">
	
	<tr>
	<td>
	Kiadó:
	</td>
	<td>
	'.$scuccok[2].'
	</td>
	</tr>
	';
	if($redundancia=="f"){echo'
	<tr>
	<td>
	Hossz:
	</td>
	<td>
	'.$scuccok[4].' perc
	</td>
	</tr>';
	}
	echo'
</table>
';

?>
</div>
</body>
</html>