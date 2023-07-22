<?php
$followers_json="./followers.json";
$followers=array();
if(file_exists($followers_json)) {
  $followers = json_decode(file_get_contents($followers_json), true);
}
?>
{
  "@context": [
    "https://www.w3.org/ns/activitystreams"
  ],
  "type": "Collection",
  "id": "https://<?php echo getenv('EAGINE_HOST')?>/activitypub/followers",
  "totalItems": <?php echo sizeof($followers) ?>,
  "items": <?php echo json_encode($followers) ?>
}
