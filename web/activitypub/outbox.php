<?php
/// Copyright Matus Chochlik.
/// Distributed under the Boost Software License, Version 1.0.
/// See accompanying file LICENSE_1_0.txt or copy at
///  http://www.boost.org/LICENSE_1_0.txt
///
header('Content-type: application/json');
?>
{
  "@context": [
    "https://www.w3.org/ns/activitystreams"
  ],
  "type": "OrderedCollection",
  "id": "<?php echo getApEndpoint("outbox") ?>",
  "totalItems": 0,
  "orderedItems": []
}
