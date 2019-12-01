<?php

include 'connection.php';
$id=$_POST["konyvid"];
$konyvnev;
$redundancia=substr($id, -1);
if($redundancia=="f" OR $redundancia=="z"){
$id=substr_replace($id, "", -1);
}
if($redundancia=="z"){
	$stid = oci_parse($conn, "SELECT ITEM.ITEM_ID FROM ITEM WHERE ITEM.ZENE_ID=".$id."");
	
}elseif($redundancia=="f"){
	$stid = oci_parse($conn, "SELECT ITEM.ITEM_ID FROM ITEM WHERE ITEM.FILM_ID=".$id."");
	
}else{
	$stid = oci_parse($conn, "SELECT ITEM.ITEM_ID FROM ITEM WHERE ITEM.KONYV_ID=".$id."");

}
	oci_execute($stid);
 while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		$itemid=$item;
    }
 }
if(!isset($_COOKIE["hany"])){
setcookie("hany", 0);
}
$szam=$_COOKIE["hany"]+1;
setcookie("hany", $szam);
setcookie("hany".$szam."", $itemid);
header('Location: index.php?kosar=true');
?>