<?php

include 'connection.php';
$kiado1=$_POST["kiado"];
$letezik=false;

$length = strlen($kiado1);
if($length==0){
	echo 'Nem írtál be semmit!';
}else{
	
	$stid = odbc_exec($conn, 'SELECT NEV FROM KONYVKIADO');
	
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		if($item==$kiado1){
			$letezik=true;
		}
    }
}
if(!$letezik){
	
	
	$stid = odbc_exec($conn, 'SELECT COUNT(*) FROM KONYVKIADO');
	
	
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$maxid=$item;
    }
	}
	$maxid=$maxid+1;
	//AUTO_INCREMENT
	
	
	$stid = odbc_exec($conn, "INSERT INTO KONYVKIADO (KIADO_ID, NEV) VALUES (".$maxid.", '".$kiado1."')");
	
}else{
	echo'Már létezik ilyen kiadó!';
}
	
}


?>
