<?php
/// Copyright Matus Chochlik.
/// Distributed under the Boost Software License, Version 1.0.
/// See accompanying file LICENSE_1_0.txt or copy at
/// https://www.boost.org/LICENSE_1_0.txt
///
require './ap_utils.php';
$request = getRequestJson();
if(isRequestOk("Follow", $request)) {
    addFollower($request->actor);
    postResponseDataToActor(
      $request->actor,
      activityResponseDataObject("Accept", $request));
} else if(isRequestOk("Undo", $request)) {
  if($request->object->type == "Follow") {
    removeFollower($request->object->actor);
  }
}
#file_put_contents("./post.dump", toJson($request), FILE_APPEND);

activityHeader();
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
