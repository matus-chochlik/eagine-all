<?php
require './ap_utils.php';
$followers = getFollowers();
header('Content-type: application/json');
?>
{
  "@context": [
    "https://www.w3.org/ns/activitystreams"
  ],
  "type": "Collection",
  "totalItems": <?php echo sizeof($followers) ?>,
  "items": <?php echo toJson($followers) ?>,
  "id": "https://<?php echo getenv('EAGINE_HOST')?>/activitypub/followers"
}
