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
  <div  id="addkonyv">
<?php
include 'connection.php';
echo '    <form action="editselectedkonyvl.php" method="post"> ';
echo '<select name="konyvid">';
 
 $stid = oci_parse($conn, 'SELECT NEV FROM KONYV');
	oci_execute($stid);
 $szamlalo=1;
 while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
		echo "<option value=".$szamlalo.">".$item."</option>";
		$szamlalo=$szamlalo+1;
    }
 }
echo '</select></br>';
echo '<input class="btn btn-success" style="margin-top:10px" type="submit" value="Kiválasztott könyv szerkesztése" />';

echo '</form>';

?>
</div>
</div>
</body>
</html>