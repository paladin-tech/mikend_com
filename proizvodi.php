<?
$kategorijaId = (isset($_GET['kategorija']))?mysql_real_escape_string($_GET['kategorija']):1;
$provera = $infosystem->Execute('SELECT `kategorijaId`, `kategorijaNaziv`, `kategorijaOpis` FROM `mikend_kategorija` WHERE `kategorijaId` = ' . $kategorijaId);
if($provera->RecordCount() == 0) {
	$kategorijaId = 1;
	$provera = $infosystem->Execute('SELECT `kategorijaId`, `kategorijaNaziv`, `kategorijaOpis` FROM `mikend_kategorija` WHERE `kategorijaId` = ' . $kategorijaId);
}

list($kategorijaId, $kategorijaNaziv, $kategorijaOpis) = $provera->fields;

$rsArtikal = $infosystem->Execute('SELECT `proizvodId`, `naziv`, `kolicina`, `cena` FROM `mikend_proizvod` WHERE `kategorijaId` = ' . $kategorijaId);
?>
<h1>Dobro došli u svet dobre keramike –  Mikend doo Šabac</h1>
<div class="pageText">Pločice koje se nalaze u našem prodajnom asortimanu obuhvataju više stilova, od klasičnog, preko minimalističkog do stila koji je namenjen ljubiteljima prirode, boja i simbola.</div>
<div class="oferta">
	<div class="oferta_details">
		<div class="oferta_title"><?= $kategorijaNaziv ?></div>
		<div class="oferta_text">
			<?= $kategorijaOpis ?>
			<a href="index.php?str=kategorijaDetalji&kategorija=<?= $kategorijaId ?>" class="prod_details">Izmeni</a>
		</div>
		<!--					<a href="#" class="prod_buy">details</a>-->
	</div>
</div>
<div class="center_title_bar"><?= $kategorijaNaziv ?></div><?
while(!$rsArtikal->EOF) {
	list($proizvodId, $naziv, $kolicina, $cena) = $rsArtikal->fields; ?>
	<div class="prod_box">
	<div class="center_prod_box">
		<div class="product_title"><a href="index.php?str=proizvodDetalji&proizvod=<?= $proizvodId ?>"><?= $naziv ?></a></div>
		<div class="product_img">
			<a href="images/<?= $proizvodId ?>-800.jpg" rel="lightbox" title="<?= $naziv ?>"><img src="images/<?= $proizvodId ?>-100.jpg"></a>
		</div>
		<div class="prod_price">
			<!--						<span class="reduce">350$</span>-->
			<span class="price">Cena: <?= $cena ?></span>
		</div>
	</div>
	<div class="prod_details_tab">
		<!--					<a href="#" class="prod_buy">Add to Cart</a>-->
		<a href="index.php?str=proizvodDetalji&proizvod=<?= $proizvodId ?>" class="prod_details">Izmeni</a>
<!--		<a href="#" class="prod_details">Detalji</a>-->
	</div>
	</div><?
	$rsArtikal->MoveNext();
}
?>
	<div class="prod_details_tab">
		<a href="index.php?str=proizvodDetalji&proizvod=0" class="prod_details">Novi artikal</a>
	</div>
<!--			<div class="prod_box">-->
<!--				<div class="center_prod_box">-->
<!--					<div class="product_title"><a href="#">Makita 156 MX-VL</a></div>-->
<!--					<div class="product_img"><a href="#"><img src="images/p3.jpg" alt="" border="0" /></a></div>-->
<!--					<div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>-->
<!--				</div>-->
<!--				<div class="prod_details_tab"> <a href="#" class="prod_buy">Add to Cart</a> <a href="#" class="prod_details">Details</a> </div>-->
<!--			</div>-->
<!--			<div class="prod_box">-->
<!--				<div class="center_prod_box">-->
<!--					<div class="product_title"><a href="#">Bosch XC</a></div>-->
<!--					<div class="product_img"><a href="#"><img src="images/p5.jpg" alt="" border="0" /></a></div>-->
<!--					<div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>-->
<!--				</div>-->
<!--				<div class="prod_details_tab"> <a href="#" class="prod_buy">Add to Cart</a> <a href="#" class="prod_details">Details</a> </div>-->
<!--			</div>-->
<!--			<div class="prod_box">-->
<!--				<div class="center_prod_box">-->
<!--					<div class="product_title"><a href="#">Lotus PP4</a></div>-->
<!--					<div class="product_img"><a href="#"><img src="images/p6.jpg" alt="" border="0" /></a></div>-->
<!--					<div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>-->
<!--				</div>-->
<!--				<div class="prod_details_tab"> <a href="#" class="prod_buy">Add to Cart</a> <a href="#" class="prod_details">Details</a> </div>-->
<!--			</div>-->
<!--			<div class="center_title_bar">Recomended Products</div>-->
<!--			<div class="prod_box">-->
<!--				<div class="center_prod_box">-->
<!--					<div class="product_title"><a href="#">Makita 156 MX-VL</a></div>-->
<!--					<div class="product_img"><a href="#"><img src="images/p7.jpg" alt="" border="0" /></a></div>-->
<!--					<div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>-->
<!--				</div>-->
<!--				<div class="prod_details_tab"> <a href="#" class="prod_buy">Add to Cart</a> <a href="#" class="prod_details">Details</a> </div>-->
<!--			</div>-->
<!--			<div class="prod_box">-->
<!--				<div class="center_prod_box">-->
<!--					<div class="product_title"><a href="#">Bosch XC</a></div>-->
<!--					<div class="product_img"><a href="#"><img src="images/p1.jpg" alt="" border="0" /></a></div>-->
<!--					<div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>-->
<!--				</div>-->
<!--				<div class="prod_details_tab"> <a href="#" class="prod_buy">Add to Cart</a> <a href="#" class="prod_details">Details</a> </div>-->
<!--			</div>-->
<!--			<div class="prod_box">-->
<!--				<div class="center_prod_box">-->
<!--					<div class="product_title"><a href="#">Lotus PP4</a></div>-->
<!--					<div class="product_img"><a href="#"><img src="images/p3.jpg" alt="" border="0" /></a></div>-->
<!--					<div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>-->
<!--				</div>-->
<!--				<div class="prod_details_tab"> <a href="#" class="prod_buy">Add to Cart</a> <a href="#" class="prod_details">Details</a> </div>-->
<!--			</div>-->