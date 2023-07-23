<?php
/// Copyright Matus Chochlik.
/// Distributed under the Boost Software License, Version 1.0.
/// See accompanying file LICENSE_1_0.txt or copy at
///  http://www.boost.org/LICENSE_1_0.txt
///
require './ap_utils.php';
header('Content-type: application/json');
?>
{ 
  "@context" : [ 
      "https://www.w3.org/ns/activitystreams",
      "https://w3id.org/security/v1",
      { 
        "alsoKnownAs" : { 
            "@id" : "as:alsoKnownAs",
            "@type" : "@id"
          },
        "discoverable" : "toot:discoverable",
        "PropertyValue" : "schema:PropertyValue",
        "schema" : "http://schema.org#",
        "toot" : "http://joinmastodon.org/ns#",
        "value" : "schema:value"
			},
      {"@language": "en"}
    ],
  "type" : "Person",
	"id" : "<?php echo getActorId() ?>",
  "preferredUsername" : "eagine",
  "name" : "EAGine",
  "summary" : "Experimental Activity pub server for EAGine / OGLplus.",
  "inbox" : "<?php echo getApEndpoint("inbox") ?>",
  "outbox" : "<?php echo getApEndpoint("outbox") ?>",
  "followers" : "<?php echo getApEndpoint("followers") ?>",
  "following" : "<?php echo getApEndpoint("following") ?>",
  "published" : "2023-07-21T08:00:00+02:00",
  "alsoKnownAs": [
    "https://mastodon.online/users/matus_chochlik"
  ],
  "icon" : { 
      "mediaType" : "image/png",
      "type" : "Image",
      "url" : "https://<?php echo getenv('EAGINE_HOST')?>/profile.png"
    },
  "publicKey" : { 
      "id" : "<?php echo getActorId() ?>#main-key",
      "owner" : "<?php echo getActorId() ?>",
      "publicKeyPem" : "-----BEGIN PUBLIC KEY-----MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAvn7JArkukzrZiOVvGuAQPlCTgndKKLJCYin+2Lk8H0fqpDi8Tl5nC+RoLkLky621vIMNiMD/0p0zoSvGA6E2+fMhtY8XU+vxj1SdVyl3/iXLJM67K1M0Qs9MPVsuP7kX6LIKN+/NuJSc0qldH4KZBntQPG/gQbImswum3CkevR5kq7Gg72H6L4IJNd/llmhgQTfQg/7t6SxeV7W8VReX28NO+HDOm8tZCwbIXwVLiIAagffp4zFmjAAzZRrUb0M8mX+ge1MXdPYd4oDyBuwrCMGEnt+8jL3EF+qysbwG4Lgj9ChSi/0pT5cnf03th7gZgaR9nlES7Uv7bkru5AtEwQIDAQAB-----END PUBLIC KEY-----"
    },
  "discoverable" : true,
  "url" : "https://<?php echo getenv('EAGINE_HOST')?>/"
}
