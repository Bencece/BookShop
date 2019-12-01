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
$id=$_POST["id"];
if(isset($_POST['ekonyv'])){
	$ekony1=1;
}else{
	$ekony1=0;
}

	$stid = oci_parse($conn, "UPDATE KONYV
	SET NEV = '".$cim1."',
	KIADAS = '".$ev1."',
	KIADO_ID = ".$kiadoid1.",
	SZERZO_ID = ".$szerzoid1.",
	TOMEG = ".$tomeg1.",
	OLDALSZAM = ".$oldalszam1.",
	NYELV = '".$nyelv1."',
	LEIRAS = '".$leiras1."',
	MUFAJ_ID = ".$mufajid1.",
	ALMUFAJ_ID = ".$almufajid1.",
	AR = ".$ar1.",
	EKONYVE =".$ekony1."
	
	WHERE KONYV_ID=".$id."");
	oci_execute($stid);

header('Location: index.php');

?>