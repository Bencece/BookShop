<?php
echo 'Ön már ezeket a termékeket megrendelte:</br>';
include 'connection.php';
$szamlalo=1;


$stid = oci_parse($conn, "SELECT HISTORY.ITEM_ID FROM HISTORY,FELHASZNALO WHERE HISTORY.FELHASZNALO_ID=FELHASZNALO.FELHASZNALO_ID AND FELHASZNALO.FELHASZNALONEV='".$_COOKIE["felhasznalo"]."'");
oci_execute($stid);

while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		$itemek[$szamlalo]=$item;
		$szamlalo++;
    }
	}
	$max=$szamlalo;
$szamlalo=1;
	
	while($szamlalo<$max){
$stid = oci_parse($conn, "SELECT KONYV.NEV FROM KONYV,ITEM WHERE KONYV.KONYV_ID=ITEM.KONYV_ID AND ITEM.ITEM_ID=".$itemek[$szamlalo]."");
	oci_execute($stid);

	while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		echo $item.'</br>';
    }
	}
	$stid = oci_parse($conn, "SELECT ZENE.NEV FROM ZENE,ITEM WHERE ZENE.ZENE_ID=ITEM.ZENE_ID AND ITEM.ITEM_ID=".$itemek[$szamlalo]."");
	oci_execute($stid);
	while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		echo $item.'</br>';
    }
	}
	$stid = oci_parse($conn, "SELECT FILM.NEV FROM FILM,ITEM WHERE FILM.FILM_ID=ITEM.FILM_ID AND ITEM.ITEM_ID=".$itemek[$szamlalo]."");
	oci_execute($stid);
	while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		echo $item.'</br>';
    }
	}
	$szamlalo++;
	}
?>