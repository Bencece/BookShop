<?php

include 'connection.php';
$mufaj1=$_POST["mufaj"];
$letezik=false;

$length = strlen($mufaj1);
if($length==0){
	echo 'Nem írtál be semmit!';
}else{
	
	$stid = oci_parse($conn, 'SELECT NEV FROM MUFAJ');
	oci_execute($stid);
	
	while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		if($item==$mufaj1){
			$letezik=true;
		}
    }
}
if(!$letezik){
	
	
	$stid = oci_parse($conn, 'SELECT COUNT(*) FROM MUFAJ');
	oci_execute($stid);
	
	
	while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		$maxid=$item;
    }
	}
	$maxid=$maxid+1;
	//AUTO_INCREMENT
	
	
	$stid = oci_parse($conn, "INSERT INTO MUFAJ (MUFAJ_ID, NEV) VALUES (".$maxid.", '".$mufaj1."')");
	oci_execute($stid);
}else{
	echo'Már létezik ilyen műfaj!';
}
	
}




?>