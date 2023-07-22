/// Copyright Matus Chochlik.
/// Distributed under the Boost Software License, Version 1.0.
/// See accompanying file LICENSE_1_0.txt or copy at
///  http://www.boost.org/LICENSE_1_0.txt
///
<?php
header('Content-type: application/json');
?>
{
  "version": "2.0",
  "protocols": [
    "activitypub"
  ],
  "services": {
    "inbound": [],
    "outbound": [
      "rss2.0"
    ]
  },
  "openRegistrations": false,
  "usage": {
    "users": {
      "total": 1
    },
    "localPosts": 1
  },
  "metadata": {
    "nodeName": "EAGine"
  }
}

