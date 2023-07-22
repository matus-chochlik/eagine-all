/// Copyright Matus Chochlik.
/// Distributed under the Boost Software License, Version 1.0.
/// See accompanying file LICENSE_1_0.txt or copy at
///  http://www.boost.org/LICENSE_1_0.txt
///
<?php
header('Content-type: application/json');
?>
{
  "@context": [
    "https://www.w3.org/ns/activitystreams"
  ],
  "type": "OrderedCollection",
  "id": "https://<?php echo getenv('EAGINE_HOST')?>/activitypub/outbox",
  "totalItems": 0,
  "orderedItems": []
}
