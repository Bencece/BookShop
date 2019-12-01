<?php
$szamlalo=1;
while($szamlalo<$_COOKIE["hany"]){
	setcookie("hany".$szamlalo."", null, -1);
	$szamlalo=$szamlalo+1;
}
setcookie("hany", null, -1);
if(isset($_GET["kosartorol"])){
	header('Location: index.php?kosar=true');
	}else{
	header('Location: index.php');
	}
?>