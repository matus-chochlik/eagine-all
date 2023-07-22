<?php
/// Copyright Matus Chochlik.
/// Distributed under the Boost Software License, Version 1.0.
/// See accompanying file LICENSE_1_0.txt or copy at
///  http://www.boost.org/LICENSE_1_0.txt
///
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
  "id": "<?php echo getApEndpoint('followers') ?>"
}
