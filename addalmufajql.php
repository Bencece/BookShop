<?php

include 'connection.php';
$mufajid=$_POST["mufajid"];
$almufaj1=$_POST["almufaj"];
$letezik=false;

$length = strlen($almufaj1);
if($length==0){
	echo 'Nem írtál be semmit!';
}else{
	
	$stid = odbc_exec($conn, 'SELECT NEV FROM ALMUFAJ');
	
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		if($item==$almufaj1){
			$letezik=true;
		}
    }
}
if($letezik){
	
	$stid = odbc_exec($conn, "SELECT MUFAJ_ID FROM ALMUFAJ WHERE '".$almufaj1."'=NEV");
	
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		if($item<>$mufajid){
			$letezik=false;
		}
    }
}
	
}


if(!$letezik){
	
	
	$stid = odbc_exec($conn, 'SELECT COUNT(*) FROM ALMUFAJ');
	
	
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$maxid=$item;
    }
	}
	$maxid=$maxid+1;
	//AUTO_INCREMENT
	
	
	$stid = odbc_exec($conn, "INSERT INTO ALMUFAJ (ALMUFAJ_ID, MUFAJ_ID, NEV) VALUES (".$maxid.",".$mufajid." ,'".$almufaj1."')");
	
}else{
	echo'Már létezik ilyen műfaj!';
}
	
}




?>