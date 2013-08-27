<?
require("adodb/adodb.inc.php");
require("infosystem.php");
$infosystem->debug = true;

$dozvoljeneStranice = array('proizvodi', 'proizvodDetalji', 'kategorijaDetalji', 'o-nama', 'kontakt', 'login');
$str = (isset($_GET['str']) && in_array($_GET['str'], $dozvoljeneStranice))?$_GET['str']:'proizvodi';

$rsKategorija = $infosystem->Execute("SELECT `kategorijaId`, `kategorijaNaziv` FROM `mikend_kategorija`");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Mikend</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<!--[if IE 6]>
	<link rel="stylesheet" type="text/css" href="css/iecss.css" />
	<![endif]-->
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/boxOver.js"></script>
	<script src="js/lightbox-2.6.min.js"></script>
	<link href="css/lightbox.css" rel="stylesheet" />
</head>
<body>
<div id="main_container">
	<div id="header">
<!--		<div id="logo"> <a href="#"><img src="images/MIKEND-logo.png" alt="" border="0" /></a> </div>-->
	</div>
	<div id="main_content">
		<div id="menu_tab">
			<ul class="menu">
<!--				<li><a href="#" class="nav">Početna</a></li>-->
<!--				<li class="divider"></li>-->
				<li><a href="index.php?str=proizvodi&kategorija=1" class="nav">Proizvodi</a></li>
				<li class="divider"></li>
				<li><a href="#" class="nav">O nama</a></li>
				<li class="divider"></li>
				<li><a href="#" class="nav">Kontakt</a></li>
			</ul>
		</div>
		<!-- end of menu tab -->
		<div class="crumb_navigation" style="background: none">
<!--			Navigation: <span class="current">Home</span>-->
		</div>
		<div class="left_content">
			<div class="title_box">Kategorije</div>
			<ul class="left_menu"><?
			while(!$rsKategorija->EOF) {
				list($kategorijaId, $kategorijaNaziv) = $rsKategorija->fields; ?>
				<li class="odd"><a href="index.php?str=proizvodi&kategorija=<?= $kategorijaId ?>"><?= $kategorijaNaziv ?></a></li><?
				$rsKategorija->MoveNext();
			} ?>
			</ul>
<!--			<div class="title_box">Special Products</div>-->
<!--			<div class="border_box">-->
<!--				<div class="product_title"><a href="#">Makita 156 MX-VL</a></div>-->
<!--				<div class="product_img"><a href="#"><img src="images/p1.jpg" alt="" border="0" /></a></div>-->
<!--				<div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>-->
<!--			</div>-->
<!--			<div class="title_box">Newsletter</div>-->
<!--			<div class="border_box">-->
<!--				<input type="text" name="newsletter" class="newsletter_input" value="your email"/>-->
<!--				<a href="#" class="join">subscribe</a> </div>-->
<!--			<div class="banner_adds"> <a href="#"><img src="images/bann2.jpg" alt="" border="0" /></a> </div>-->
		</div>
		<!-- end of left content -->
		<div class="center_content">
			<? include($str . '.php'); ?>
		</div>
		<!-- end of center content -->
		<div class="right_content">
<!--			<div class="title_box">Search</div>-->
<!--			<div class="border_box">-->
<!--				<input type="text" name="newsletter" class="newsletter_input" value="keyword"/>-->
<!--				<a href="#" class="join">search</a> </div>-->
<!--			<div class="shopping_cart">-->
<!--				<div class="title_box">Shopping cart</div>-->
<!--				<div class="cart_details"> 3 items <br />-->
<!--					<span class="border_cart"></span> Total: <span class="price">350$</span> </div>-->
<!--				<div class="cart_icon"><a href="#"><img src="images/shoppingcart.png" alt="" width="35" height="35" border="0" /></a></div>-->
<!--			</div>-->
<!--			<div class="title_box">What’s new</div>-->
<!--			<div class="border_box">-->
<!--				<div class="product_title"><a href="#">Motorola 156 MX-VL</a></div>-->
<!--				<div class="product_img"><a href="#"><img src="images/p2.jpg" alt="" border="0" /></a></div>-->
<!--				<div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>-->
<!--			</div>-->
<!--			<div class="title_box">Manufacturers</div>-->
<!--			<ul class="left_menu">-->
<!--				<li class="odd"><a href="#">Bosch</a></li>-->
<!--				<li class="even"><a href="#">Samsung</a></li>-->
<!--				<li class="odd"><a href="#">Makita</a></li>-->
<!--				<li class="even"><a href="#">LG</a></li>-->
<!--				<li class="odd"><a href="#">Fujitsu Siemens</a></li>-->
<!--				<li class="even"><a href="#">Motorola</a></li>-->
<!--				<li class="odd"><a href="#">Phillips</a></li>-->
<!--				<li class="even"><a href="#">Beko</a></li>-->
<!--			</ul>-->
<!--			<div class="banner_adds"> <a href="#"><img src="images/bann1.jpg" alt="" border="0" /></a> </div>-->
		</div>
		<!-- end of right content -->
	</div>
	<!-- end of main content -->
	<div class="footer">
		<div class="left_footer"></div>
		<div class="right_footer"> <a href="#">proizvodi</a> <a href="#">o nama</a> <a href="#">kontakt</a></div>
	</div>
</div>
<!-- end of main_container -->
</body>
</html>