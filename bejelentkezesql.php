<?php 

include 'connection.php';


if(!isset($_COOKIE["felhasznalo"])){
$felnev1=$_POST["fnev"];
$jelszo1=$_POST["jelszo"];
$valaminemjo=false;
$nincsnev=false;
$nincsjelszo=false;
$length = strlen($jelszo1);
if($length==0){
	echo 'Nem írtál be jelszót!</br>';
	header("Location: index.php?hiba=nincsjszo");
	$valaminemjo=true;
	$nincsjelszo=true;
}$length = strlen($felnev1);
if($length==0){
	echo 'Nem írtál be felhasználónevet!</br>';
	$valaminemjo=true;
	$nincsnev=true;
	header("Location: index.php?hiba=nincsfnev");
}
	$nagyonnev="";
if($nincsnev==false){
	$stid = odbc_exec($conn, 'SELECT FELHASZNALONEV FROM FELHASZNALO');
	
	$nagyonnev="";
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		if($item==$felnev1){
			$nagyonnev=$item;
		}
    }
}
}
if($nagyonnev==""){
	if($felnev1<>""){
		header("Location: index.php?hiba=fnev");
	echo 'Hibás felhasználónév!</br>';
	}
	$valaminemjo=true;
}else{
	$jojelszo=false;
$shajelszo=hash ( 'sha256' , ''.$jelszo1.'' , $raw_output = FALSE  );
	$stid = odbc_exec($conn, "SELECT FELHASZNALO_ID FROM FELHASZNALO WHERE FELHASZNALONEV='".$nagyonnev."' AND JELSZO='".$shajelszo."'");
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$jojelszo=true;
    }
}
	
	if($jojelszo){
		setcookie("felhasznalo", $nagyonnev, time() + (86400 * 30));
		header("Location: index.php?sikeresbej=true");
	}else{
		if($nincsjelszo==false){
		header("Location: index.php?hiba=jszo");
		echo 'Hibás jelszó!</br>';
		$valaminemjo=true;
	}
	}
}
}else{
		header("Location: resetasd.php");
	setcookie("felhasznalo", null, -1);
		header("Location: index.php?sikereski=true");
}

/*if($valaminemjo){
	echo'<a href="index.php">Vissza a főoldalra</a>';
}*/

?>