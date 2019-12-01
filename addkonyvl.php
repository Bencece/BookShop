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
  <?php include 'menu.php';?>
  <div id="addkonyv">
<?php
include 'connection.php';

$stid = oci_parse($conn, 'SELECT COUNT(*) FROM KONYV');
	oci_execute($stid);
	
   
echo '    <form action="addkonyvql.php" enctype="multipart/form-data" method="post"> 
   <table width=600>  
   <tr><td>Könyv címe:</td>
 <td><input type="text" name="cim" value=""/></td></tr>  
   <tr><td>Kiadás éve:</td>
 <td><input type="text" name="ev" value=""/></td></tr>  
   <tr><td>Tömeg (g):</td>
 <td><input type="text" name="tomeg" value=""/></td></tr>  
   <tr><td>Oldalszám:</td>
 <td><input type="text" name="oldalszam" value=""/></td></tr>  
	<tr><td>Ár:</td>
 <td><input type="text" name="ar" value=""/></td></tr>  
   <tr><td>Leírás:</td>
 <td><input type="text" name="leiras" value=""/></td></tr>
   <tr><td>Nyelv:</td>
 <td><input type="text" name="nyelv" value=""/></td></tr>
	<tr><td>E-könyvként is kapható:</td>
 <td><input type="checkbox" name="ekonyv" value="value1"/></td></tr>
 ';
 echo '<tr><td>Kiadó:</td>';
 
echo '<td><select name="kiadoid">';
 
 $stid = oci_parse($conn, 'SELECT NEV FROM KONYVKIADO');
	oci_execute($stid);
 $szamlalo=1;
 while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		echo "<option value=".$szamlalo.">".$item."</option>";
		$szamlalo=$szamlalo+1;
    }
 }
echo '</select>

<a href="addkiadol.php">+</a>
</td></tr>';
 
 echo '<tr><td>Szerző:</td>';
 
echo '<td><select name="szerzoid">';
 
 $stid = oci_parse($conn, 'SELECT NEV FROM SZERZO');
	oci_execute($stid);
 $szamlalo=1;
 while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		echo "<option value=".$szamlalo.">".$item."</option>";
		$szamlalo=$szamlalo+1;
    }
 }
 
echo '</select>

<a href="addszerzol.php">+</a>
</td></tr>';
 
 
  
 echo '<tr><td>Műfaj:</td>';
 
echo '<td><select name="mufajid">';
 
 $stid = oci_parse($conn, 'SELECT NEV FROM MUFAJ');
	oci_execute($stid);
 $szamlalo=1;
 while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		echo "<option value=".$szamlalo.">".$item."</option>";
		$szamlalo=$szamlalo+1;
    }
 }
 
echo '</select>

<a href="addmufajl.php">+</a>
</td></tr>';
 
 
  
 echo '<tr><td>Alműfaj:</td>';
 
echo '<td><select name="almufajid">';
 
 $szamlalo=1;
 $stid = oci_parse($conn, 'SELECT MUFAJ.NEV FROM MUFAJ,ALMUFAJ WHERE MUFAJ.MUFAJ_ID=ALMUFAJ.MUFAJ_ID');
	oci_execute($stid);
 while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		$asd[$szamlalo]=$item;
		$szamlalo=$szamlalo+1;
    }
 }
 
 
 
 
 $stid = oci_parse($conn, 'SELECT NEV FROM ALMUFAJ');
	oci_execute($stid);
 $szamlalo=1;
 
 
 while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		
		

		echo "<option value=".$szamlalo.">".$asd[$szamlalo]." -> ".$item."</option>";
		$szamlalo=$szamlalo+1;
		
		
    }
 }
 
 
 
echo '</select>

<a href="addalmufajl.php">+</a>
</td></tr>';
 
echo'
<tr><td>
    Select image to upload:
    <input class="btn btn-dark" type="file" name="fileToUpload" id="fileToUpload"/>
</td></tr>
';
 
 echo'
   <tr><td><input class="btn btn-success" type="submit" value="Könyv hozzáadása" name="submit"/></td></tr>  
   </table>  
   </form>  
   
   ';

oci_close($conn);

?>
</div>
</div>
</body>
</html>