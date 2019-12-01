<?php

include 'connection.php';
$szerzo1=$_POST["szerzo"];
$letezik=false;

$length = strlen($szerzo1);
if($length==0){
	echo 'Nem írtál be semmit!';
}else{
	
	$stid = oci_parse($conn, 'SELECT NEV FROM SZERZO');
	oci_execute($stid);
	
	while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		if($item==$szerzo1){
			$letezik=true;
		}
    }
}
if(!$letezik){
	
	
	$stid = oci_parse($conn, 'SELECT COUNT(*) FROM SZERZO');
	oci_execute($stid);
	
	
	while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		$maxid=$item;
    }
	}
	$maxid=$maxid+1;
	//AUTO_INCREMENT
	
	
	$stid = oci_parse($conn, "INSERT INTO SZERZO (SZERZO_ID, NEV) VALUES (".$maxid.", '".$szerzo1."')");
	oci_execute($stid);
}else{
	echo'Már létezik ilyen szerző!';
}
	
}




?>