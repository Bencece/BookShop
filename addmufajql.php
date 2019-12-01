<?php

include 'connection.php';
$mufaj1=$_POST["mufaj"];
$letezik=false;

$length = strlen($mufaj1);
if($length==0){
	echo 'Nem írtál be semmit!';
}else{
	
	$stid = odbc_exec($conn, 'SELECT NEV FROM MUFAJ');
	
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		if($item==$mufaj1){
			$letezik=true;
		}
    }
}
if(!$letezik){
	
	
	$stid = odbc_exec($conn, 'SELECT COUNT(*) FROM MUFAJ');
	
	
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$maxid=$item;
    }
	}
	$maxid=$maxid+1;
	//AUTO_INCREMENT
	
	
	$stid = odbc_exec($conn, "INSERT INTO MUFAJ (MUFAJ_ID, NEV) VALUES (".$maxid.", '".$mufaj1."')");
	
}else{
	echo'Már létezik ilyen műfaj!';
}
	
}




?>