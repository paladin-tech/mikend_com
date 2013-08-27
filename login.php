<?
if(!empty($_POST)) {
	die(var_dump($_POST));
	foreach($_POST as $key => $value) $$key = mysql_real_escape_string($value);
	if($proizvodId != 0)
		$infosystem->Execute("UPDATE `mikend_proizvod` SET `naziv` = '{$txtNaziv}', `kategorijaId` = {$selKategorija}, `kolicina` = '{$txtKolicina}', `cena` = '{$txtCena}' WHERE `proizvodId` = {$proizvodId}");
	else
		$infosystem->Execute("INSERT INTO `mikend_proizvod` SET `proizvodId` = {$proizvodId}, `naziv` = '{$txtNaziv}', `kategorijaId` = {$selKategorija}, `kolicina` = '{$txtKolicina}', `cena` = '{$txtCena}'");
	if(is_uploaded_file($_FILES['filSlika']['tmp_name'])) image_handler(array(100, 800), "images", $proizvodId, "", $_FILES['filSlika']['tmp_name'], $_FILES['filSlika']['name']);
}
?>
<div class="center_title_bar">LOGIN</div>
<div class="prod_box_big">
	<div class="center_prod_box_big">
		<form name="frmLogin" method="post" action="index.php?str=login">
		<div class="details_big_box">
			<div class="specifications">
				Korisničko ime:<br>
				<input type="text" name="txtKorisnicko">
			</div>
			<div class="specifications">
				Lozinka:<br>
				<input type="text" name="txtLozinka">
			</div>
			<div><a href="#" onclick="document.frmLogin.submit()" class="prod_buy">Ulazak</a></div>
		</div>
		</form>
	</div>
</div>