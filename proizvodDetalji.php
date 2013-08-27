<?
$authorized = true;
include_once('image_handler.php');

if(!empty($_POST)) {
	foreach($_POST as $key => $value) $$key = mysql_real_escape_string($value);
	$proizvodId = $txtSifraArtikla;
	if($proizvodId != 0) {
		$infosystem->Execute("UPDATE `mikend_proizvod` SET `naziv` = '{$txtNaziv}', `kategorijaId` = {$selKategorija}, `kolicina` = '{$txtKolicina}', `cena` = '{$txtCena}' WHERE `proizvodId` = {$proizvodId}");
	} else {
		$infosystem->Execute("INSERT INTO `mikend_proizvod` SET `proizvodId` = {$txtSifraArtikla}, `naziv` = '{$txtNaziv}', `kategorijaId` = {$selKategorija}, `kolicina` = '{$txtKolicina}', `cena` = '{$txtCena}'");
		$proizvodId = $txtSifraArtikla;
	}
	if(is_uploaded_file($_FILES['filSlika']['tmp_name'])) image_handler(array(100, 800), "images", $proizvodId, "", $_FILES['filSlika']['tmp_name'], $_FILES['filSlika']['name']);
}

if(isset($_GET['proizvod']) || isset($proizvodId)) {
	if(isset($_GET['proizvod'])) $proizvodId = mysql_real_escape_string($_GET['proizvod']);

	$rsKategorija = $infosystem->Execute('SELECT `kategorijaId`, `kategorijaNaziv` FROM `mikend_kategorija`');

	if($proizvodId != 0) {
		$provera = $infosystem->Execute('SELECT `naziv`, `kategorijaId`, `kolicina`, `cena` FROM `mikend_proizvod` WHERE `proizvodId` = ' . $proizvodId);
		if($provera->RecordCount() != 0) {
			list($naziv, $kategorijaId, $kolicina, $cena) = $infosystem->Execute('SELECT `naziv`, `kategorijaId`, `kolicina`, `cena` FROM `mikend_proizvod` WHERE `proizvodId` = ' . $proizvodId)->fields;
		} else {
			$authorized = false;
		}
	}
} else {
	$authorized = false;
}
?>
<?
if($authorized) {
?>
<div class="center_title_bar"><?= ($proizvodId!=0)?strtoupper($naziv):'NOVI ARTIKAL' ?></div>
<div class="prod_box_big">
	<div class="center_prod_box_big">
		<div class="product_img_big"><? if($proizvodId!=0) { ?><img src="images/<?= $proizvodId ?>-100.jpg" alt="" border="0" /><? } ?></div>
		<form name="frmProizvod" method="post" action="index.php?str=proizvodDetalji&proizvod=<?= $proizvodId ?>" enctype="multipart/form-data">
		<div class="details_big_box">
			<div class="specifications">
				Šifra artikla:<br>
				<input type="text" name="txtSifraArtikla" value="<?= ($proizvodId!=0)?$proizvodId:'' ?>"<?= ($proizvodId!=0)?' readonly':''?>>
			</div>
			<div class="specifications">
				Naziv:<br>
				<input type="text" name="txtNaziv" value="<?= ($proizvodId!=0)?$naziv:'' ?>">
			</div>
			<div class="specifications">
				Naziv:<br>
				<select name="selKategorija"><?
				while(!$rsKategorija->EOF) {
					list($kategorijaIdK, $kategorijaNazivK) = $rsKategorija->fields; ?>
					<option value="<?= $kategorijaIdK ?>"<?= ($proizvodId!=0 && $kategorijaId == $kategorijaIdK)?" selected":"" ?>><?= $kategorijaNazivK ?></option><?
					$rsKategorija->MoveNext();
				} ?>
				</select>
			</div>
			<div class="specifications">
				Količina:<br>
				<input type="text" name="txtKolicina" value="<?= ($proizvodId!=0)?$kolicina:'' ?>">
			</div>
			<div class="specifications">
				Cena:<br>
				<input type="text" name="txtCena" value="<?= ($proizvodId!=0)?$cena:'' ?>">
			</div>
			<div class="specifications">
				Slika:<br>
				<input type="file" name="filSlika">
			</div>
			<div><a href="#" onclick="document.frmProizvod.submit()" class="prod_buy">Snimi</a></div>
		</div>
		</form>
	</div>
</div><?
} else { ?>
<meta http-equiv="refresh" content="0;URL=index.php"><?
} ?>