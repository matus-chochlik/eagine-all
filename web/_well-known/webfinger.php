<?php if ($_GET["resource"] == "acct:eagine@"+getenv('EAGINE_HOST')) { ?>
{
  "subject": "acct:eagine@<?php echo getenv('EAGINE_HOST')?>",

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

