<?php

include 'connection.php';
$cim1=$_POST["cim"];
$szerzoid1=$_POST["szerzoid"];
$ev1=$_POST["ev"];
$tomeg1=$_POST["tomeg"];
$oldalszam1=$_POST["oldalszam"];
$ar1=$_POST["ar"];
$leiras1=$_POST["leiras"];
$kiadoid1=$_POST["kiadoid"];
$mufajid1=$_POST["mufajid"];
$almufajid1=$_POST["almufajid"];
$nyelv1=$_POST["nyelv"];

$valaminemjo=false;

if(isset($_POST['ekonyv'])){
	$ekony1=1;
}else{
	$ekony1=0;
}


$vancim=false;
$vanszerzo=false;
$letezik=false;


$length = strlen($ev1);
if($length==0){
	echo 'Nem írtál be évet!</br>';
	$valaminemjo=true;
}
$length = strlen($tomeg1);
if($length==0){
	echo 'Nem írtál be tömeget!</br>';
	$valaminemjo=true;
}
$length = strlen($oldalszam1);
if($length==0){
	echo 'Nem írtál be oldalszámot!</br>';
	$valaminemjo=true;
}
$length = strlen($leiras1);
if($length==0){
	echo 'Nem írtál be leirást!</br>';
	$valaminemjo=true;
}
$length = strlen($nyelv1);
if($length==0){
	echo 'Nem írtál be nyelvet!</br>';
	$valaminemjo=true;
}
$length = strlen($ar1);
if($length==0){
	echo 'Nem írtál be árat!</br>';
	$valaminemjo=true;
}



$length = strlen($cim1);
if($length==0){
	echo 'Nem írtál be címet!';
	$valaminemjo=true;
}else{
	
	$stid = odbc_exec($conn, 'SELECT NEV FROM KONYV');
	
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		if($item==$cim1){
			$vancim=true;
		}
    }
}
$stid = odbc_exec($conn, 'SELECT SZERZO_ID FROM KONYV');
	
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		if($item==$szerzoid1){
			$vanszerzo=true;
		}
    }
}

if($vancim AND $vanszerzo){
	$letezik=true;
	$valaminemjo=true;
}

if(!$letezik){
	
	if(!$valaminemjo){
	$stid = odbc_exec($conn, 'SELECT COUNT(*) FROM KONYV');
	
	
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$maxid=$item;
    }
	}
	$maxid=$maxid+1;
	//AUTO_INCREMENT
	
	
	$stid = odbc_exec($conn, "INSERT INTO KONYV (KONYV_ID, NEV, KIADAS, KIADO_ID, SZERZO_ID, TOMEG, OLDALSZAM, NYELV, LEIRAS, MUFAJ_ID, ALMUFAJ_ID, EKONYVE, AR) VALUES (".$maxid.", '".$cim1."', '".$ev1."', ".$kiadoid1.", ".$szerzoid1.", ".$tomeg1.", ".$oldalszam1.", '".$nyelv1."', '".$leiras1."', ".$mufajid1.", ".$almufajid1.", ".$ekony1.", ".$ar1.")");
	
	}
}else{
	echo'Már létezik ilyen című könyv ezzel a szerzővel!';
}


$stid = odbc_exec($conn, 'SELECT COUNT(*) FROM ITEM');
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$maxitemid=$item;
    }
	}
	$maxitemid=$maxitemid+1;
	//AUTO_INCREMENT

	$stid = odbc_exec($conn, "INSERT INTO ITEM (ITEM_ID, KONYV_ID, ZENE_ID, FILM_ID) VALUES (".$maxitemid.", ".$maxid.", null, null)");
	
	
}
$target_dir = "pictures/konyv/";
$target_file = $target_dir .  $maxid.".jpg";//basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "A feltöltött fájl típusa:  " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Figyelem! A feltöltött fájl nem kép!";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "A ". basename( $_FILES["fileToUpload"]["name"]). " nevű fájl sikeresen feltöltve.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}



?>