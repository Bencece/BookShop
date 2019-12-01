
<nav class="navbar navbar-expand-sm feher"> 
  <button class="navbar-toggler" type="button" data-toggle="collapse"  style="background-color:rgba(255,255,255,0.2)" data-target="#collapsibleNavbar"> <span class="navbar-toggler-icon"><img src="pictures/menu.png" width="100%"/></span> </button>
  <!-- Links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
  <ul class="navbar-nav">
    <li class="nav-item"> <a class="nav-link" href="index.php">Főoldal</a> </li>
    
    <!-- Dropdown -->
    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Műfajok</a>
      <div class="dropdown-menu">
        <form action="kereseseredmenye.php" method="post">
          <?php
include 'connection.php';
$mufajnevektomb;
$mufajosszdarab;

$szamlalo=1;
$stid = odbc_exec($conn, 'SELECT NEV FROM MUFAJ');
	
	
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$mufajnevektomb[$szamlalo]=$item;
		$szamlalo=$szamlalo+1;
    }
	}
	
$mufajosszdarab=$szamlalo;	
$szamlalo=1;

while($szamlalo<$mufajosszdarab){
$stid = odbc_exec($conn, "SELECT COUNT(*) FROM KONYV, MUFAJ WHERE KONYV.MUFAJ_ID=MUFAJ.MUFAJ_ID AND MUFAJ.NEV='".$mufajnevektomb[$szamlalo]."'");
	
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$mufajdarab[$szamlalo]=$item;
    }
	}
	$szamlalo=$szamlalo+1;
}
	$szamlalo=1;
	echo'';
	while($szamlalo<$mufajosszdarab){
		echo '<button class="dropdown-item" type="submit" name="mufaj" value="'.$szamlalo.'" class="btn-link">'.$mufajnevektomb[$szamlalo].'   ('.$mufajdarab[$szamlalo].')</button>';
		$szamlalo=$szamlalo+1;
	 // ITT VAN A KIÍRÁSA A MŰFAJOKNAK
	}
      ?>
        </form>
      </div>
    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Szerzők</a>
      <div class="dropdown-menu">
        <form action="kereseseredmenye.php" method="post">
          <?php
include 'connection.php';
$szerzonevektomb;
$szerzoosszdarab;

$szamlalo=1;
$stid = odbc_exec($conn, 'SELECT NEV FROM SZERZO');
	
	
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$szerzonevektomb[$szamlalo]=$item;
		$szamlalo=$szamlalo+1;
    }
	}
	
$szerzoosszdarab=$szamlalo;	
$szamlalo=1;

while($szamlalo<$szerzoosszdarab){
$stid = odbc_exec($conn, "SELECT COUNT(*) FROM KONYV, SZERZO WHERE KONYV.SZERZO_ID=SZERZO.SZERZO_ID AND SZERZO.NEV='".$szerzonevektomb[$szamlalo]."'");
	
	
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$szerzodarab[$szamlalo]=$item;
    }
	}
	$szamlalo=$szamlalo+1;
}
	$szamlalo=1;
	while($szamlalo<$szerzoosszdarab){
		echo '<button class="dropdown-item" style="margin-bottom:-20px" type="submit" name="szerzonev" value="'.$szamlalo.'" class="btn-link">'.$szerzonevektomb[$szamlalo].'   ('.$szerzodarab[$szamlalo].')</button>';
		$szamlalo=$szamlalo+1;
		echo '</br>';// ITT VAN A KIÍRÁSA A SZERZŐKNEK
	}
	
	
?>
        </form>
      </div>
    </li>
    <?php 
	if(!isset($_COOKIE["felhasznalo"])){		
    echo '<li class="nav-item"><a class="nav-link" data-toggle="modal" data-target="#be" href="#">Bejelentkezés</a></li>';
	echo '<li class="nav-item"><a class="nav-link" data-toggle="modal" data-target="#reg" href="#">Regisztráció</a></li>';
	}else{
	$stid = odbc_exec($conn, "SELECT ADMINE FROM FELHASZNALO WHERE FELHASZNALONEV='".$_COOKIE["felhasznalo"]."'");
	
	$admine=0;
	while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$admine=$item;
    }
	}
	if($admine==1){
		echo '<li class="nav-item"><a class="nav-link" href="addkonyvl.php">Új könyv felvétele</a></li>
		<li class="nav-item"><a class="nav-link" href="editkonyvl.php">Meglévő könyv szerkesztése</a></li>';
	}
	echo '<form action="bejelentkezesql.php" method="post">';
	echo '<li class="nav-item navbar-right"><button class="nav-link" type="submit" id="kilep">Kijelentkezés</button></li>';
	echo '</form>  ';

	echo '<form action="index.php" method="get" style="float:right">';
	echo '<button class="btn"><span class="navbar-toggler-icon"><input type="hidden" name="kosar" value="true"><img src="pictures/kosar.png" width="100%"/></span>Kosár</input></button>';
	echo '</form>';
		}
	?>
    </ul>
  </div>
</nav>
<div id="be" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Bejelentkezés</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <?php include 'bejelentkezesl.php'; ?>
      </div>
    </div>
  </div>
</div>
<div id="reg" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Regisztráció</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <?php include 'regl.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php
if(isset($_GET["sikeresreg"]) && $_GET["sikeresreg"]==true){
	echo" <script>$(document).ready(function(){        
   $('#sikeresreg').modal('show');
    }); </script>";
	}
	if(isset($_GET["sikeresbej"]) && $_GET["sikeresbej"]==true){
	echo" <script>$(document).ready(function(){        
   $('#sikeresbej').modal('show');
    }); </script>";
	}
	if(isset($_GET["sikereski"]) && $_GET["sikereski"]==true){
	echo" <script>$(document).ready(function(){        
   $('#sikereski').modal('show');
    }); </script>";
	}
	if(isset($_GET["kosar"]) && $_GET["kosar"]==true){
	echo" <script>$(document).ready(function(){        
   $('#kosar').modal('show');
    }); </script>";
	}
	if(isset($_GET["sikeres"])){
	echo" <script>$(document).ready(function(){        
   $('#rendeles').modal('show');
    }); </script>";
	}
	if(isset($_GET["hiba"])){
	echo" <script>$(document).ready(function(){        
   $('#hiba').modal('show');
    }); </script>";
	}
?>
<div class="modal fade" id="sikeresreg" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <div class="row"> <img src="pictures/ok.png" width="10%"/>
      <h4 class="modal-title" style="margin-left:3%">Sikeres regisztráció!</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
  </div>
  <div class="modal-body">
    <p>Üdvözölünk az oldalon!<br/>
      A menüsoron található 'Bejelentkezés' választásával be is léphetsz!</p>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
  </div>
</div>
</div>
</div>

<div class="modal fade" id="sikeresbej" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row"> <img src="pictures/ok.png" width="10%"/>
          <h4 class="modal-title" style="margin-left:3%">Sikeres Bejelentkezés!</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
      </div>
      <div class="modal-body">
        <p>
          <?php if(isset($_COOKIE["felhasznalo"])){echo 'Örülünk, hogy újra itt jársz, '.$_COOKIE["felhasznalo"].'!';}?>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="sikereski" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row"> <img src="pictures/ok.png" width="10%"/>
          <h4 class="modal-title" style="margin-left:3%">Sikeres Kijelentkezés!</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
      </div>
      <div class="modal-body">
        <p>
          Várunk vissza!
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
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
      <form action="index.php" method="get" style="float:right">
        <input type="hidden" name="kosar" value="false"><button type="button" class="btn btn-default" data-dismiss="modal">OK</button></input>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="rendeles" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row"> <img src="pictures/kosar.png" width="10%"/>
          <h4 class="modal-title" style="margin-left:3%">Rendelés információ</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
      </div>
      <div class="modal-body">
        <?php if(isset($_GET["sikeres"]) && $_GET["sikeres"]==true){
			echo '<img src="pictures/ok.png" width="10%"/> A rendelésed sikeresen feldolgoztuk!';
			}
			if(isset($_GET["sikeres"]) && $_GET["sikeres"]==false){
			echo '<img src="pictures/hiba.png" width="10%"/>Sajnos a rendelésben hiba lépett fel! Kérjük próbáld újra később!';
			}
			?>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="hiba" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row"> <img src="pictures/hiba.png" width="10%"/>
          <h4 class="modal-title" style="margin-left:3%">Hiba történt!</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
      </div>
      <div class="modal-body">
        <?php if($_GET["hiba"]=="nincsjszo"){
			echo 'Nem írtál be jelszót!';
			}
			if($_GET["hiba"]=="nincsfnev"){
			echo 'Nem írtál be felhasználónevet!';
			}
			if($_GET["hiba"]=="fnev"){
			echo 'Hibás felhasználónév!';
			}
			if($_GET["hiba"]=="jszo"){
			echo 'Hibás jelszó!';
			}
			if($_GET["hiba"]=="regemail"){
			echo 'Kérlek add meg az e-mail címed!';
			}
			if($_GET["hiba"]=="regemailformat"){
			echo 'Nem megfelelő formában adtad meg az e-mail címed!';
			}
			if($_GET["hiba"]=="regjszo"){
			echo 'Kérlek adj meg egy jelszót!!';
			}
			if($_GET["hiba"]=="regjszoformat"){
			echo 'Hibás jelszó formátum! <br/> Kérlek olyan jelszót adj meg, amiben szerepel nagybatű, kisbetű és szám is!';
			}
			if($_GET["hiba"]=="reg"){
			echo 'Ajaj! Valami hiba lépett fel a regisztráció során!';
			}
			?>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>