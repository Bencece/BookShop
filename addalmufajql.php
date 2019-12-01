<?php

include 'connection.php';
$mufajid=$_POST["mufajid"];
$almufaj1=$_POST["almufaj"];
$letezik=false;

$length = strlen($almufaj1);
if($length==0){
	echo 'Nem írtál be semmit!';
}else{
	
	$stid = oci_parse($conn, 'SELECT NEV FROM ALMUFAJ');
	oci_execute($stid);
	
	while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		if($item==$almufaj1){
			$letezik=true;
		}
    }
}
if($letezik){
	
	$stid = oci_parse($conn, "SELECT MUFAJ_ID FROM ALMUFAJ WHERE '".$almufaj1."'=NEV");
	oci_execute($stid);
	
	while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		if($item<>$mufajid){
			$letezik=false;
		}
    }
}
	
}


if(!$letezik){
	
	
	$stid = oci_parse($conn, 'SELECT COUNT(*) FROM ALMUFAJ');
	oci_execute($stid);
	
	
	while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		$maxid=$item;
    }
	}
	$maxid=$maxid+1;
	//AUTO_INCREMENT
	
	
	$stid = oci_parse($conn, "INSERT INTO ALMUFAJ (ALMUFAJ_ID, MUFAJ_ID, NEV) VALUES (".$maxid.",".$mufajid." ,'".$almufaj1."')");
	oci_execute($stid);
}else{
	echo'Már létezik ilyen műfaj!';
}
	
}




?>