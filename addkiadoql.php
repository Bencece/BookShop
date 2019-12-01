<?php

include 'connection.php';
$kiado1=$_POST["kiado"];
$letezik=false;

$length = strlen($kiado1);
if($length==0){
	echo 'Nem írtál be semmit!';
}else{
	
	$stid = oci_parse($conn, 'SELECT NEV FROM KONYVKIADO');
	oci_execute($stid);
	
	while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		if($item==$kiado1){
			$letezik=true;
		}
    }
}
if(!$letezik){
	
	
	$stid = oci_parse($conn, 'SELECT COUNT(*) FROM KONYVKIADO');
	oci_execute($stid);
	
	
	while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		$maxid=$item;
    }
	}
	$maxid=$maxid+1;
	//AUTO_INCREMENT
	
	
	$stid = oci_parse($conn, "INSERT INTO KONYVKIADO (KIADO_ID, NEV) VALUES (".$maxid.", '".$kiado1."')");
	oci_execute($stid);
}else{
	echo'Már létezik ilyen kiadó!';
}
	
}


?>
