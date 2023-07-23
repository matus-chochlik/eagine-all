<?php
/// Copyright Matus Chochlik.
/// Distributed under the Boost Software License, Version 1.0.
/// See accompanying file LICENSE_1_0.txt or copy at
///  http://www.boost.org/LICENSE_1_0.txt
///
//------------------------------------------------------------------------------
//  Date
//------------------------------------------------------------------------------
function getHttpDate() {
  return gmdate('D, d M Y H:i:s T');
}
//------------------------------------------------------------------------------
//  Signatures
//------------------------------------------------------------------------------
function getSignKey() {
	return openssl_pkey_get_private('file://../secret/eagine.pem');
}
//------------------------------------------------------------------------------
function getSignDigestMethod() {
	return "sha256";
}
//------------------------------------------------------------------------------
function signData($data) {
	$key = getSignKey();
	$signature = "";
	$signed = openssl_sign($data, $signature, $key, getSignDigestMethod());
	openssl_free_key($key);
	if($signed) {
		return base64_encode($signature);
	}
	return "";
}
//------------------------------------------------------------------------------
//  Response headers
//------------------------------------------------------------------------------
function activityHeader() {
  header("Content-Type: application/activity+json");
}
//------------------------------------------------------------------------------
//  API endpoint getters
//------------------------------------------------------------------------------
function getApEndpoint($ep) {
  return "https://" . getenv('EAGINE_HOST') . "/activitypub/" . $ep;
}
//------------------------------------------------------------------------------
function getActorId() {
  return getApEndpoint("actor");
}
//------------------------------------------------------------------------------
//  UUID
//------------------------------------------------------------------------------
function getUUID() {
  return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
      mt_rand(0, 0xffff), mt_rand(0, 0xffff),
      mt_rand(0, 0xffff),
      mt_rand(0, 0x0fff) | 0x4000,
      mt_rand(0, 0x3fff) | 0x8000,
      mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
  );
}
//------------------------------------------------------------------------------
//  Conversion to JSON
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
function getActorInfo($uri) {
  $opts = array("http" =>
    array(
      "method" => "GET",
      "header" => "Accept: application/activity+json\r\n"
    )
  );
  return json_decode(file_get_contents($uri, false, stream_context_create($opts)));
}
//------------------------------------------------------------------------------
function getActorInbox($uri) {
  return getActorInfo($uri)->inbox;
}
//------------------------------------------------------------------------------
function isRequestOk($type, $request) {
  if(!filter_var($request->actor, FILTER_VALIDATE_URL)) {
    return false;
  }
  if($request->type != $type) {
    return false;
  }
  if($request->type == "Follow") {
    if($request->object != getActorId()) {
      return false;
    }
  } else if($request->type == "Undo") {
    if($request->object->type == "Follow") {
      if($request->object != getActorId()) {
        return false;
      }
    }
  }
  return true;
}
//------------------------------------------------------------------------------
//  Response
//------------------------------------------------------------------------------
function activityResponseData($type) {
  return array(
    "@context" => "https://www.w3.org/ns/activitystreams",
    "type" => $type,
    "actor" => getActorId(),
    "id" => getApEndpoint(getUUID()));
}
//------------------------------------------------------------------------------
function activityResponseDataObject($type, $object) {
  $response = activityResponseData($type);
  $response["object"] = $object;
  return $response;
}
//------------------------------------------------------------------------------
function activityResponseHost() {
  return 'Host: ' . getenv('EAGINE_HOST');
}
//------------------------------------------------------------------------------
function activityResponseDate($date) {
  return 'Date: ' . $date;
}
//------------------------------------------------------------------------------
function activityResponseContentType() {
  return 'Content-Type: application/ld+json; profile="https://www.w3.org/ns/activitystreams"';
}
//------------------------------------------------------------------------------
function activityResponseSignature($date, $postdata) {
  $signed_string =
    '(request-target): post /activitypub/inbox'
    . '\nhost: ' . getenv('EAGINE_HOST')
    . '\ndate: ' . $date;
  $signature = signData($signed_string);
  return 'Signature:'
    . ' keyId="' . getActorId() . '#main-key"'
    . ',headers="(request-target) host date"'
    . ',signature="' . $signature . '"';
}
//------------------------------------------------------------------------------
function activityResponseHeader($postdata) {
  $date = getHttpDate();
  return activityResponseHost() . "\r\n"
       . activityResponseDate($date) . "\r\n"
       . activityResponseContentType() . "\r\n"
       . activityResponseSignature($date, $postdata) . "\r\n";
}
//------------------------------------------------------------------------------
function activityResponse($postdata) {
  return array("http" =>
    array(
      "method" => "POST",
      "header" => activityResponseHeader($postdata),
      "content" => $postdata));
}
//------------------------------------------------------------------------------
function postResponseTo($actor, $response) {
  return file_get_contents(getActorInbox($actor), false, stream_context_create($opts));
}
//------------------------------------------------------------------------------
function postResponseDataTo($actor, $data) {
  return postResponseTo($actor, activityResponse($data));
}
//------------------------------------------------------------------------------
//  Followers
//------------------------------------------------------------------------------
$followers_json="./followers.json";

function addFollower($uri) {
  if ($uri != "") {
    global $followers_json;
    if(file_exists($followers_json)) {
      $followers = json_decode(file_get_contents($followers_json), true);
      if(!in_array($uri, $followers, true)) {
        array_push($followers, $uri);
        file_put_contents($followers_json, toJson($followers));
      }
    } else {
      file_put_contents($followers_json, toJson(array($uri)));
    }
  }
}

function removeFollower($uri) {
  global $followers_json;
  if(file_exists($followers_json)) {
    $followers = json_decode(file_get_contents($followers_json), true);
    if(in_array($uri, $followers, true)) {
      unset($followers[$uri]);
      file_put_contents($followers_json, toJson($followers));
    }
  }
}

function getFollowers() {
  $followers=array();
  global $followers_json;
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
