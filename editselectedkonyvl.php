<?php
include 'connection.php';

$snev;
$sev;
$stomeg;
$soldalszam;
$sar;
$sleiras;
$snyelv;
$sek;
$skiadoid;
$sszerzoid;
$smufajid;
$salmufajid;
   
$scuccok;   

   $stid = odbc_exec($conn, "SELECT NEV,KIADAS,TOMEG,OLDALSZAM,AR,LEIRAS,NYELV,EKONYVE,KIADO_ID,SZERZO_ID,MUFAJ_ID,ALMUFAJ_ID FROM KONYV WHERE KONYV_ID=".$_POST["konyvid"]."");
	
 $szamlalo=1;
 while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$scuccok[$szamlalo]=$item;
		$szamlalo=$szamlalo+1;
    }
 }
  
   
   
   
   
   
   
   
echo '    <form action="editselectedkonyvql.php" method="post"> 
   <table width=700>  
   <tr><td>Könyv címe:</td>
 <td><input type="text" size=60 name="cim" value="'.$scuccok[1].'"/></td></tr>  
   <tr><td>Kiadás éve:</td>
 <td><input type="text" name="ev" value="'.$scuccok[2].'"/></td></tr>  
   <tr><td>Tömeg (g):</td>
 <td><input type="text" name="tomeg" value="'.$scuccok[3].'"/></td></tr>  
   <tr><td>Oldalszám:</td>
 <td><input type="text" name="oldalszam" value="'.$scuccok[4].'"/></td></tr>  
	<tr><td>Ár:</td>
 <td><input type="text" name="ar" value="'.$scuccok[5].'"/></td></tr>  
   <tr><td>Leírás:</td>
 <td><input type="text" size=150 name="leiras" value="'.$scuccok[6].'"/></td></tr>
   <tr><td>Nyelv:</td>
 <td><input type="text" name="nyelv" value="'.$scuccok[7].'"/></td></tr>
	<tr><td>E-könyvként is kapható:</td>
	';
	if($scuccok[8]==1){
		echo'<td><input type="checkbox" checked=true name="ekonyv" value="value1"/></td></tr>';
	}else{
 echo '<td><input type="checkbox" name="ekonyv" value="value1"/></td></tr>';
	}
 
 echo '<tr><td>Kiadó:</td>';
 
echo '<td><select name="kiadoid">';
 
 $stid = odbc_exec($conn, 'SELECT NEV FROM KONYVKIADO');
	
 $szamlalo=1;
 while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		
		if($szamlalo==$scuccok[9]){
		echo "<option value=".$szamlalo." selected>".$item."</option>";
		}else{
		echo "<option value=".$szamlalo.">".$item."</option>";
		}
		$szamlalo=$szamlalo+1;
    }
 }
echo '</select>

<a href="addkiadol.php">+</a>
</td></tr>';
 
 echo '<tr><td>Szerző:</td>';
 
echo '<td><select name="szerzoid">';
 
 $stid = odbc_exec($conn, 'SELECT NEV FROM SZERZO');
	
 $szamlalo=1;
 while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		
		if($szamlalo==$scuccok[10]){
		echo "<option value=".$szamlalo." selected>".$item."</option>";
		}else{
		echo "<option value=".$szamlalo.">".$item."</option>";
		}
		$szamlalo=$szamlalo+1;
    }
 }
 
echo '</select>

<a href="addszerzol.php">+</a>
</td></tr>';
 
 
  
 echo '<tr><td>Műfaj:</td>';
 
echo '<td><select name="mufajid">';
 
 $stid = odbc_exec($conn, 'SELECT NEV FROM MUFAJ');
	
 $szamlalo=1;
 while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		
		if($szamlalo==$scuccok[11]){
		echo "<option value=".$szamlalo." selected>".$item."</option>";
		}else{
		echo "<option value=".$szamlalo.">".$item."</option>";
		}
		
		$szamlalo=$szamlalo+1;
    }
 }
 
echo '</select>

<a href="addmufajl.php">+</a>
</td></tr>';
 
 
  
 echo '<tr><td>Alműfaj:</td>';
 
echo '<td><select name="almufajid">';
 
 $szamlalo=1;
 $stid = odbc_exec($conn, 'SELECT MUFAJ.NEV FROM MUFAJ,ALMUFAJ WHERE MUFAJ.MUFAJ_ID=ALMUFAJ.MUFAJ_ID');
	
 while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		$asd[$szamlalo]=$item;
		$szamlalo=$szamlalo+1;
    }
 }
 
 
 
 
 $stid = odbc_exec($conn, 'SELECT NEV FROM ALMUFAJ');
	
 $szamlalo=1;
 
 
 while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		
		if($szamlalo==$scuccok[12]){
		echo "<option value=".$szamlalo." selected>".$asd[$szamlalo]." -> ".$item."</option>";
		}else{
		echo "<option value=".$szamlalo.">".$asd[$szamlalo]." -> ".$item."</option>";
		}
		$szamlalo=$szamlalo+1;
		
		
    }
 }
 
 
 
echo '</select>

<a href="addalmufajl.php">+</a>
</td></tr>';
 
 
 
 echo'
   <tr><td><input type="submit" value="Könyv szerkesztése" /></td></tr>  
   <tr><td><input type="text" name="id" value="'.$_POST["konyvid"].'" readonly></td></tr>
   </table>  
   </form>  
   
   ';


?>