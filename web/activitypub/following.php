/// Copyright Matus Chochlik.
/// Distributed under the Boost Software License, Version 1.0.
/// See accompanying file LICENSE_1_0.txt or copy at
///  http://www.boost.org/LICENSE_1_0.txt
///
<?php
require './ap_utils.php';
$following = getFollowing();
header('Content-type: application/json');
?>
{
  "@context": [
    "https://www.w3.org/ns/activitystreams"
  ],
  "type": "collection",
  "totalItems": <?php echo sizeof($following) ?>,
  "items": <?php echo toJson($following) ?>,
  "id": "https://<?php echo getenv('EAGINE_HOST')?>/activitypub/following"
}
