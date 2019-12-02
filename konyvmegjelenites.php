<!doctype html>
<html lang="hu">
<head>
<meta charset="utf-8">
<title>Könyvesbolt</title>
<link rel="stylesheet" href="style.css"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="jumbotron col-sm-10 mx-auto" id="doboz">
  <div class="row">
    <h1 style="color:rgba(255,255,255,1.00); font-size:6vw">Könyvesbolt</h1>
  </div>
  <?php
include 'connection.php';
include 'menu.php';
$id=$_POST["konyv"];

$scuccok;   

   $stid = odbc_exec($conn, "SELECT NEV,KIADAS,TOMEG,OLDALSZAM,AR,LEIRAS,NYELV,EKONYVE,KIADO_ID,SZERZO_ID,MUFAJ_ID,ALMUFAJ_ID FROM KONYV WHERE KONYV_ID=".$id."");
	
 $szamlalo=1;
 while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$scuccok[$szamlalo]=$item;
		$szamlalo=$szamlalo+1;
    }
 }


if($scuccok[8]==1){
	$scuccok[8]='Igen';
}else{
	$scuccok[8]='Nem';
}

   $stid = odbc_exec($conn, "SELECT NEV FROM SZERZO WHERE SZERZO_ID=".$scuccok[10]."");
	
 while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$szerzonev=$item;
    }
 }

  $stid = odbc_exec($conn, "SELECT NEV FROM KONYVKIADO WHERE KIADO_ID=".$scuccok[9]."");
	
 while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$kiadonev=$item;
    }
 }
 
 $stid = odbc_exec($conn, "SELECT NEV FROM MUFAJ WHERE MUFAJ_ID=".$scuccok[11]."");
	
 while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$mufajnev=$item;
    }
 }
 $stid = odbc_exec($conn, "SELECT NEV FROM ALMUFAJ WHERE ALMUFAJ_ID=".$scuccok[12]."");
	
 while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$almufajnev=$item;
    }
 }

 echo'
 
 ';

echo'
<div id="konyvmegj_doboz">
 <form action="kereseseredmenye.php" method="post">
 	<h2><button type="submit" name="mufaj" id="mufajgomb" value="'.$scuccok[11].'">'.$mufajnev.'</button> -> '.$almufajnev.'</h2>
 </form>
<div class="row">
	<div class="col-sm-3">
		<img src="pictures/konyv/'.$id.'.jpg" id="konyvmegj" width="100%"/>
    </div>
    <div class="col-sm-9">
	<h1 style="color:white">'.$scuccok[1].'</h1>
	<h2>'.$szerzonev.'</h2>
	<p>'.$scuccok[6].'</p>
    </div>
</div>
<div class="row">
	<div class="col-sm-3">
	<table class="table table-striped table-bordered">
    <tbody>
      <tr>
        <td>Ár:</td>
        <td>'.$scuccok[5].'Ft</td>
      </tr>
      <tr>
        <td>Kiadás éve:</td>
        <td>'.$scuccok[2].'</td>
      </tr>
      <tr>
        <td>Tömeg:</td>
        <td>'.$scuccok[3].'</td>
      </tr>
	  <tr>
        <td>Oldalszám:</td>
        <td>'.$scuccok[4].'</td>
      </tr>
	  <tr>
        <td>Nyelv:</td>
        <td>'.$scuccok[7].'</td>
      </tr>
	  <tr>
        <td>E-könyv:</td>
        <td>'.$scuccok[8].'</td>
      </tr>
	  <tr>
        <td>Kiadó:</td>
        <td>'.$kiadonev.'</td>
      </tr>
    </tbody>
  </table>
	</div>
	<div class="col-sm-9">
		<div class="container" id="vasaroldmeg">
		<h2>Vásárold meg most, kedvező áron!</h2>
		';
		$draga=300+$scuccok[5];
		echo'
		<h4><del>'.$draga.'Ft</del> helyett</h4>
		<h2>Ár: '.$scuccok[5].'Ft</h2>
		';
		if(isset($_COOKIE["felhasznalo"])){
		echo '<form action="rendelesl.php" method="post">';
	echo '<button class="btn" type="submit" value='.$id.' name="konyvid"><span class="navbar-toggler-icon"><img src="pictures/kosar.png" width="100%"/></span> Kosárba</button>';
	echo '</form>
	';
	}
	$stid = odbc_exec($conn, "SELECT ITEM.ITEM_ID FROM ITEM, KONYV WHERE ITEM.KONYV_ID=KONYV.KONYV_ID AND KONYV.KONYV_ID=".$id."");
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$itemid=$item;
    }
	}
if(isset($itemid)){
$stid = odbc_exec($conn, "SELECT KONYV.KONYV_ID FROM KONYV,ITEM,FELHASZNALO,VASAROLT WHERE KONYV.KONYV_ID=ITEM.KONYV_ID AND ITEM.ITEM_ID=VASAROLT.ITEM_ID AND FELHASZNALO.FELHASZNALO_ID=VASAROLT.FELHASZNALO_ID AND VASAROLT.FELHASZNALO_ID=(SELECT TOP 1 VASAROLT.FELHASZNALO_ID FROM VASAROLT WHERE VASAROLT.ITEM_ID=".$itemid.")");
	
	$tmp=true;
	$tmp2=true;
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		if($tmp==true){
			echo '<h2>Ezek is érdekelni fognak:</h2>
      			<div id="tetszenek" class="carousel slide" data-ride="carousel">
        			<div class="carousel-inner">';
			$tmp=false;
			}
		echo '<div class="carousel-item';
	   if($tmp2==true){
		   echo ' active ';
		   $tmp2=false;
		   }
	   echo'" align="center">';
		echo '
		<form action="konyvmegjelenites.php" method="post"> 
			<input type="hidden" name="konyv" value="'.$item.'"><input type="image" id="konyvmegj" src="pictures/konyv/'.$item.'.jpg" width="30%"/></input>
		</form>
		</div>
		';//Itt van az ID-je a könyveknek 
    }
	}
		echo'</div>
<!--a class="carousel-control-prev" href="#tetszenek" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="carousel-control-next" href="#tetszenek" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a -->
				</div>';
}
	echo'					
		</div>
	</div>	
</div>
';
if(isset($_GET["kosar"]) && $_GET["kosar"]==true){
	echo" <script>$(document).ready(function(){        
   $('#kosar').modal('show');
    }); </script>";
	}
?>
</div>

<div class="modal fade" id="kosar" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row"> <img src="pictures/kosar.png" width="10%"/>
          <h4 class="modal-title" style="margin-left:3%">A kosarad</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
      </div>
      <div class="modal-body">
        <?php include 'kosarmegjelenites.php'; ?>
      </div>
      <div class="modal-footer">
      <form action="konyvmegjelenites.php" method="get" style="float:right">
        <input type="hidden" name="kosar" value="false"><button type="button" class="btn btn-default" data-dismiss="modal">OK</button></input>
        </form>
      </div>
    </div>
  </div>
</div>

</body>
</html>