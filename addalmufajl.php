<?php

include 'connection.php';

echo '    <form action="addalmufajql.php" method="post"> 
   <table width=600>  
   <tr><td>Alműfaj neve:</td>
 <td><input type="text" name="almufaj" value=""/></td></tr> ';

    echo '<tr><td>Műfaj:</td>';
 
echo '<td><select name="mufajid">';
 
 $stid = odbc_exec($conn, 'SELECT NEV FROM MUFAJ');
	
 $szamlalo=1;
 while ( $row = odbc_fetch_array($stid)) {
    foreach ($row as $item) {
		echo "<option value=".$szamlalo.">".$item."</option>";
		$szamlalo=$szamlalo+1;
    }
 }
 
echo '</select></td></tr>';
   
 
 echo'
 
   <tr><td><input type="submit" value="Alműfaj hozzáadása" /></td></tr>  
   </table>  
   </form>  
   
   ';
   
   

   
   
?>
