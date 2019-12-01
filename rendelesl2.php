<?php
$id=$_POST["konyvid"];
$rend=$_POST["ren"];
include 'connection.php';
$jo=0;
if($rend=='kisz'){
	
	$stid = odbc_exec($conn, 'SELECT COUNT(*) FROM VASAROLT');
	
	
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$maxid=$item;
    }
	}
	$maxid=$maxid+1;//AUTO_INCREMENT
	$szamlalo=1;
	$felhasznalo;
	$stid = odbc_exec($conn, "SELECT FELHASZNALO_ID,LAKCIM FROM FELHASZNALO WHERE FELHASZNALONEV='".$_COOKIE["felhasznalo"]."'");
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$felhasznalo[$szamlalo]=$item;
		$szamlalo=$szamlalo+1;
    }
	}

	$szamlalo=1;
	while($szamlalo<=$_COOKIE["hany"]){
	$id=$_COOKIE["hany".$szamlalo.""];
	$stid=odbc_exec($conn, "UPDATE FELHASZNALO SET IDAIGVASAROLT=IDAIGVASAROLT+1 WHERE FELHASZNALO_ID=".$felhasznalo[1]."");
	$asd=
	$stid = odbc_exec($conn, "INSERT INTO VASAROLT (VASARLASID, FELHASZNALO_ID, ITEM_ID, ARUHAZ_ID, KISZALLITASICIM, BOLTBANVESZIAT) VALUES
(".$maxid.", '".$felhasznalo[1]."', '".$id."', 0, '".$felhasznalo[2]."', 0)");
$szamlalo++;
$maxid++;
$siker=
$stid=odbc_exec($conn, "INSERT INTO HISTORY(FELHASZNALO_ID, ITEM_ID) VALUES ('".$felhasznalo[1]."','".$id."')");

	}
if($siker){
	echo 'Rendelését sikeresen feldolgoztuk!</br>
	 <button><a href="resetasd.php">Vissza a főoldalra</a></button>';
}else{
	echo 'Valamiért nem lehetett rendelni!</br>
	 <button><a href="resetasd.php">Vissza a főoldalra</a></button>';
}

}elseif($rend=="szem"){
	$szamlalo=1;
	while($szamlalo<=$_COOKIE["hany"]){
	$stid = odbc_exec($conn, "SELECT KESZLETENVAN FROM KAPHATO WHERE ITEM_ID='".$_COOKIE["hany".$szamlalo.""]."' AND ARUHAZ_ID=".$_POST["aruhazid"]."");
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$darabszam[$szamlalo]=$item;
    }
	}
	$szamlalo++;
	}
	
	
	$stid = odbc_exec($conn, 'SELECT COUNT(*) FROM VASAROLT');
	
	
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$maxid=$item;
    }
	}
	$maxid=$maxid+1;//AUTO_INCREMENT
	$szamlalo=1;
	$felhasznalo;
	$stid = odbc_exec($conn, "SELECT FELHASZNALO_ID,LAKCIM FROM FELHASZNALO WHERE FELHASZNALONEV='".$_COOKIE["felhasznalo"]."'");
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$felhasznalo[$szamlalo]=$item;
		$szamlalo=$szamlalo+1;
    }
	}
	$szamlalo=1;
	while($szamlalo<=$_COOKIE["hany"]){
	$id=$_COOKIE["hany".$szamlalo.""];
		$stid = odbc_exec($conn, "SELECT KESZLETENVAN FROM KAPHATO WHERE ARUHAZ_ID=".$_POST["aruhazid"]." AND ITEM_ID=".$id."");


while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$keszletenennyivan=$item;
    }
	}
		if($keszletenennyivan>0){
		
	$id=$_COOKIE["hany".$szamlalo.""];
	$stid=odbc_exec($conn, "UPDATE FELHASZNALO SET IDAIGVASAROLT=IDAIGVASAROLT+1 WHERE FELHASZNALO_ID=".$felhasznalo[1]."");
	$asd=
	$stid = odbc_exec($conn, "INSERT INTO VASAROLT (VASARLASID, FELHASZNALO_ID, ITEM_ID, ARUHAZ_ID, KISZALLITASICIM, BOLTBANVESZIAT) VALUES
(".$maxid.", '".$felhasznalo[1]."', '".$id."', ".$_POST["aruhazid"].", '0', 1)");
$maxid++;
$siker=
$stid=odbc_exec($conn, "INSERT INTO HISTORY(FELHASZNALO_ID, ITEM_ID) VALUES ('".$felhasznalo[1]."','".$id."')");



$stid=odbc_exec($conn, "UPDATE KAPHATO SET KESZLETENVAN=KESZLETENVAN-1 WHERE ARUHAZ_ID=".$_POST["aruhazid"]." AND ITEM_ID=".$id."");

$jo++;
		}else{
		echo 'Ebből a tárgyból nincs több ';
	$stid = odbc_exec($conn, "SELECT KONYV.NEV FROM KONYV,ITEM WHERE KONYV.KONYV_ID=ITEM.KONYV_ID AND ITEM.ITEM_ID=".$_COOKIE["hany".$szamlalo.""]."");
	

	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		echo $item;
    }
	}
	$stid = odbc_exec($conn, "SELECT ZENE.NEV FROM ZENE,ITEM WHERE ZENE.ZENE_ID=ITEM.ZENE_ID AND ITEM.ITEM_ID=".$_COOKIE["hany".$szamlalo.""]."");
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		echo $item;
    }
	}
	$stid = odbc_exec($conn, "SELECT FILM.NEV FROM FILM,ITEM WHERE FILM.FILM_ID=ITEM.FILM_ID AND ITEM.ITEM_ID=".$_COOKIE["hany".$szamlalo.""]."");
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		echo $item;
    }
	}
		echo ' ebben az áruházban: ';
		
	$stid = odbc_exec($conn, "SELECT NEV FROM ARUHAZ WHERE ARUHAZ_ID=".$_POST["aruhazid"]."");
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		echo $item.'</br>';
    }
	}
		
		
		}
		$siker=false;
		$szamlalo++;
	}
if($jo>0 OR $siker){
	header("Location: index.php?sikeres=true");
}else{
	header("Location: index.php?sikeres=false");
}
	
	
	
	
}


?>