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
</head>
<body>
<div class="jumbotron col-sm-10 mx-auto" id="doboz">
  <div class="row">
    <h1 style="color:rgba(255,255,255,1.00); font-size:6vw;">Könyvesbolt</h1>
  </div>
  <?php include 'menu.php';
   ?>
<?php

$hanydarab=0;
include 'connection.php';
$selecthumor="SELECT KONYV.KONYV_ID, KONYV.NEV AS Cím, KONYV.KIADAS AS Kiadás, SZERZO.NEV AS Szerző, KONYVKIADO.NEV AS Kiadó, TOMEG AS Tömeg, OLDALSZAM AS Oldalszám, NYELV, MUFAJ.NEV AS Műfaj, ALMUFAJ.NEV AS Alműfaj, KONYV.AR AS Ár FROM KONYV, SZERZO, KONYVKIADO, MUFAJ, ALMUFAJ ";
if(isset($_POST["beirt"])){
$beirt=$_POST["beirt"];
}
if(isset($_POST["ker"])){
$ker=$_POST["ker"];
}
if(isset($_POST["szerzonev"])){
$szerzonev=$_POST["szerzonev"];
}
if(isset($_POST["mufaj"])){
$mufaj=$_POST["mufaj"];
}
echo '<table class="table  table-responsive-sm table-striped table-bordered" style="background-color:inherit; margin-top:30px">';

if(isset($_POST["beirt2"])){
	$beirt=$_POST["beirt2"];
	$ker2=$_POST["ker2"];
	if($ker2=="ZENE"){
		$stid = odbc_exec($conn, "SELECT ZENE.ZENE_ID, ZENE.NEV AS Név, KONYVKIADO.NEV AS Kiadó, ZENE.AR AS Ár FROM ZENE, KONYVKIADO WHERE UPPER(ZENE.NEV) LIKE UPPER('%".$beirt."%') AND ZENE.KIADO_ID=KONYVKIADO.KIADO_ID");
		$redundancia="z";
	}elseif($ker2=="FILM"){
		$stid = odbc_exec($conn, "SELECT FILM.FILM_ID, FILM.NEV AS Név, KONYVKIADO.NEV AS Kiadó, FILM.HOSSZ AS Hossz, FILM.AR AS Ár FROM FILM, KONYVKIADO WHERE UPPER(FILM.NEV) LIKE UPPER('%".$beirt."%') AND FILM.KIADO_ID=KONYVKIADO.KIADO_ID");
		$redundancia="f";
	}
	
}


if(isset($_POST["beirt"]) AND isset($_POST["ker"])){
if($ker=="KIADAS" OR $ker=="NEV"){
$stid = odbc_exec($conn, "".$selecthumor."WHERE UPPER(KONYV.".$ker.") LIKE UPPER('%".$beirt."%') AND SZERZO.SZERZO_ID=KONYV.SZERZO_ID AND KONYVKIADO.KIADO_ID=KONYV.KIADO_ID AND MUFAJ.MUFAJ_ID=KONYV.MUFAJ_ID AND ALMUFAJ.ALMUFAJ_ID=KONYV.ALMUFAJ_ID");
}else if($ker=="SZERZO"){
	if($beirt==""){
		$beirt="Horváth Júlia";
	}
$stid = odbc_exec($conn, "".$selecthumor."WHERE KONYV.SZERZO_ID=(SELECT SZERZO_ID FROM SZERZO WHERE UPPER(NEV) LIKE UPPER('%".$beirt."%')) AND KONYVKIADO.KIADO_ID=KONYV.KIADO_ID AND MUFAJ.MUFAJ_ID=KONYV.MUFAJ_ID AND ALMUFAJ.ALMUFAJ_ID=KONYV.ALMUFAJ_ID AND SZERZO.SZERZO_ID=KONYV.SZERZO_ID");
}
}
if(isset($_POST["szerzonev"])){
	$stid = odbc_exec($conn, "".$selecthumor."WHERE KONYV.SZERZO_ID='".$szerzonev."' AND SZERZO.SZERZO_ID=KONYV.SZERZO_ID AND KONYVKIADO.KIADO_ID=KONYV.KIADO_ID AND MUFAJ.MUFAJ_ID=KONYV.MUFAJ_ID AND ALMUFAJ.ALMUFAJ_ID=KONYV.ALMUFAJ_ID");
}
if(isset($_POST["mufaj"])){
	$stid = odbc_exec($conn, "".$selecthumor."WHERE KONYV.MUFAJ_ID='".$mufaj."' AND SZERZO.SZERZO_ID=KONYV.SZERZO_ID AND KONYVKIADO.KIADO_ID=KONYV.KIADO_ID AND MUFAJ.MUFAJ_ID=KONYV.MUFAJ_ID AND ALMUFAJ.ALMUFAJ_ID=KONYV.ALMUFAJ_ID");
}


if(isset($_POST["ker"]) OR isset($_POST["mufaj"]) OR isset($_POST["szerzonev"])){


$nfields = odbc_num_fields($stid);
echo '<tr>';
for ($i = 1; $i<=$nfields; $i++){
	if($i==1){
	}else{
    $field = odbc_field_name($stid, $i);
    echo '<td>' . $field . '</td>';
	}
	
}
echo '</tr>';

$szamlalo=1;
$indexszamlalo=1;
echo'<form action="konyvmegjelenites.php" method="post">';
while ( $row = odbc_fetch_array($stid)) {
    echo '<tr>';
    foreach ($row as $item) {
		if($szamlalo==1){
			$indexek[$indexszamlalo]=$item;
		}
		else if($szamlalo==2){
		echo '<td>  <button type="submit" name="konyv" value="'.$indexek[$indexszamlalo].'" class="btn-link" id="listagomb"><p class="text-center">'.$item.'</p></button> </td>'; 
		$hanydarab++;
		$indexszamlalo=$indexszamlalo+1;
		}
		else{
        echo '<td>' . $item . '</td>';
		}
		$szamlalo=$szamlalo+1;
    }
	$szamlalo=1;
    echo '</tr>';
}
echo '</form>';
echo '</table>';
}else{


$nfields = odbc_num_fields($stid);
echo '<tr>';
for ($i = 1; $i<=$nfields; $i++){
	if($i==1){
	}else{
    $field = odbc_field_name($stid, $i);
    echo '<td>' . $field . '</td>';
	}
	
}
echo '</tr>';

$szamlalo=1;
$indexszamlalo=1;


echo'<form action="fzmegjelenites.php" method="post">';
while ( $row = odbc_fetch_array($stid)) {
    echo '<tr>';
    foreach ($row as $item) {
		if($szamlalo==1){
			$indexek[$indexszamlalo]=$item;if(isset($redundancia)){
			$indexek[$indexszamlalo]=$indexek[$indexszamlalo].$redundancia;}
		}
		else if($szamlalo==2){
		echo '<td> <button type="submit" name="konyv"  id="listagomb" value="'.$indexek[$indexszamlalo].'" class="btn-link">'.$item.'</button></td>'; 
		$hanydarab++;
		$indexszamlalo=$indexszamlalo+1;
		}
		else{
        echo '<td>' . $item . '</td>';
		}
		$szamlalo=$szamlalo+1;
    }
	$szamlalo=1;
    echo '</tr>';
}
echo '</form>';
echo '</table>';
}
echo '</br>'.$hanydarab;
echo ' találat a keresésre.';
?>
</div>
</body>
</html>