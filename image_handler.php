<?
function image_handler($velicine, $folder, $pref, $suf, $tmp, $name) {
	$podrzano = array("jpg","jpeg","gif","png");
	$ext = getImgExtension(strtolower($name));
//	echo "Ext: $ext";exit;

// Copy the original file
	copy($tmp, "{$folder}/original/{$pref}-original.{$ext}");

	if(!in_array($ext,$podrzano)) {
		echo "<br>Format nije podrzan!";
		exit;
	}

	switch ($ext) {
		case "jpg":
			$source = imagecreatefromjpeg($tmp);
			break;
		case "gif":
			$source = imagecreatefromgif($tmp);
			break;
		case "png":
			$source = imagecreatefrompng($tmp);
			break;
	}

	$d = getimagesize($tmp);
	$o = $d[1]/$d[0];
	foreach($velicine as $v) {
		$putanja = "{$folder}/{$pref}{$suf}-{$v}";
//		$putanja = "{$folder}/{$pref}-{$v}px";
		if(is_file("{$putanja}.jpg")) unlink("{$putanja}.jpg");
		if(is_file("{$putanja}.gif")) unlink("{$putanja}.gif");
		if(is_file("{$putanja}.png")) unlink("{$putanja}.png");
		$dest = ($o>1)?imagecreatetruecolor($v/$o, $v):imagecreatetruecolor($v, $v*$o);
		if($o>1) imagecopyresampled($dest, $source, 0, 0, 0, 0, $v/$o, $v, imagesx($source), imagesy($source));
		else imagecopyresampled($dest, $source, 0, 0, 0, 0, $v, $v*$o, imagesx($source), imagesy($source));
		switch ($ext) {
			case "jpg":
				if(!imagejpeg($dest,"{$putanja}.jpg",85)) echo "Greska...";
				break;
			case "gif":
				if(!imagegif($dest,"{$putanja}.gif")) echo "Greska...";
				break;
			case "png":
				if(!imagepng($dest,"{$putanja}.png")) echo "Greska...";
				break;
		}
		imagedestroy($dest);
	}
//	dnevnik("upload image: $folder/$pref$suf.$ext; Size: $d");
}

function getImgExtension($name) {
	$e = explode(".",$name);
	$ext = strtolower($e[sizeof($e)-1]);
	return($ext);
}

function DajEkstenzijuSlikeAkoPostoji($folder, $fajl, $ajdi)
{
	$odgovor = "";
	if(is_file("{$folder}/{$fajl}-80px-{$ajdi}.jpg")) $odgovor = "jpg";
	if(is_file("{$folder}/{$fajl}-80px-{$ajdi}.gif")) $odgovor = "gif";
	if(is_file("{$folder}/{$fajl}-80px-{$ajdi}.png")) $odgovor = "png";
	return $odgovor;
}
?>