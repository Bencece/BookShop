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
</head>
<body>
<div class="jumbotron col-sm-10 mx-auto" id="doboz">
  <div class="row">
    <h1 style="color:rgba(255,255,255,1.00); font-size:6vw">Könyvesbolt</h1>
  </div>
  <?php include 'menu.php';
   /*include 'kosarmegjelenites.php';
   include 'history.php';  */
   ?>
  <h3 class="mx-auto text-center" style="margin-top:30px; color:white; font-size:3vw"><?php if(isset($_COOKIE["felhasznalo"])){echo 'Üdvözölünk az oldalon, '.$_COOKIE["felhasznalo"].'!';}?></h3>
  <div class="row" id="kereso_doboz">
    <div class="col-sm-8">
      <p style="font-size:large">Könyvek széles választéka vár, naponta bővülő kínálattal. A legújabb siker könyvek és folyamatos akciók várnak, ha nálunk rendelsz. Rendelésed kérheted házhozszállítással, de akár személyesen is átveheted, szállítási költség nélkül. Böngézd át széles árukészletünket, itt megtalálod amit keresel. Könyv, zene, film egy helyen. Regisztrálj, jelentkezz be és máris kezdheted a vásárlást kényelmesen, otthonról vagy útközben mobilról.</p>
    </div>
    <div class="col-sm-4">
      <form class="form-inline" action="kereseseredmenye.php" method="post">
        <div class="row">
          <input class="form-control mr-sm-2" type="text" name="beirt" value=""/>
          <input class="btn btn-success" type="submit" value="Keresés" />
        </div>
        <div class="row">
          <div class="radio">
            <label>
              <input type="radio" name="ker" value="NEV" checked="true">
              Cím szerint</label>
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="ker" value="KIADAS">
              Kiadás éve szerint</label>
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="ker" value="SZERZO">
              Szerző szerint</label>
          </div>
        </div>
      </form>
      <!-- KÖNYV KERESÉSE SZERZŐ/KIADÁS/CÍM ALAPJÁN -->
      
      <form class="form-inline" action="kereseseredmenye.php" method="post">
        <div class="row">
          <input class="form-control mr-sm-2" type="text" name="beirt2" value=""/>
          <input class="btn btn-success" type="submit" value="Cím szerinti keresés" />
        </div>
        <div class="row">
          <div class="radio">
            <label>
              <input type="radio" name="ker2" value="ZENE" checked="true">
              Zenét</label>
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="ker2" value="FILM">
              Filmet</label>
          </div>
        </div>
      </form>
      <!-- //ZENE/FILM KERESÉSE CÍM ALAPJÁN --> 
    </div>
  </div>
  <div class="row" id="ujkonyvdoboz">
    <div class="container col-sm-6" style="padding:1% 1% 1% 1%">
      <h2>Legújabb könyveink:</h2>
      <div id="ujkonycarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <?php
include 'connection.php';	
	$osszkonyv;
	$stid = oci_parse($conn, 'SELECT COUNT(*) FROM KONYV');
	oci_execute($stid);
	while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		$osszkonyv=$item;
    }
	}
	$osszkonyv=$osszkonyv-3;
	$stid = oci_parse($conn, "SELECT KONYV_ID FROM KONYV WHERE KONYV_ID>'".$osszkonyv."'");
	oci_execute($stid);
	$tmp=true;
	while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		echo '<div class="carousel-item';
	   if($tmp==true){
		   echo ' active ';
		   $tmp=false;
		   }
	   echo'" align="center">
      <form action="konyvmegjelenites.php" method="post"> 
			<input type="hidden" name="konyv" value="'.$item.'"><input type="image" id="ujkonyv" src="pictures/konyv/'.$item.'.jpg"/></input>
		</form>
	  </div>
		';
    }
	}
	//LEGÚJABB KÖNYVEK
	?>
        </div>
        <a class="carousel-control-prev" href="#ujkonycarousel" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="carousel-control-next" href="#ujkonycarousel" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
    </div>
    <div class="container col-sm-6" style="padding:1% 1% 1% 1%">
      <h2>Válogass széles kínálatunkból:</h2>
      <div id="mufajok" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <?php
	include 'connection.php';	
	
	$szamlalo=1;
	while($szamlalo<$mufajosszdarab){
	
	$stid = oci_parse($conn, "SELECT KONYV_ID FROM KONYV WHERE MUFAJ_ID='".$szamlalo."'");
	oci_execute($stid);
	while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		$egykonyv[$szamlalo]=$item;
    }
	}
		$szamlalo=$szamlalo+1;
	}
	$szamlalo=1;
	$tmp=true;
	while($szamlalo<$mufajosszdarab){
	echo '<div class="carousel-item';
	   if($tmp==true){
		   echo ' active ';
		   $tmp=false;
		   }
	   echo'" align="center">
      <form action="konyvmegjelenites.php" method="post"> 
			<input type="hidden" name="konyv" value="'.$egykonyv[$szamlalo].'"><input type="image" id="ujkonyv" src="pictures/konyv/'.$egykonyv[$szamlalo].'.jpg"/></input>
		</form>
	  </div>
	';
		$szamlalo=$szamlalo+1;
	}//MŰFAJONKÉNT EGY KÖNYV
	?>
        </div>
        <a class="carousel-control-prev" href="#mufajok" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="carousel-control-next" href="#mufajok" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
    </div>
  </div>

</div>
<div class="jumbotron col-sm-10 text-center mx-auto" id="doboz">
  <p>SZTE TTIK Adatbázis alapú rendszerek<br/>beadandó feladat<br/>Készítették:<br/>Jacsek Dániel István<br/>Kocsor Levente Ferenc<br/>Zahorán Bence</p>
</div>
</body>
</html>