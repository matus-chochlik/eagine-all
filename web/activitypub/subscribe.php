<?php
/// Copyright Matus Chochlik.
/// Distributed under the Boost Software License, Version 1.0.
/// See accompanying file LICENSE_1_0.txt or copy at
///  http://www.boost.org/LICENSE_1_0.txt
///
header('Content-type: application/json');
$uri = $_GET["uri"];
$followers_json = "./followers.json";
if ($uri != "") {
	if(file_exists($followers_json)) {
	} else {
		$fd = fopen($followers_json, "w") or die("unable to open followers file");
		fwrite($fd, toJson(array($uri)));
		fclose($fd);
	}
?>
{ }
<?php } else { ?>
{}
<?php } ?>
