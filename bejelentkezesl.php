<?php
include 'connection.php';

if(!isset($_COOKIE["felhasznalo"])){
	echo '<form action="bejelentkezesql.php" method="post" style="margin:10px 10px 10px 10px"> 
	<div class="row form-group">
      <label for="usr">Felhasználó név:</label>
      <input type="text" class="form-control" name="fnev" id="usr">
    </div>
    <div class="row form-group">
      <label for="pwd">Jelszó:</label>
      <input type="password" class="form-control" name="jelszo" id="pwd">
    </div>
	<input type="submit" class="btn btn-default float-right" value="Bejelentkezés" />
	 </form> ';
}
?>