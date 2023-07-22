<?php
/// Copyright Matus Chochlik.
/// Distributed under the Boost Software License, Version 1.0.
/// See accompanying file LICENSE_1_0.txt or copy at
///  http://www.boost.org/LICENSE_1_0.txt
///
require './ap_utils.php';

header('Content-type: application/json');
#file_put_contents("./post.dump", json_encode(getRequestJson()), FILE_APPEND);
?>
{
  "@context": [
    "https://www.w3.org/ns/activitystreams"
  ],
  "type": "OrderedCollection",
  "id": "<?php echo getApEndpoint("inbox") ?>",
  "totalItems": 0,
  "orderedItems": []
}
