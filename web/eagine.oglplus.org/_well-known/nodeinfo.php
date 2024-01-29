/// Copyright Matus Chochlik.
/// Distributed under the Boost Software License, Version 1.0.
/// See accompanying file LICENSE_1_0.txt or copy at
/// https://www.boost.org/LICENSE_1_0.txt
///
<?php
header('Content-type: application/json');
?>
{
  "links": [
    {
      "href": "https://<?php echo getenv('EAGINE_HOST') ?>/activitypub/nodeinfo",
      "rel": "http://nodeinfo.diaspora.software/ns/schema/2.0"
    }
  ]
}

