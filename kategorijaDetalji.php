<?
$authorized = true;
include_once('image_handler.php');

if(!empty($_POST)) {
	foreach($_POST as $key => $value) $$key = mysql_real_escape_string($value);
	$infosystem->Execute("UPDATE `mikend_kategorija` SET `kategorijaNaziv` = '{$txtNazivKategorije}', `kategorijaOpis` = '{$txtKategorijaOpis}' WHERE `kategorijaId` = {$kategorijaId}"); ?>
	<meta http-equiv="refresh" content="0;URL=index.php?str=proizvodi&kategorija=<?= $kategorijaId ?>"><?
}

if(isset($_GET['kategorija'])) {
	$kategorijaId = mysql_real_escape_string($_GET['kategorija']);

	$provera = $infosystem->Execute('SELECT `kategorijaNaziv`, `kategorijaOpis` FROM `mikend_kategorija` WHERE `kategorijaId` = ' . $kategorijaId);

	if($provera->RecordCount() != 0) {
		list($kategorijaNaziv, $kategorijaOpis) = $provera->fields;
	} else {
		$authorized = false;
	}
}
?>
<?
if($authorized) {
	?>
	<div class="center_title_bar"><?= strtoupper($kategorijaNaziv) ?></div>
	<div class="prod_box_big">
	<div class="center_prod_box_big">
		<form name="frmKategorija" method="post" action="index.php?str=kategorijaDetalji&kategorija=<?= $kategorijaId ?>" enctype="multipart/form-data">
			<input type="hidden" name="kategorijaId" value="<?= $kategorijaId ?>">
			<div class="details_big_box">
				<div class="specifications">
					Naziv kategorije:<br>
					<input type="text" name="txtNazivKategorije" value="<?= $kategorijaNaziv ?>">
				</div>
				<div class="specifications">
					Opis:<br>
					<textarea name="txtKategorijaOpis" cols="50" rows="5"><?= $kategorijaOpis ?></textarea>
				</div>
				<div><a href="#" onclick="document.frmKategorija.submit()" class="prod_buy">Snimi</a></div>
			</div>
		</form>
	</div>
	</div><?
} else { ?>
	<meta http-equiv="refresh" content="0;URL=index.php"><?
} ?>