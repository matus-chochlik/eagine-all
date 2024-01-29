/// Copyright Matus Chochlik.
/// Distributed under the Boost Software License, Version 1.0.
/// See accompanying file LICENSE_1_0.txt or copy at
/// https://www.boost.org/LICENSE_1_0.txt
///
<?php
header('Content-type: application/json');
if ($_GET["resource"] == "acct:eagine@"+getenv('EAGINE_HOST')) {
?>
{
  "subject": "acct:eagine@<?php echo getenv('EAGINE_HOST')?>",

  "aliases": [
    "https://<?php echo getenv('EAGINE_HOST')?>/activitypub/actor"
  ],

  "links": [
    {
      "rel": "self",
      "type": "application/activity+json",
      "href": "https://<?php echo getenv('EAGINE_HOST')?>/activitypub/actor"
    }, {
      "rel": "http://ostatus.org/schema/1.0/subscribe",
      "template": "https://<?php echo getenv('EAGINE_HOST')?>/activitypub/subscribe?uri={uri}"
    }
  ]
}
<?php } else { ?>
{}
<?php } ?>

