<?php
include 'connection.php';

if(isset($_GET["k"]) && $_GET["k"]==true){
echo'<!doctype html>
<html lang="hu">
<head>
<meta charset="utf-8">
<title>Könyvesbolt</title>
<link rel="stylesheet" href="style.css"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>a
</head>
<body>
<div class="jumbotron col-sm-10 mx-auto" id="doboz">
<div class="row">
    <h1 style="color:rgba(255,255,255,1.00); font-size:6vw">Könyvesbolt</h1>
</div>';
   include 'menu.php';
	}

if(isset($_COOKIE["hany"])){
$szamlalo=1;
$osszar=0;
echo 'Kosár tartalma: </br>';
while($szamlalo<=$_COOKIE["hany"]){
$index=0;	
$stid = oci_parse($conn, "SELECT KONYV.NEV,KONYV.AR FROM KONYV,ITEM WHERE KONYV.KONYV_ID=ITEM.KONYV_ID AND ITEM.ITEM_ID=".$_COOKIE["hany".$szamlalo.""]."");

oci_execute($stid);
while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		if($index==0){
		echo 'Könyv:  '.$item;
		}else{
			echo '  Ár: '.$item.' Ft</br>';
			$osszar=$osszar+$item;
		}
		$index=$index+1;
    }
 }
 
$stid = oci_parse($conn, "SELECT ZENE.NEV,ZENE.AR FROM ZENE,ITEM WHERE ZENE.ZENE_ID=ITEM.ZENE_ID AND ITEM.ITEM_ID=".$_COOKIE["hany".$szamlalo.""]."");

oci_execute($stid);
while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		if($index==0){
		echo 'Zene:  '.$item;
		}else{
			echo '  Ár: '.$item.' Ft</br>';
			$osszar=$osszar+$item;
		}
		$index=$index+1;
    }
 }
 
$stid = oci_parse($conn, "SELECT FILM.NEV,FILM.AR FROM FILM,ITEM WHERE FILM.FILM_ID=ITEM.FILM_ID AND ITEM.ITEM_ID=".$_COOKIE["hany".$szamlalo.""]."");

oci_execute($stid);
 while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		if($index==0){
		echo 'Film:  '.$item;
		}else{
			echo '  Ár: '.$item.' Ft</br>';
			$osszar=$osszar+$item;
		}
		$index=$index+1;
    }
 }
 $szamlalo=$szamlalo+1;
}

echo 'Összesen: '.$osszar.' Ft';

echo '</br></br><form action="rendelesl2.php" method="post">
   <input type="radio" name="ren" value="szem" checked="true">Személyes átvétel
   ';
   
   echo '<select name=aruhazid>';
   
    $stid = oci_parse($conn, 'SELECT NEV, HELYSEG FROM ARUHAZ');
	oci_execute($stid);
 $szamlalo=1;
 $index=1;
 while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		if($index==1){
		echo "<option value=".$szamlalo.">".$item;
		$index=2;
		}else{
			echo '--> '.$item.'</option>';
			$index=1;
		}
    }
		$szamlalo=$szamlalo+1;
 }
   
   echo '</select>';
   
   echo'
   </br>
   <input type="radio" name="ren" value="kisz">Megadott címre kiszállítás</br>
   <div class="row mx-auto">
   <button class="btn btn-success" type="submit" name="konyvid">Rendelés</button>
   </form>
   <form action="resetasd.php?kosartorol" method="post" style="padding-left:10px; padding-right:10px">
   	<button class="btn btn-danger" type="submit">Kosár törlése</button>
   </form>
   <form action="index.php">
   	<button class="btn btn-warning" type="submit">Még böngészek</button>
   </form>
   </div>
   ';
}else{
	echo 'A kosár üres!</br>
   <!-- form action="index.php">
   	<button type="submit">Vissza a főoldalra</button>
   </form -->';
}
if(isset($_GET["k"]) && $_GET["k"]==true){
	echo'</div>
	</body>
	</html>';
	}
?>
