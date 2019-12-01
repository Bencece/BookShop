<?php

include 'connection.php';
$id=$_POST["konyvid"];
$konyvnev;
$redundancia=substr($id, -1);
if($redundancia=="f" OR $redundancia=="z"){
$id=substr_replace($id, "", -1);
}
if($redundancia=="z"){
	$stid = odbc_exec($conn, "SELECT ITEM.ITEM_ID FROM ITEM WHERE ITEM.ZENE_ID=".$id."");
	
}elseif($redundancia=="f"){
	$stid = odbc_exec($conn, "SELECT ITEM.ITEM_ID FROM ITEM WHERE ITEM.FILM_ID=".$id."");
	
}else{
	$stid = odbc_exec($conn, "SELECT ITEM.ITEM_ID FROM ITEM WHERE ITEM.KONYV_ID=".$id."");

}
	
 while ( $row = odbc_fetch_array($stid)) {
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