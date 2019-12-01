<?php

include 'connection.php';
$szerzo1=$_POST["szerzo"];
$letezik=false;

$length = strlen($szerzo1);
if($length==0){
	echo 'Nem írtál be semmit!';
}else{
	
	$stid = odbc_exec($conn, 'SELECT NEV FROM SZERZO');
	
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		if($item==$szerzo1){
			$letezik=true;
		}
    }
}
if(!$letezik){
	
	
	$stid = odbc_exec($conn, 'SELECT COUNT(*) FROM SZERZO');
	
	
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$maxid=$item;
    }
	}
	$maxid=$maxid+1;
	//AUTO_INCREMENT
	
	
	$stid = odbc_exec($conn, "INSERT INTO SZERZO (SZERZO_ID, NEV) VALUES (".$maxid.", '".$szerzo1."')");
	
}else{
	echo'Már létezik ilyen szerző!';
}
	
}




?>