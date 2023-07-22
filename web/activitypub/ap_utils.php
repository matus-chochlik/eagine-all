<?php
/// Copyright Matus Chochlik.
/// Distributed under the Boost Software License, Version 1.0.
/// See accompanying file LICENSE_1_0.txt or copy at
///  http://www.boost.org/LICENSE_1_0.txt
///
//------------------------------------------------------------------------------
function getApEndpoint($ep) {
	return "https://" . getenv('EAGINE_HOST') . "/activitypub/" . $ep;
}
//------------------------------------------------------------------------------
function getActorId() {
	return getApEndpoint("actor");
}
//------------------------------------------------------------------------------
function toJson($x) {
	return str_replace('\\/', '/', json_encode($x));
}
//------------------------------------------------------------------------------
function getPostContent() {
  $postfd = fopen("php://input", "r") or die("failed to get POST data");
	$content = stream_get_contents($postfd);
  fclose($postfd);
	return $content;
}
//------------------------------------------------------------------------------
function getRequestJson() {
	return json_decode(getPostContent());
}
//------------------------------------------------------------------------------
function isRequestOk($type, $request) {
	if($request["type"] != $type) {
		return false;
	}
	if($request["object"] != getActorId()) {
		return false;
	}
	return true;
}
//------------------------------------------------------------------------------
$followers_json="./followers.json";

function addFollower($uri) {
}

function removeFollower($uri) {
}

function getFollowers() {
	$followers=array();
	if(file_exists($followers_json)) {
		$followers = json_decode(file_get_contents($followers_json), true);
	}
	return $followers;
}
//------------------------------------------------------------------------------
function getFollowing() {
	return array("https://mastodon.online/users/matus_chochlik");
}
//------------------------------------------------------------------------------
?>
