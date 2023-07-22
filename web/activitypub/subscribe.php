<?php
$uri = $_GET["uri"];
$followers_json = "./followers.json";
if ($uri != "") {
	if(file_exists($followers_json)) {
	} else {
		$fd = fopen($followers_json, "w") or die("unable to open followers file");
		fwrite($fd, json_encode(array($uri)));
		fclose($fd);
	}
?>
{}
<?php } else { ?>
{}
<?php } ?>
