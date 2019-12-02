<?php 
include 'connection.php';


	$stid = odbc_exec($conn, 'SELECT COUNT(*) FROM FELHASZNALO');
	
	
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$maxid=$item;
    }
	
	$maxid=$maxid+1;
	
	//Felhasznalo_ID AUTO_INCREMENT
}
	
	

$nev1=$_POST["nev"];
$email1=$_POST["email"];
$felnev1=$_POST["fnev"];
$jelszo1=$_POST["jelszo"];
$lcim1=$_POST["lcim"];

$valaminemjo=false;


$length=strlen($email1);
if($length==0){
	echo 'Nem írtál be e-mail címet!</br>';
	header("Location: index.php?hiba=regemail");
}else{
if (!preg_match("^[a-zA-Z0-9]*[@][a-zA-Z0-9]*[.][a-z]*^",$email1)) {
  echo 'Hibás e-mail cím<br>'; 
  header("Location: index.php?hiba=regemailformat");
  $valaminemjo=true;
}
}


$nagybetu=false;
$kisbetu=false;
$szam=false;

$length = strlen($jelszo1);
if($length==0){
	$valaminemjo=true;
	echo 'Nem írtál be jelszót!';
	header("Location: index.php?hiba=regjszo");
}else{
for ($i=0; $i<$length; $i++) {
       if(preg_match("^[A-Z]^",$jelszo1[$i])){
		   $nagybetu=true;
	   }
	   if(preg_match("^[a-z]^",$jelszo1[$i])){
		   $kisbetu=true;
	   }
	   if(preg_match("^[0-9]^",$jelszo1[$i])){
		   $szam=true;
	   }
}

if($nagybetu && $kisbetu && $szam){
$shajelszo=hash ( 'sha256' , ''.$jelszo1.'' , $raw_output = FALSE  );
	
}else{
	echo 'A jelszónak tartalmaznia kell legalább egy kisbetűt, nagybetűt és számot!<br>';
	header("Location: index.php?hiba=regjszoformat");
	$valaminemjo=true;
}
}



if($valaminemjo==false){
	
	
	
$stid = odbc_exec($conn, "INSERT INTO felhasznalo (Felhasznalo_ID, Nev, Lakcim, Torzsvasarlo, Admine, Idaigvasarolt, Felhasznalonev, Jelszo, Email) VALUES
(".$maxid.", '".$nev1."', '".$lcim1."', 0, 0, 0, '".$felnev1."', '".$shajelszo."', '".$email1."')");

$siker=$stid;
if($siker){
	header ('Location: index.php?sikeresreg=true');
}else{
	header("Location: index.php?hiba=reg");
}



}else{
echo '</br><a href="index.php">Vissza a főoldalra</a>';	
}




oci_close($conn);



?>