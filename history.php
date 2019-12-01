<?php
echo 'Ön már ezeket a termékeket megrendelte:</br>';
include 'connection.php';
$szamlalo=1;


$stid = odbc_exec($conn, "SELECT HISTORY.ITEM_ID FROM HISTORY,FELHASZNALO WHERE HISTORY.FELHASZNALO_ID=FELHASZNALO.FELHASZNALO_ID AND FELHASZNALO.FELHASZNALONEV='".$_COOKIE["felhasznalo"]."'");


while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$itemek[$szamlalo]=$item;
		$szamlalo++;
    }
	}
	$max=$szamlalo;
$szamlalo=1;
	
	while($szamlalo<$max){
$stid = odbc_exec($conn, "SELECT KONYV.NEV FROM KONYV,ITEM WHERE KONYV.KONYV_ID=ITEM.KONYV_ID AND ITEM.ITEM_ID=".$itemek[$szamlalo]."");
	

	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		echo $item.'</br>';
    }
	}
	$stid = odbc_exec($conn, "SELECT ZENE.NEV FROM ZENE,ITEM WHERE ZENE.ZENE_ID=ITEM.ZENE_ID AND ITEM.ITEM_ID=".$itemek[$szamlalo]."");
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		echo $item.'</br>';
    }
	}
	$stid = odbc_exec($conn, "SELECT FILM.NEV FROM FILM,ITEM WHERE FILM.FILM_ID=ITEM.FILM_ID AND ITEM.ITEM_ID=".$itemek[$szamlalo]."");
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		echo $item.'</br>';
    }
	}
	$szamlalo++;
	}
?>